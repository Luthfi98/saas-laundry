<?php

namespace App\Http\Controllers\Cms;

use App\Helpers\GeneralHelper;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class WebsiteController extends Controller
{
    private $helpers;

    public function __construct() {
        $this->helpers = App::make('generalhelper');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->helpers->canAccess('module-website-show');
        $this->helpers->canAccess('module-website-read');
        $settingPath = storage_path('settings.json');
        $jsonContents = file_get_contents($settingPath);

        // Decode the JSON content
        $setting = json_decode($jsonContents);
        $data = ['title' => 'Website Setting', 'data' => $setting];
        return view('cms.setting', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->helpers->canAccess('module-website-update');

        $rules = [
            'name'              => 'required|string',
            // 'description'       => 'required|string',
            // 'name_sender_email' => 'required|string',
            // 'sender_email'      => 'required|string',
            // 'password_email'    => 'required|string',
            // 'name_sender_wa'    => 'required|string',
            // 'sender_wa'         => 'required|string|numeric',
            // 'url_api_wa'        => 'required|string',
            // 'key_wa'            => 'required|string',
        ];

        $data = $request->input();
        unset($data['_token']);

        if($request->hasFile('logo'))
        {
            $rules[] = [
                'logo' => 'required|file|max:2048|mimes:jpeg,png,jpg'
            ];
        }

        if($request->hasFile('icon'))
        {
            $rules[] = [
                'icon' => 'required|file|max:2048|mimes:jpeg,png,jpg'
            ];
        }

        $validator = Validator::make($request->all(), $rules);

        // dd($request->hasFile('image'));

        if ($validator->fails()) {
            return redirect(route('website.index'))
                ->withErrors($validator)
                ->withInput();
        }

        $settingPath = storage_path('settings.json');
        $jsonContents = file_get_contents($settingPath);

        // Decode the JSON content
        $setting = json_decode($jsonContents);
        $data['logo'] = $setting->logo??'';
        $data['icon'] = $setting->icon??'';

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_logo_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/website'), $filename);
            $logo = 'uploads/website/' . $filename;
            $data['logo'] = $logo;
        }

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $filename = time() . '_icon_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/website'), $filename);
            $icon = 'uploads/website/' . $filename;
            $data['icon'] = $icon;
        }
        $data['notif_wa'] = $request->notif_wa;
        $data['notif_email'] = $request->notif_email;

        $settingPath = storage_path('settings.json');
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);

        file_put_contents($settingPath, $jsonData);



        session()->flash('success', 'Successfully Updated Data');

        return redirect(route('website.index'));
    }

    public function userActivity($id = null)
    {
        $this->helpers->canAccess('module-activity-user-show');
        if(request()->ajax()) {
            $this->helpers->canAccess('module-activity-user-read');
            $activity = Activity::select('*')->with('user')->orderBy('id', 'desc');
            if (request()->has('start_date')) {
                $start_date = request()->input('start_date');
                if (!empty($start_date)) {
                    $activity->where('created_at', '>=', $start_date);
                }
            }
            if (request()->has('end_date')) {
                $end_date = request()->input('end_date');
                if (!empty($end_date)) {
                    $activity->where('created_at', '<=', $end_date);
                }
            }
            if (request()->has('type')) {
                $type = request()->input('type');
                if (!empty($type)) {
                    $activity->where('type', $type);
                }
            }



            return datatables()->of($activity)
            ->editColumn('created_at', function(Activity $activity){
                return date('d-m-Y H:i:s', strtotime($activity->created_at));
            })
            ->addColumn('user', function(Activity $activity){
                return $activity->user?->fullname;
            })
            ->addColumn('action', function ($row) {

                $detail = '';
                // $delete = '';

                if($this->helpers->canAccess('module-activity-user-detail', true))
                {
                    $detail .= '<a href="'.url('cms/report-activity-user/'.$row->id).'" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Edit">
                                <i class="fa-solid fa-eye"></i>
                            </a>';
                }

                $button = $detail;
                return '
                    <div class="btn-group">
                    '.$button.'
                    </div>';

            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }

        if ($id) {
            $activity = Activity::find($id);
            if(!$activity){
                session()->flash('warning', 'Activity Not Found');

                return redirect(route('report-activity-user'));
            }
            $data = [
                'title' => 'Detail Activity',
                'activity' => $activity
            ];
            $dataActivity = json_decode($data['activity']->data);
            $data['data'] = $this->helpers->detailActivity($dataActivity);
            // die;
            // dd($data['data']);

            return view('cms.activities.detail', $data);
        }else{
            $data = [
                'title' => 'Activity User',
            ];

            return view('cms.activities.index', $data);

        }

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
