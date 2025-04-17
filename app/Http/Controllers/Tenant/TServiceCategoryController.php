<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\ServiceCategory;
use App\Models\Branch;
use App\Models\Tenant;

class TServiceCategoryController extends Controller
{
    public function __construct()
    {
        $this->helpers = App::make('generalhelper');
    }

    public function index()
    {
        $this->helpers->canAccess('module-service-category-tenant-read');

        if(request()->ajax()) {
            $tenant = Tenant::where('code', request()->route('code'))->firstOrFail();
            return datatables()->of(ServiceCategory::where('tenant_id', $tenant->id)
                ->with(['branch'])
                ->select('*'))
                ->addColumn('action', function ($row) {
                    $edit = '';
                    $delete = '';
                    
                    if ($this->helpers->canAccess('module-service-category-tenant-update', true)) {
                        $edit .= '<a href="'.route('tenant.service-categories.edit', ['code' => request()->route('code'), 'serviceCategory' => $row->id]).'" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>';
                    }

                    if ($this->helpers->canAccess('module-service-category-tenant-delete', true)) {
                        $delete .= '<form id="delete-form-'.$row->id.'" action="'.route('tenant.service-categories.destroy', ['code' => request()->route('code'), 'serviceCategory' => $row->id]).'" method="POST" style="display: none;">
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
            'title' => 'Service Category Management',
        ];
        return view('tenant.service-categories.index', $data);
    }

    public function create()
    {
        $this->helpers->canAccess('module-service-category-tenant-create');

        $tenant = Tenant::where('code', request()->route('code'))->firstOrFail();
        $branches = Branch::where('tenant_id', $tenant->id)->get();
        
        $data = [
            'title' => 'Create Service Category',
            'branches' => $branches,
        ];
        return view('tenant.service-categories.create', $data);
    }

    public function store(Request $request)
    {
        $this->helpers->canAccess('module-service-category-tenant-create');

        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'name' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        $tenant = Tenant::where('code', request()->route('code'))->firstOrFail();
        
        $serviceCategory = new ServiceCategory();
        $serviceCategory->tenant_id = $tenant->id;
        $serviceCategory->branch_id = $request->branch_id;
        $serviceCategory->name = $request->name;
        $serviceCategory->is_active = $request->is_active;
        $serviceCategory->save();

        $this->helpers->log('Create', 'Create Service Category '.$serviceCategory->name);

        return redirect()->route('tenant.service-categories.index', ['code' => request()->route('code')])
            ->with('success', 'Service Category created successfully');
    }

    public function edit()
    {
        $this->helpers->canAccess('module-service-category-tenant-update');

        $id = request()->route('serviceCategory');
        $tenant = Tenant::where('code', request()->route('code'))->firstOrFail();
        $serviceCategory = ServiceCategory::where('tenant_id', $tenant->id)->findOrFail($id);
        $branches = Branch::where('tenant_id', $tenant->id)->get();

        $data = [
            'title' => 'Edit Service Category',
            'serviceCategory' => $serviceCategory,
            'branches' => $branches,
        ];
        return view('tenant.service-categories.edit', $data);
    }

    public function update(Request $request)
    {
        $this->helpers->canAccess('module-service-category-tenant-update');

        $id = request()->route('serviceCategory');
        $tenant = Tenant::where('code', request()->route('code'))->firstOrFail();
        $serviceCategory = ServiceCategory::where('tenant_id', $tenant->id)->findOrFail($id);

        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'name' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        $serviceCategory->branch_id = $request->branch_id;
        $serviceCategory->name = $request->name;
        $serviceCategory->is_active = $request->is_active;
        $serviceCategory->save();

        $this->helpers->log('Update', 'Update Service Category '.$serviceCategory->name);

        return redirect()->route('tenant.service-categories.index', ['code' => request()->route('code')])
            ->with('success', 'Service Category updated successfully');
    }

    public function destroy()
    {
        $this->helpers->canAccess('module-service-category-tenant-delete');

        $id = request()->route('serviceCategory');
        $tenant = Tenant::where('code', request()->route('code'))->firstOrFail();
        $serviceCategory = ServiceCategory::where('tenant_id', $tenant->id)->findOrFail($id);
        
        $serviceCategory->delete();

        return redirect()->route('tenant.service-categories.index', ['code' => request()->route('code')])
            ->with('success', 'Service Category deleted successfully');
    }
} 