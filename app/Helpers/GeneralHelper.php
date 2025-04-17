<?php

namespace App\Helpers;

use App\Models\Menu;
use App\Models\Tenant;
use App\Models\Activity;
use App\Models\UserRole;
use App\Models\Permission;
use Illuminate\Http\Response;
use App\Models\RolePermission;
use Illuminate\Support\Facades\Auth;

class GeneralHelper {
    function getMenu($type=null)
    {
        $type = $type ?? 'landing';
        // $menus = Menu::with(['child.child' => function($query) {
        //     $query->orderBy('sort', 'asc');
        // }])
        // ->orderBy('sort', 'asc')
        // ->whereNull('parent_id')
        // ->get();
        $currentRole = session('current_role');
        $requiredPermission = 'show'; // Izin yang mengandung "show"

        if ($currentRole == 1) {
            $menus = $this->getMenuAdmin($type);
        }else{
            $menus = Menu::with([
                'child' => function ($query) use ($currentRole, $requiredPermission) {
                    $query->with(['child' => function($subQuery) use ($currentRole, $requiredPermission) {
                        $subQuery->orderBy('sort', 'asc')
                                 ->whereHas('permissions', function ($subSubQuery) use ($currentRole, $requiredPermission) {
                                    $subSubQuery->where('role_permissions.role_id', $currentRole)
                                                ->where('permissions.name', 'LIKE', "%$requiredPermission%")
                                                ->join('role_permissions', 'permissions.id', '=', 'role_permissions.permission_id');
                                });
                    }])
                    ->whereHas('permissions', function ($subQuery) use ($currentRole, $requiredPermission) {
                        $subQuery->where('role_permissions.role_id', $currentRole)
                                 ->where('permissions.name', 'LIKE', "%$requiredPermission%")
                                 ->join('role_permissions', 'permissions.id', '=', 'role_permissions.permission_id');
                    })
                    ->orderBy('sort', 'asc');
                }
            ])
            ->orderBy('sort', 'asc')
            ->whereNull('parent_id')
            ->where('type', $type)
            ->whereHas('permissions', function ($query) use ($currentRole, $requiredPermission) {
                $query->where('role_permissions.role_id', $currentRole)
                      ->where('permissions.name', 'LIKE', "%$requiredPermission%")
                      ->join('role_permissions', 'permissions.id', '=', 'role_permissions.permission_id');
            })
            ->get();
        }

        return $menus;
    }

    private function getMenuAdmin($type) {
        $currentRole = session('current_role');
        $requiredPermission = 'show'; // Izin yang mengandung "show"

        $menus = Menu::with([
            'child' => function ($query) use ($currentRole, $requiredPermission) {
                $query->with(['child' => function($subQuery) use ($currentRole, $requiredPermission) {
                    $subQuery->orderBy('sort', 'asc');
                }])->orderBy('sort', 'asc');
            }
        ])
        ->orderBy('sort', 'asc')
        ->whereNull('parent_id')
        ->where('type', $type)
        ->get();

        return $menus;
    }

    function canAccess($access, $isMenu = false )
    {
        $user_id = Auth::user()->id;
        $role_id = session('current_role');

        $permission = Permission::where(['name' => $access])->first();

        $userRole = UserRole::where(['role_id' => $role_id, 'user_id' => $user_id])->first();

        $rolePermission = RolePermission::where(['role_id' => $role_id, 'permission_id' => $permission?->id])->first();
        // return true;
        if(!$userRole || !$rolePermission)
        {
            if ($role_id == 1) {
                return true;

            }else{

                if($isMenu){
                    return false;
                }else{
                    return abort(Response::HTTP_FORBIDDEN, '403 Unauthorized');
                }
            }

        }else{
            return true;
        }

        // dd();
    }

    function log($type, $description)
    {
        $activity = new Activity();
        $activity->user_id = Auth::user() ? Auth::user()->id : null;
        $activity->url = url()->current();
        $activity->ip = request()->ip();
        $activity->description = $description;
        $activity->type = $type;

        // **Ambil semua input termasuk file**
        $requestData = request()->except(['password', 'password_confirmation']); // Hindari menyimpan password

        $uploadedFiles = [];
        $files = request()->allFiles(); // Ambil semua file
        if (!empty($files)) { // Jika ada file yang diunggah
            foreach ($files as $key => $file) {
                if (is_array($file)) {
                    foreach ($file as $index => $subFile) {
                        $uploadedFiles[$key][$index] = [
                            'original_name' => $subFile->getClientOriginalName(),
                        ];
                    }
                } else {
                    $uploadedFiles[$key] = [
                        'original_name' => $file->getClientOriginalName(),
                    ];
                }
            }

            $requestData['files'] = $uploadedFiles;
        }

        // **Simpan data dalam format JSON**
        $activity->data = json_encode($requestData);
        $activity->save();


        return true;
    }

    function getSetting()
    {
        $settingPath = storage_path('settings.json');
        $jsonContents = file_get_contents($settingPath);

        // Decode the JSON content
        $setting = json_decode($jsonContents);
        if (Auth::user()) {
            $s1 = request()->segment(1);
            if ($s1 != 'cms') {
                $setting = Tenant::where('code', $s1)->first();
                $setting->icon = $setting->logo;
            }
        }

        return $setting;
    }

    function generateNumber($form, $currentNumber)
    {
        $setting = $this->getSetting();
        $prefix = str_replace(["{Y}", "{M}"], [date('y'), date('m')], $setting->prefix->$form);
        $suffix = $setting->suffix->$form;
        $digits = $setting->digits->$form;

        return $prefix . str_pad($currentNumber + 1, $digits, '0', STR_PAD_LEFT) . $suffix;
    }

    function detailActivity($data, $html = null)
    {
        foreach ($data as $key => $value) {
            // var_dump(is_object($value), $value, is_array($value));die;
            $hide = $key == '_token' ? 'hidden' : '';
            $html .= "<li $hide>";
                $html .= '<b>'.$key.' : </b> ';
                if (is_array($value) || is_object($value)) {
                    $html .= '<ul>';
                    $html .= $this->detailActivity($value, $html);
                    $html .= '</ul>';
                }else{
                    $html .= $value;
                }
            $html .= "</li>";
        }
        // var_dump($html);
        return $html;
    }

    function tenant_route($routeName)
    {
        $tenant = request()->segment(1);
        $path = parse_url(route($routeName, ['code' => $tenant]), PHP_URL_PATH);
        $path = str_replace('/cms', '', $path);
        return url($path);
    }
    
}
