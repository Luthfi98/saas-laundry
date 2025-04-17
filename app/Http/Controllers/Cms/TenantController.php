<?php

namespace App\Http\Controllers\Cms;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TenantController extends Controller
{
    private $helpers;

    public function __construct() {
        $this->helpers = App::make('generalhelper');
    }

    public function index() {
        $this->helpers->canAccess('module-tenant-index');

        if(request()->ajax()) {

            return datatables()->of(Tenant::select('*'))
                ->editColumn('logo', function ($row) {
                    return $row->logo ? '<img src="'.asset($row->logo).'" width="50" />' : '';
                })
            ->addColumn('action', function ($row) {
                $edit = '';
                $delete = '';
                $detail = '';
                if ($this->helpers->canAccess('module-tenant-detail', true)) {
                    // $detail .= '<a href="'.route('tenants.show', $row->code).'" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Detail">
                    //             <i class="fa-solid fa-eye"></i>
                    //         </a>';
                            $detail .= '<a href="'.url('/'.$row->code).'" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Detail">
                            <i class="fa-solid fa-eye"></i>
                        </a>';
            
                }

                if ($this->helpers->canAccess('module-tenant-update', true)) {
                    $edit .= '<a href="'.route('tenants.edit', $row->id).'" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                                <i class="fa-solid fa-pencil"></i>
                            </a>';
                }

                if ($this->helpers->canAccess('module-tenant-delete', true)) {
                    $delete .= '<form id="delete-form-'.$row->id.'" action="'.route('tenants.destroy', $row->id).'" method="POST" style="display: none;">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                            </form>
                            <a href="#" onclick="showConfirm('.$row->id.')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>';
                }

                $button = $detail.$edit.$delete;

                return '
                    <div class="btn-group">
                        '.$button.'
                    </div>';

            })
            ->rawColumns(['action', 'logo'])
            ->addIndexColumn()
            ->make(true);
        }
        $data = ['title' => 'List Tenants'];
        return view('cms.tenants.index', $data);
    }

    public function create()
    {
        $this->helpers->canAccess('module-tenant-create');

        $data = ['title' => 'Create Tenant'];
        return view('cms.tenants.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->helpers->canAccess('module-tenant-create');

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:tenants',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,inactive',
        ]);
        if ($validator->fails()) {
            return redirect(route('tenants.create'))
                ->withErrors($validator)
                ->withInput();
        }

        $tenant = new Tenant();
        $tenant->code = uniqid();
        $tenant->name = $request->name;
        $tenant->email = $request->email;
        $tenant->phone = $request->phone;
        $tenant->address = $request->address;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_logo_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/tenant'), $filename);
            $logo = 'uploads/tenant/' . $filename;
            $tenant->logo = $logo;
        }
        $tenant->save();
        $this->helpers->log('Create', 'Create Tenant '.$tenant->name);


        session()->flash('success', 'Successfully Created Tenant');

        return redirect(route('tenants.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $code)
    {
        $this->helpers->canAccess('module-tenant-detail');

        $data = [
            'title' => 'Detail Tenant',
            'tenant' => Tenant::where('code', $code)->firstOrFail()
        ];

        return view('cms.tenants.show', $data);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        $this->helpers->canAccess('module-tenant-update');

        $data = [
            'title' => 'Edit Tenant',
            'tenant' => $tenant
        ];

        return view('cms.tenants.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        $this->helpers->canAccess('module-tenant-update');

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|string|in:active,inactive',
        ]);
        if ($validator->fails()) {
            return redirect(route('tenants.edit', $tenant->id))
                ->withErrors($validator)
                ->withInput();
        }
        $tenant->name = $request->name;
        $tenant->email = $request->email;
        $tenant->phone = $request->phone;
        $tenant->address = $request->address;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_logo_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/tenant'), $filename);
            $logo = 'uploads/tenant/' . $filename;
            $tenant->logo = $logo;
        }
        $tenant->status = $request->status??'inactive';
        $tenant->save();
        $this->helpers->log('Edit', 'Edit Tenant '.$tenant->name);

        session()->flash('success', 'Successfully Updated Tenant');

        return redirect(route('tenants.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        $this->helpers->canAccess('module-tenant-delete');

        $tenant->delete();
        $this->helpers->log('Delete', 'Delete Tenant '.$tenant->name);

        session()->flash('success', 'Successfully Deleted Tenant');

        return redirect(route('tenants.index'));
    }
}
