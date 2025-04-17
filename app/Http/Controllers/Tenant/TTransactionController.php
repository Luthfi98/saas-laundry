<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Branch;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Service;

class TTransactionController extends Controller
{
    public function __construct()
    {
        $this->helpers = App::make('generalhelper');
    }

    public function index()
    {
        $this->helpers->canAccess('module-transaction-tenant-read');

        if(request()->ajax()) {
            $tenant = Tenant::where('code', request()->route('code'))->firstOrFail();
            return datatables()->of(Transaction::where('tenant_id', $tenant->id)
                ->with(['customer', 'branch', 'user'])
                ->select('*'))
                ->addColumn('action', function ($row) {
                    $edit = '';
                    $delete = '';
                    
                    if ($this->helpers->canAccess('module-transaction-tenant-update', true)) {
                        $edit .= '<a href="'.route('tenant.transactions.edit', ['code' => request()->route('code'), 'transaction' => $row->id]).'" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>';
                    }

                    if ($this->helpers->canAccess('module-transaction-tenant-delete', true)) {
                        $delete .= '<form id="delete-form-'.$row->id.'" action="'.route('tenant.transactions.destroy', ['code' => request()->route('code'), 'transaction' => $row->id]).'" method="POST" style="display: none;">
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
                ->addColumn('customer_name', function($row) {
                    return $row->customer ? $row->customer->name : '-';
                })
                ->addColumn('branch_name', function($row) {
                    return $row->branch ? $row->branch->name : '-';
                })
                ->addColumn('user_name', function($row) {
                    return $row->user ? $row->user->name : '-';
                })
                ->addColumn('status_badge', function($row) {
                    $statusClass = '';
                    switch($row->status) {
                        case 'pending':
                            $statusClass = 'bg-warning';
                            break;
                        case 'process':
                            $statusClass = 'bg-info';
                            break;
                        case 'done':
                            $statusClass = 'bg-success';
                            break;
                        case 'picked_up':
                            $statusClass = 'bg-primary';
                            break;
                        default:
                            $statusClass = 'bg-secondary';
                    }
                    return '<span class="badge badge-sm '.$statusClass.'">'.ucfirst($row->status).'</span>';
                })
                ->rawColumns(['action', 'status_badge'])
                ->addIndexColumn()
                ->make(true);
        }

        $data = [
            'title' => 'Transaction Management',
        ];
        return view('tenant.transactions.index', $data);
    }

    public function create()
    {
        $this->helpers->canAccess('module-transaction-tenant-create');

        $tenant = Tenant::where('code', request()->route('code'))->firstOrFail();
        $branches = Branch::where('tenant_id', $tenant->id)->get();
        $customers = Customer::where('tenant_id', $tenant->id)->get();
        $users = User::where('tenant_id', $tenant->id)->get();
        
        $data = [
            'title' => 'Create Transaction',
            'branches' => $branches,
            'customers' => $customers,
            'users' => $users,
        ];
        return view('tenant.transactions.create', $data);
    }

    public function pos()
    {
        $this->helpers->canAccess('module-transaction-tenant-create');

        $tenant = Tenant::where('code', request()->route('code'))->firstOrFail();
        $branches = Branch::where('tenant_id', $tenant->id)->get();
        $customers = Customer::where('tenant_id', $tenant->id)->get();
        $users = User::where('tenant_id', $tenant->id)->get();
        $services = Service::where('tenant_id', $tenant->id)
            ->with('category')
            ->get();
        
        $data = [
            'title' => 'POS Transaction',
            'tenant' => $tenant,
            'branches' => $branches,
            'customers' => $customers,
            'users' => $users,
            'services' => $services,
        ];
        return view('tenant.transactions.pos', $data);
    }

    public function store(Request $request)
    {
        $this->helpers->canAccess('module-transaction-tenant-create');

        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'customer_id' => 'required|exists:customers,id',
            'user_id' => 'required|exists:users,id',
            'invoice_number' => 'required|string|max:50|unique:transactions,invoice_number',
            'code' => 'required|string|max:20',
            'transaction_date' => 'required|date',
            'pickup_date' => 'nullable|date',
            'status' => 'required|in:pending,process,done,picked_up',
            'total' => 'required|numeric|min:0',
            'paid' => 'required|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:services,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        $tenant = Tenant::where('code', request()->route('code'))->firstOrFail();
        
        $transaction = new Transaction();
        $transaction->tenant_id = $tenant->id;
        $transaction->branch_id = $request->branch_id;
        $transaction->customer_id = $request->customer_id;
        $transaction->user_id = $request->user_id;
        $transaction->invoice_number = $request->invoice_number;
        $transaction->code = $request->code;
        $transaction->transaction_date = $request->transaction_date;
        $transaction->pickup_date = $request->pickup_date;
        $transaction->status = $request->status;
        $transaction->total = $request->total;
        $transaction->paid = $request->paid;
        $transaction->save();

        // Save transaction items
        foreach ($request->items as $item) {
            $transaction->services()->attach($item['id'], [
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $item['quantity'] * $item['price']
            ]);
        }

        $this->helpers->log('Create', 'Create Transaction '.$transaction->invoice_number);

        return redirect()->route('tenant.transactions.index', ['code' => request()->route('code')])
            ->with('success', 'Transaction created successfully');
    }

    public function edit()
    {
        $this->helpers->canAccess('module-transaction-tenant-update');

        $id = request()->route('transaction');
        $tenant = Tenant::where('code', request()->route('code'))->firstOrFail();
        $transaction = Transaction::where('tenant_id', $tenant->id)->findOrFail($id);
        $branches = Branch::where('tenant_id', $tenant->id)->get();
        $customers = Customer::where('tenant_id', $tenant->id)->get();
        $users = User::where('tenant_id', $tenant->id)->get();

        $data = [
            'title' => 'Edit Transaction',
            'transaction' => $transaction,
            'branches' => $branches,
            'customers' => $customers,
            'users' => $users,
        ];
        return view('tenant.transactions.edit', $data);
    }

    public function update(Request $request)
    {
        $this->helpers->canAccess('module-transaction-tenant-update');

        $id = request()->route('transaction');
        $tenant = Tenant::where('code', request()->route('code'))->firstOrFail();
        $transaction = Transaction::where('tenant_id', $tenant->id)->findOrFail($id);

        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'customer_id' => 'required|exists:customers,id',
            'user_id' => 'required|exists:users,id',
            'invoice_number' => 'required|string|max:50|unique:transactions,invoice_number,'.$id,
            'code' => 'required|string|max:20',
            'transaction_date' => 'required|date',
            'pickup_date' => 'nullable|date',
            'status' => 'required|in:pending,process,done,picked_up',
            'total' => 'required|numeric|min:0',
            'paid' => 'required|numeric|min:0',
        ]);

        $transaction->branch_id = $request->branch_id;
        $transaction->customer_id = $request->customer_id;
        $transaction->user_id = $request->user_id;
        $transaction->invoice_number = $request->invoice_number;
        $transaction->code = $request->code;
        $transaction->transaction_date = $request->transaction_date;
        $transaction->pickup_date = $request->pickup_date;
        $transaction->status = $request->status;
        $transaction->total = $request->total;
        $transaction->paid = $request->paid;
        $transaction->save();

        $this->helpers->log('Update', 'Update Transaction '.$transaction->invoice_number);

        return redirect()->route('tenant.transactions.index', ['code' => request()->route('code')])
            ->with('success', 'Transaction updated successfully');
    }

    public function destroy()
    {
        $this->helpers->canAccess('module-transaction-tenant-delete');

        $id = request()->route('transaction');
        $tenant = Tenant::where('code', request()->route('code'))->firstOrFail();
        $transaction = Transaction::where('tenant_id', $tenant->id)->findOrFail($id);
        
        $transaction->delete();

        return redirect()->route('tenant.transactions.index', ['code' => request()->route('code')])
            ->with('success', 'Transaction deleted successfully');
    }
} 