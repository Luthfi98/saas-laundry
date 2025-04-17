<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Branch;
use App\Models\Tenant;

class TServiceController extends Controller
{
    public function __construct()
    {
        $this->helpers = App::make('generalhelper');
    }

    public function index()
    {
        $this->helpers->canAccess('module-service-tenant-read');

        if(request()->ajax()) {
            $tenant = Tenant::where('code', request()->route('code'))->firstOrFail();
            return datatables()->of(Service::where('tenant_id', $tenant->id)
                ->with(['category', 'branch'])
                ->select('*'))
                ->addColumn('action', function ($row) {
                    $edit = '';
                    $delete = '';
                    
                    if ($this->helpers->canAccess('module-service-tenant-update', true)) {
                        $edit .= '<a href="'.route('tenant.services.edit', ['code' => request()->route('code'), 'service' => $row->id]).'" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>';
                    }

                    if ($this->helpers->canAccess('module-service-tenant-delete', true)) {
                        $delete .= '<form id="delete-form-'.$row->id.'" action="'.route('tenant.services.destroy', ['code' => request()->route('code'), 'service' => $row->id]).'" method="POST" style="display: none;">
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
                ->addColumn('category_name', function($row) {
                    return $row->category ? $row->category->name : '-';
                })
                ->addColumn('branch_name', function($row) {
                    return $row->branch ? $row->branch->name : '-';
                })
                ->addColumn('is_active', function($row) {
                    if($row->is_active) {
                        return '<span class="badge badge-sm bg-success">Active</span>';
                    }
                    return '<span class="badge badge-sm bg-secondary">Inactive</span>';
                })
                ->rawColumns(['action', 'is_active'])
                ->addIndexColumn()
                ->make(true);
        }

        $data = [
            'title' => 'Service Management',
        ];
        return view('tenant.services.index', $data);
    }

    public function create()
    {
        $this->helpers->canAccess('module-service-tenant-create');

        $tenant = Tenant::where('code', request()->route('code'))->firstOrFail();
        $branches = Branch::where('tenant_id', $tenant->id)->get();
        $categories = ServiceCategory::where('tenant_id', $tenant->id)->get();
        
        $data = [
            'title' => 'Create Service',
            'branches' => $branches,
            'categories' => $categories,
        ];
        return view('tenant.services.create', $data);
    }

    public function store(Request $request)
    {
        $this->helpers->canAccess('module-service-tenant-create');

        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'service_category_id' => 'required|exists:service_categories,id',
            'code' => 'required|string|max:20|unique:services,code',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'unit' => 'required|string|max:20',
            'is_active' => 'required|boolean',
        ]);

        $tenant = Tenant::where('code', request()->route('code'))->firstOrFail();
        
        $service = new Service();
        $service->tenant_id = $tenant->id;
        $service->branch_id = $request->branch_id;
        $service->service_category_id = $request->service_category_id;
        $service->code = $request->code;
        $service->name = $request->name;
        $service->price = $request->price;
        $service->unit = $request->unit;
        $service->is_active = $request->is_active;
        $service->save();

        $this->helpers->log('Create', 'Create Service '.$service->name);

        return redirect()->route('tenant.services.index', ['code' => request()->route('code')])
            ->with('success', 'Service created successfully');
    }

    public function edit()
    {
        $this->helpers->canAccess('module-service-tenant-update');

        $id = request()->route('service');
        $tenant = Tenant::where('code', request()->route('code'))->firstOrFail();
        $service = Service::where('tenant_id', $tenant->id)->findOrFail($id);
        $branches = Branch::where('tenant_id', $tenant->id)->get();
        $categories = ServiceCategory::where('tenant_id', $tenant->id)->get();

        $data = [
            'title' => 'Edit Service',
            'service' => $service,
            'branches' => $branches,
            'categories' => $categories,
        ];
        return view('tenant.services.edit', $data);
    }

    public function update(Request $request)
    {
        $this->helpers->canAccess('module-service-tenant-update');

        $id = request()->route('service');
        $tenant = Tenant::where('code', request()->route('code'))->firstOrFail();
        $service = Service::where('tenant_id', $tenant->id)->findOrFail($id);

        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'service_category_id' => 'required|exists:service_categories,id',
            'code' => 'required|string|max:20|unique:services,code,'.$id,
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'unit' => 'required|string|max:20',
            'is_active' => 'required|boolean',
        ]);

        $service->branch_id = $request->branch_id;
        $service->service_category_id = $request->service_category_id;
        $service->code = $request->code;
        $service->name = $request->name;
        $service->price = $request->price;
        $service->unit = $request->unit;
        $service->is_active = $request->is_active;
        $service->save();

        $this->helpers->log('Update', 'Update Service '.$service->name);

        return redirect()->route('tenant.services.index', ['code' => request()->route('code')])
            ->with('success', 'Service updated successfully');
    }

    public function destroy()
    {
        $this->helpers->canAccess('module-service-tenant-delete');

        $id = request()->route('service');
        $tenant = Tenant::where('code', request()->route('code'))->firstOrFail();
        $service = Service::where('tenant_id', $tenant->id)->findOrFail($id);
        
        $service->delete();

        return redirect()->route('tenant.services.index', ['code' => request()->route('code')])
            ->with('success', 'Service deleted successfully');
    }
} 