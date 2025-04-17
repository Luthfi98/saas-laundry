<?php

namespace App\Http\Controllers\Cms;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class SubscriptionController extends Controller
{
    private $helpers;

    public function __construct() {
        $this->helpers = App::make('generalhelper');
    }

    public function index() {
        $this->helpers->canAccess('module-subscription-index');

        if(request()->ajax()) {

            return datatables()->of(Subscription::select('*'))
            ->addColumn('action', function ($row) {
                $edit = '';
                $delete = '';
                $detail = '';
                if ($this->helpers->canAccess('module-subscription-detail', true)) {
                    $detail .= '<a href="'.route('subscriptions.show', $row->id).'" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Detail">
                                <i class="fa-solid fa-eye"></i>
                            </a>';
                }

                if ($this->helpers->canAccess('module-subscription-update', true)) {
                    $edit .= '<a href="'.route('subscriptions.edit', $row->id).'" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                                <i class="fa-solid fa-pencil"></i>
                            </a>';
                }

                if ($this->helpers->canAccess('module-subscription-delete', true)) {
                    $delete .= '<form id="delete-form-'.$row->id.'" action="'.route('subscriptions.destroy', $row->id).'" method="POST" style="display: none;">
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
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $data = ['title' => 'List Subscriptions'];
        return view('cms.subscriptions.index', $data);
    }

    public function create()
    {
        $this->helpers->canAccess('module-subscription-create');

        $data = ['title' => 'Create Subscription'];
        return view('cms.subscriptions.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->helpers->canAccess('module-subscription-create');

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'branch_limit' => 'required|numeric',
            'user_limit' => 'required|numeric',
            'features' => 'nullable|string',
            'duration_in_days' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return redirect(route('subscriptions.create'))
                ->withErrors($validator)
                ->withInput();
        }

        $subscription = new Subscription();
        $subscription->code = uniqid();
        $subscription->name = $request->name;
        $subscription->price = $request->price;
        $subscription->branch_limit = $request->branch_limit;
        $subscription->user_limit = $request->user_limit;
        $subscription->features = $request->features;
        $subscription->duration_in_days = $request->duration_in_days;
        $subscription->status = $request->status??'inactive';
        $subscription->save();
        $this->helpers->log('Create', 'Create Subscription '.$subscription->name);


        session()->flash('success', 'Successfully Created Subscription');

        return redirect(route('subscriptions.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->helpers->canAccess('module-subscription-detail');

        $data = [
            'title' => 'Detail Subscription',
            'subscription' => Subscription::find($id)
        ];

        return view('cms.subscriptions.show', $data);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscription $subscription)
    {
        $this->helpers->canAccess('module-subscription-update');

        $data = [
            'title' => 'Edit Subscription',
            'subscription' => $subscription
        ];

        return view('cms.subscriptions.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subscription $subscription)
    {
        $this->helpers->canAccess('module-subscription-update');

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'branch_limit' => 'required|numeric',
            'user_limit' => 'required|numeric',
            'features' => 'required|string',
            'duration_in_days' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return redirect(route('subscriptions.edit', $subscription->id))
                ->withErrors($validator)
                ->withInput();
        }
        $subscription->name = $request->name;
        $subscription->price = $request->price;
        $subscription->branch_limit = $request->branch_limit;
        $subscription->user_limit = $request->user_limit;
        $subscription->features = $request->features;
        $subscription->duration_in_days = $request->duration_in_days;
        $subscription->status = $request->status??'inactive';
        $subscription->save();
        $this->helpers->log('Edit', 'Edit Subscription '.$subscription->name);

        session()->flash('success', 'Successfully Updated Subscription');

        return redirect(route('subscriptions.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        $this->helpers->canAccess('module-subscription-delete');

        $subscription->delete();
        $this->helpers->log('Delete', 'Delete Subscription '.$subscription->name);

        session()->flash('success', 'Successfully Deleted Subscription');

        return redirect(route('subscriptions.index'));
    }
}
