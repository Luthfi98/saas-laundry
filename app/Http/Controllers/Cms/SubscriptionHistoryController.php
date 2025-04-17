<?php

namespace App\Http\Controllers\Cms;

use App\Models\SubscriptionHistory;
use App\Models\Subscription;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class SubscriptionHistoryController extends Controller
{
    private $helpers;

    public function __construct() {
        $this->helpers = App::make('generalhelper');
    }

    public function index() {
        $this->helpers->canAccess('module-subscription-history-index');

        if(request()->ajax()) {

            return datatables()->of(SubscriptionHistory::with(['tenant', 'subscription'])->select('*'))
            ->addColumn('action', function ($row) {
                $edit = '';
                $delete = '';
                $detail = '';
                if ($this->helpers->canAccess('module-subscription-history-detail', true)) {
                    $detail .= '<a href="'.route('subscription-histories.show', $row->id).'" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Detail">
                                <i class="fa-solid fa-eye"></i>
                            </a>';
                }

                if ($this->helpers->canAccess('module-subscription-history-update', true)) {
                    $edit .= '<a href="'.route('subscription-histories.edit', $row->id).'" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                                <i class="fa-solid fa-pencil"></i>
                            </a>';
                }

                if ($this->helpers->canAccess('module-subscription-history-delete', true)) {
                    $delete .= '<form id="delete-form-'.$row->id.'" action="'.route('subscription-histories.destroy', $row->id).'" method="POST" style="display: none;">
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
            ->addColumn('tenant_name', function ($row) {
                return $row->tenant->name ?? 'N/A';
            })
            ->addColumn('subscription_name', function ($row) {
                return $row->subscription->name ?? 'N/A';
            })
            ->addColumn('status', function ($row) {
                $badgeClass = '';
                switch($row->status) {
                    case 'active':
                        $badgeClass = 'badge-success';
                        break;
                    case 'expired':
                        $badgeClass = 'badge-danger';
                        break;
                    case 'cancelled':
                        $badgeClass = 'badge-warning';
                        break;
                    case 'pending':
                        $badgeClass = 'badge-info';
                        break;
                    default:
                        $badgeClass = 'badge-secondary';
                }
                return '<span class="badge badge-sm '.$badgeClass.'">'.ucfirst($row->status).'</span>';
            })
            ->rawColumns(['action', 'status'])
            ->addIndexColumn()
            ->make(true);
        }
        $data = ['title' => 'List Subscription Histories'];
        return view('cms.subscription-histories.index', $data);
    }

    public function create()
    {
        $this->helpers->canAccess('module-subscription-history-create');

        $data = [
            'title' => 'Create Subscription History',
            'tenants' => Tenant::all(),
            'subscriptions' => Subscription::all()
        ];
        return view('cms.subscription-histories.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->helpers->canAccess('module-subscription-history-create');

        $validator = Validator::make($request->all(), [
            'tenant_id' => 'required|exists:tenants,id',
            'subscription_id' => 'required|exists:subscriptions,id',
            'code' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'price' => 'required|numeric',
            'status' => 'required|in:active,expired,cancelled,pending',
            'payment_method' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return redirect(route('subscription-histories.create'))
                ->withErrors($validator)
                ->withInput();
        }

        $subscriptionHistory = new SubscriptionHistory();
        $subscriptionHistory->tenant_id = $request->tenant_id;
        $subscriptionHistory->subscription_id = $request->subscription_id;
        $subscriptionHistory->code = $request->code;
        $subscriptionHistory->start_date = $request->start_date;
        
        // If status is active, calculate end_date based on subscription duration_in_days
        if ($request->status === 'active') {
            $subscription = Subscription::find($request->subscription_id);
            if ($subscription && $subscription->duration_in_days) {
                $startDate = \Carbon\Carbon::parse($request->start_date);
                $subscriptionHistory->end_date = $startDate->addDays($subscription->duration_in_days);
            } else {
                $subscriptionHistory->end_date = $request->end_date;
            }
        } else {
            $subscriptionHistory->end_date = $request->end_date;
        }
        
        $subscriptionHistory->price = $request->price;
        $subscriptionHistory->status = $request->status;
        $subscriptionHistory->payment_method = $request->payment_method;
        $subscriptionHistory->notes = $request->notes;
        $subscriptionHistory->save();
        $this->helpers->log('Create', 'Create Subscription History '.$subscriptionHistory->code);


        session()->flash('success', 'Successfully Created Subscription History');

        return redirect(route('subscription-histories.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->helpers->canAccess('module-subscription-history-detail');

        $data = [
            'title' => 'Detail Subscription History',
            'subscriptionHistory' => SubscriptionHistory::with(['tenant', 'subscription'])->find($id)
        ];

        return view('cms.subscription-histories.show', $data);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubscriptionHistory $subscriptionHistory)
    {
        $this->helpers->canAccess('module-subscription-history-update');

        $data = [
            'title' => 'Edit Subscription History',
            'subscriptionHistory' => $subscriptionHistory,
            'tenants' => Tenant::all(),
            'subscriptions' => Subscription::all()
        ];

        return view('cms.subscription-histories.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubscriptionHistory $subscriptionHistory)
    {
        $this->helpers->canAccess('module-subscription-history-update');

        $validator = Validator::make($request->all(), [
            'tenant_id' => 'required|exists:tenants,id',
            'subscription_id' => 'required|exists:subscriptions,id',
            'code' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'price' => 'required|numeric',
            'status' => 'required|in:active,expired,cancelled,pending',
            'payment_method' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return redirect(route('subscription-histories.edit', $subscriptionHistory->id))
                ->withErrors($validator)
                ->withInput();
        }
        $subscriptionHistory->tenant_id = $request->tenant_id;
        $subscriptionHistory->subscription_id = $request->subscription_id;
        $subscriptionHistory->code = $request->code;
        $subscriptionHistory->start_date = $request->start_date;
        
        // If status is active, calculate end_date based on subscription duration_in_days
        if ($request->status === 'active') {
            $subscription = Subscription::find($request->subscription_id);
            
            if ($subscription && $subscription->duration_in_days) {
                $startDate = \Carbon\Carbon::parse($request->start_date);
                $subscriptionHistory->end_date = $startDate->addDays($subscription->duration_in_days);
            } else {
                $subscriptionHistory->end_date = $request->end_date;
            }
        } else {
            $subscriptionHistory->end_date = $request->end_date;
        }
        
        $subscriptionHistory->price = $request->price;
        $subscriptionHistory->status = $request->status;
        $subscriptionHistory->payment_method = $request->payment_method;
        $subscriptionHistory->notes = $request->notes;
        $subscriptionHistory->save();
        $this->helpers->log('Edit', 'Edit Subscription History '.$subscriptionHistory->code);

        session()->flash('success', 'Successfully Updated Subscription History');

        return redirect(route('subscription-histories.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubscriptionHistory $subscriptionHistory)
    {
        $this->helpers->canAccess('module-subscription-history-delete');

        $subscriptionHistory->delete();
        $this->helpers->log('Delete', 'Delete Subscription History '.$subscriptionHistory->code);

        session()->flash('success', 'Successfully Deleted Subscription History');

        return redirect(route('subscription-histories.index'));
    }
} 