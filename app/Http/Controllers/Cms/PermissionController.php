<?php

namespace App\Http\Controllers\Cms;

use App\Helpers\GeneralHelper;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;


class PermissionController extends Controller
{
    private $listAccess = [
        'show', 'read', 'create', 'update', 'delete', 'detail', 'access', 'import', 'export', 'trash', 'restore'];
    private $helpers;

    public function __construct() {
        $this->helpers = App::make('generalhelper');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->helpers->canAccess('module-permission-show');

        if(request()->ajax()) {
            $this->helpers->canAccess('module-permission-read');
            $permission = Permission::select('*');
            if (request()->has('menu_id')) {
                $menuId = request()->input('menu_id');
                if (!empty($menuId)) {
                    $permission->where('menu_id', $menuId);
                }
            }

            return datatables()->of($permission)
            ->addColumn('action', function ($row) {

                $edit = '';
                $delete = '';

                if($this->helpers->canAccess('module-permission-update', true))
                {
                    $edit .= '<a href="'.route('permissions.edit', $row->id).'" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                                <i class="fa-solid fa-pencil"></i>
                            </a>';
                }
                if($this->helpers->canAccess('module-permission-delete', true))
                {
                    $delete .=  '<form id="delete-form-'.$row->id.'" action="'.route('permissions.destroy', $row->id).'" method="POST" style="display: none;">
                                    '.csrf_field().'
                                    '.method_field('DELETE').'
                                </form>
                                <a href="#" onclick="showConfirm('.$row->id.')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>';
                }
                $button = $edit.$delete;
                return '
                    <div class="btn-group">
                    '.$button.'
                    </div>';

            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }


        $data = [
            'title' => 'Permission',
            'menus' => Menu::all()
        ];

        return view('cms.permissions.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->helpers->canAccess('module-permission-create');
        $data = [
            'title' => 'Create Permission',
            'menus' => Menu::all(),
            'listAccess' => $this->listAccess
        ];

        return view('cms.permissions.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->helpers->canAccess('module-permission-create');

        $request->validate([
            'menu_id' => 'required',
            'access' => 'required',
            'permission_name' => 'required'
        ]);

        $menu = Menu::find($request->menu_id);
        if (empty($menu)) {
            return redirect()->back()->with('error', 'Menu not found');
        }
        $prefix = Str::slug($menu->name);

        $data = [
            'menu_id' => $request->menu_id,
            'prefix' => $prefix,
            'name' => $request->permission_name
        ];

        $checkPermission = Permission::where($data)->first();

        if ($checkPermission) {
            session()->flash('warning', 'Permission was registered, cannot duplicate permission');
            return redirect()->back();
        }


        $permission = new Permission();
        $permission->menu_id = $request->menu_id;
        $permission->prefix = $prefix;
        $permission->name = $request->permission_name;
        $permission->save();

        $this->helpers->log('Create', 'Create Permission '.$permission->name);


        session()->flash('success', 'Successfully Created Permission');

        return redirect(route('permissions.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
