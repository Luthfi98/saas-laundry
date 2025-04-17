<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\Facades\DataTables;

class TCustomerController extends Controller
{
    public function __construct()
    {
        $this->helpers = App::make('generalhelper');
    }

    public function index()
    {
        $this->helpers->canAccess('module-customer-tenant-read');

        if(request()->ajax()) {
            $tenant = Tenant::where('code', request()->route('code'))->firstOrFail();
            return datatables()->of(Customer::where('tenant_id', $tenant->id)
                ->select('*'))
                ->addColumn('action', function ($row) {
                    $edit = '';
                    $delete = '';
                    
                    if ($this->helpers->canAccess('module-customer-tenant-update', true)) {
                        $edit .= '<a href="'.route('tenant.customer.edit', ['code' => request()->route('code'), 'customer' => $row->id]).'" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>';
                    }

                    if ($this->helpers->canAccess('module-customer-tenant-delete', true)) {
                        $delete .= '<form id="delete-form-'.$row->id.'" action="'.route('tenant.customer.destroy', ['code' => request()->route('code'), 'customer' => $row->id]).'" method="POST" style="display: none;">
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
            'title' => 'Customer Management',
        ];
        return view('tenant.customers.index', $data);
    }

    public function create()
    {
        $this->helpers->canAccess('module-customer-tenant-create');
        
        $data = [
            'title' => 'Create Customer',
        ];
        return view('tenant.customers.create', $data);
    }

    public function store(Request $request)
    {
        $this->helpers->canAccess('module-customer-tenant-create');

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string'
        ]);

        $tenant = Tenant::where('code', request()->route('code'))->firstOrFail();
        
        $customer = new Customer();
        $customer->tenant_id = $tenant->id;
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->save();

        $this->helpers->log('Create', 'Create Customer '.$customer->name);

        return redirect()->route('tenant.customer.index', ['code' => request()->route('code')])
            ->with('success', 'Customer created successfully');
    }

    public function edit()
    {
        $this->helpers->canAccess('module-customer-tenant-update');

        $id = request()->route('customer');
        $tenant = Tenant::where('code', request()->route('code'))->firstOrFail();
        $customer = Customer::where('tenant_id', $tenant->id)->findOrFail($id);

        $data = [
            'title' => 'Edit Customer',
            'customer' => $customer,
        ];
        return view('tenant.customers.edit', $data);
    }

    public function update(Request $request)
    {
        $this->helpers->canAccess('module-customer-tenant-update');

        $id = request()->route('customer');
        $tenant = Tenant::where('code', request()->route('code'))->firstOrFail();
        $customer = Customer::where('tenant_id', $tenant->id)->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string'
        ]);

        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->save();

        $this->helpers->log('Update', 'Update Customer '.$customer->name);

        return redirect()->route('tenant.customer.index', ['code' => request()->route('code')])
            ->with('success', 'Customer updated successfully');
    }

    public function destroy()
    {
        $this->helpers->canAccess('module-customer-tenant-delete');

        $id = request()->route('customer');
        $tenant = Tenant::where('code', request()->route('code'))->firstOrFail();
        $customer = Customer::where('tenant_id', $tenant->id)->findOrFail($id);
        
        $customer->delete();

        return redirect()->route('tenant.customer.index', ['code' => request()->route('code')])
            ->with('success', 'Customer deleted successfully');
    }
} 