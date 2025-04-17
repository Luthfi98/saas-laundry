<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Branch;
use App\Models\Tenant;

class TBranchController extends Controller
{
    public function __construct()
    {
        $this->helpers = App::make('generalhelper');
    }

    public function index()
    {
        $this->helpers->canAccess('module-branch-tenant-read');

        if(request()->ajax()) {
            $tenant = Tenant::where('code', request()->route('code'))->firstOrFail();
            return datatables()->of(Branch::where('tenant_id', $tenant->id)->select('*'))
                ->addColumn('action', function ($row) {
                    $edit = '';
                    $delete = '';
                    
                    if ($this->helpers->canAccess('module-branch-tenant-update', true)) {
                        $edit .= '<a href="'.route('tenant.branch.edit', ['code' => request()->route('code'), 'id' => $row->id]).'" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>';
                    }

                    if ($this->helpers->canAccess('module-branch-tenant-delete', true)) {
                        $delete .= '<form id="delete-form-'.$row->id.'" action="'.route('tenant.branch.destroy', ['code' => request()->route('code'), 'id' => $row->id]).'" method="POST" style="display: none;">
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
                ->addColumn('status', function($row) {
                    if($row->is_active) {
                        return '<span class="badge badge-sm bg-success">Active</span>';
                    }
                    return '<span class="badge badge-sm bg-secondary">Inactive</span>';
                })
                ->rawColumns(['action', 'status'])
                ->addIndexColumn()
                ->make(true);
        }

        $data = [
            'title' => 'Branch Management',
        ];
        return view('tenant.branch.index', $data);
    }

    public function create()
    {
        $this->helpers->canAccess('module-branch-tenant-create');

        $data = [
            'title' => 'Create Branch',
        ];
        return view('tenant.branch.create', $data);
    }

    public function store(Request $request)
    {
        $this->helpers->canAccess('module-branch-tenant-create');

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'status' => 'required|in:active,inactive',
        ]);

        $tenant = Tenant::where('code', request()->route('code'))->firstOrFail();
        
        $branch = new Branch();
        $branch->tenant_id = $tenant->id;
        $branch->code = 'BR-' . strtoupper(uniqid());
        $branch->name = $request->name;
        $branch->address = $request->address;
        $branch->phone = $request->phone;
        $branch->is_active = $request->status == 'active';
        $branch->save();

        $this->helpers->log('Create', 'Create Branch '.$branch->name);

        return redirect()->route('tenant.branch.index', ['code' => request()->route('code')])
            ->with('success', 'Branch created successfully');
    }

    public function edit()
    {
        $this->helpers->canAccess('module-branch-tenant-update');

        $id = request()->route('id');
        $tenant = Tenant::where('code', request()->route('code'))->firstOrFail();
        $branch = Branch::where('tenant_id', $tenant->id)->findOrFail($id);

        $data = [
            'title' => 'Edit Branch',
            'branch' => $branch,
        ];
        return view('tenant.branch.edit', $data);
    }

    public function update(Request $request)
    {
        $this->helpers->canAccess('module-branch-tenant-update');

        $id = request()->route('id');
        $tenant = Tenant::where('code', request()->route('code'))->firstOrFail();
        $branch = Branch::where('tenant_id', $tenant->id)->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'status' => 'required|in:active,inactive',
        ]);

        $branch->name = $request->name;
        $branch->address = $request->address;
        $branch->phone = $request->phone;
        $branch->is_active = $request->status == 'active';
        $branch->save();

        $this->helpers->log('Update', 'Update Branch '.$branch->name);

        return redirect()->route('tenant.branch.index', ['code' => request()->route('code')])
            ->with('success', 'Branch updated successfully');
    }

    public function destroy()
    {
        $this->helpers->canAccess('module-branch-delete');

        $id = request()->route('id');
        $tenant = Tenant::where('code', request()->route('code'))->firstOrFail();
        $branch = Branch::where('tenant_id', $tenant->id)->findOrFail($id);
        
        $branch->delete();

        return redirect()->route('tenant.branch.index', ['code' => request()->route('code')])
            ->with('success', 'Branch deleted successfully');
    }
} 