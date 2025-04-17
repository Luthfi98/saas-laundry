@extends('layouts.tenant')

@section('title'){{ $title }}@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Left side - Product Selection -->
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Select Services</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="input-group">
                                <input type="text" id="search-service" class="form-control" placeholder="Search services...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" id="search-btn">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="services-table">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Unit</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($services as $service)
                                        <tr>
                                            <td>{{ $service->code }}</td>
                                            <td>{{ $service->name }}</td>
                                            <td>{{ $service->category->name }}</td>
                                            <td>Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                                            <td>{{ $service->unit }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-primary add-to-cart" 
                                                    data-id="{{ $service->id }}" 
                                                    data-code="{{ $service->code }}"
                                                    data-name="{{ $service->name }}"
                                                    data-price="{{ $service->price }}"
                                                    data-unit="{{ $service->unit }}">
                                                    <i class="fa fa-plus"></i> Add
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right side - Cart and Customer Info -->
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Transaction Details</h3>
                </div>
                <div class="card-body">
                    <form id="transaction-form" action="{{ route('tenant.transactions.store', ['code' => request()->route('code')]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="tenant_id" value="{{ $tenant->id }}">
                        
                        <!-- Customer Selection -->
                        <div class="form-group row">
                            <label for="customer_id" class="col-sm-2 col-form-label">Customer</label>
                            <div class="col-sm-10">
                                <select name="customer_id" id="customer_id" class="form-control @error('customer_id') is-invalid @enderror" required>
                                    <option value="">Select Customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->name }} - {{ $customer->phone }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Branch Selection -->
                        <div class="form-group row">
                            <label for="branch_id" class="col-sm-2 col-form-label">Branch</label>
                            <div class="col-sm-10">
                                <select name="branch_id" id="branch_id" class="form-control @error('branch_id') is-invalid @enderror" required>
                                    <option value="">Select Branch</option>
                                    @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                                            {{ $branch->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('branch_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- User Selection -->
                        <div class="form-group row">
                            <label for="user_id" class="col-sm-2 col-form-label">User</label>
                            <div class="col-sm-10">
                                <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Invoice Number -->
                        <div class="form-group row">
                            <label for="invoice_number" class="col-sm-2 col-form-label">Invoice Number</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('invoice_number') is-invalid @enderror" id="invoice_number" name="invoice_number" value="{{ old('invoice_number', 'INV-' . date('YmdHis')) }}" required>
                                @error('invoice_number')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Transaction Date -->
                        <div class="form-group row">
                            <label for="transaction_date" class="col-sm-2 col-form-label">Transaction Date</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control @error('transaction_date') is-invalid @enderror" id="transaction_date" name="transaction_date" value="{{ old('transaction_date', date('Y-m-d')) }}" required>
                                @error('transaction_date')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Pickup Date -->
                        <div class="form-group row">
                            <label for="pickup_date" class="col-sm-2 col-form-label">Pickup Date</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control @error('pickup_date') is-invalid @enderror" id="pickup_date" name="pickup_date" value="{{ old('pickup_date') }}">
                                @error('pickup_date')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Status -->
                        <div class="form-group row">
                            <label for="status" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                    <option value="">Select Status</option>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="process" {{ old('status') == 'process' ? 'selected' : '' }}>Process</option>
                                    <option value="done" {{ old('status') == 'done' ? 'selected' : '' }}>Done</option>
                                    <option value="picked_up" {{ old('status') == 'picked_up' ? 'selected' : '' }}>Picked Up</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Cart Items -->
                        <div class="form-group">
                            <label>Cart Items</label>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="cart-table">
                                    <thead>
                                        <tr>
                                            <th>Service</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Subtotal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Cart items will be added here dynamically -->
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-right"><strong>Subtotal:</strong></td>
                                            <td colspan="2"><span id="cart-subtotal">Rp 0</span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-right">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Tax (%)</span>
                                                    </div>
                                                    <input type="number" class="form-control" id="tax-percentage" value="0" min="0" max="100">
                                                </div>
                                            </td>
                                            <td colspan="2"><span id="tax-amount">Rp 0</span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-right">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Discount</span>
                                                    </div>
                                                    <input type="number" class="form-control" id="discount-amount" value="0" min="0">
                                                </div>
                                            </td>
                                            <td colspan="2"><span id="discount-display">Rp 0</span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-right"><strong>Total:</strong></td>
                                            <td colspan="2"><span id="cart-total">Rp 0</span></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <input type="hidden" name="total" id="total" value="0">
                            <input type="hidden" name="tax" id="tax" value="0">
                            <input type="hidden" name="discount" id="discount" value="0">
                        </div>
                        
                        <!-- Paid Amount -->
                        <div class="form-group">
                            <label for="paid">Paid Amount</label>
                            <input type="number" class="form-control @error('paid') is-invalid @enderror" id="paid" name="paid" value="{{ old('paid', 0) }}" required min="0" step="0.01">
                            @error('paid')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <!-- Code -->
                        <input type="hidden" name="code" id="code" value="TRX-{{ date('YmdHis') }}">
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Complete Transaction</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    .table th, .table td {
        vertical-align: middle;
    }
    .cart-item {
        cursor: pointer;
    }
    .cart-item:hover {
        background-color: #f8f9fa;
    }
</style>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        // Initialize cart
        let cart = [];
        
        // Search functionality
        $('#search-service').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('#services-table tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
        
        // Add to cart
        $('.add-to-cart').on('click', function() {
            const id = $(this).data('id');
            const code = $(this).data('code');
            const name = $(this).data('name');
            const price = parseFloat($(this).data('price'));
            const unit = $(this).data('unit');
            
            // Check if item already in cart
            const existingItem = cart.find(item => item.id === id);
            
            if (existingItem) {
                existingItem.quantity += 1;
                existingItem.subtotal = existingItem.quantity * existingItem.price;
            } else {
                cart.push({
                    id: id,
                    code: code,
                    name: name,
                    price: price,
                    unit: unit,
                    quantity: 1,
                    subtotal: price
                });
            }
            
            updateCartTable();
        });
        
        // Update cart table
        function updateCartTable() {
            const cartTable = $('#cart-table tbody');
            cartTable.empty();
            
            let subtotal = 0;
            
            cart.forEach((item, index) => {
                cartTable.append(`
                    <tr>
                        <td>${item.name} (${item.unit})</td>
                        <td>
                            <div class="input-group input-group-sm">
                                <button type="button" class="btn btn-outline-secondary decrease-qty" data-index="${index}">-</button>
                                <input type="text" readonly class="form-control text-center qty-input" value="${item.quantity}" min="1" data-index="${index}">
                                <button type="button" class="btn btn-outline-secondary increase-qty" data-index="${index}">+</button>
                            </div>
                        </td>
                        <td>Rp ${item.price.toLocaleString('id-ID')}</td>
                        <td>Rp ${item.subtotal.toLocaleString('id-ID')}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger remove-item" data-index="${index}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `);
                
                subtotal += item.subtotal;
            });
            
            $('#cart-subtotal').text('Rp ' + subtotal.toLocaleString('id-ID'));
            updateTotals();
        }
        
        // Decrease quantity
        $(document).on('click', '.decrease-qty', function() {
            const index = $(this).data('index');
            if (cart[index].quantity > 1) {
                cart[index].quantity -= 1;
                cart[index].subtotal = cart[index].quantity * cart[index].price;
                updateCartTable();
            }
        });
        
        // Increase quantity
        $(document).on('click', '.increase-qty', function() {
            const index = $(this).data('index');
            cart[index].quantity += 1;
            cart[index].subtotal = cart[index].quantity * cart[index].price;
            updateCartTable();
        });
        
        // Manual quantity input
        $(document).on('change', '.qty-input', function() {
            const index = $(this).data('index');
            const qty = parseInt($(this).val());
            
            if (qty > 0) {
                cart[index].quantity = qty;
                cart[index].subtotal = cart[index].quantity * cart[index].price;
                updateCartTable();
            } else {
                $(this).val(1);
            }
        });
        
        // Remove item
        $(document).on('click', '.remove-item', function() {
            const index = $(this).data('index');
            cart.splice(index, 1);
            updateCartTable();
        });
        
        // Tax percentage change
        $('#tax-percentage').on('change', function() {
            updateTotals();
        });
        
        // Discount amount change
        $('#discount-amount').on('change', function() {
            updateTotals();
        });
        
        // Update totals
        function updateTotals() {
            const subtotal = cart.reduce((sum, item) => sum + item.subtotal, 0);
            const taxPercentage = parseFloat($('#tax-percentage').val()) || 0;
            const taxAmount = (subtotal * taxPercentage) / 100;
            const discountAmount = parseFloat($('#discount-amount').val()) || 0;
            const total = subtotal + taxAmount - discountAmount;
            
            $('#tax-amount').text('Rp ' + taxAmount.toLocaleString('id-ID'));
            $('#discount-display').text('Rp ' + discountAmount.toLocaleString('id-ID'));
            $('#cart-total').text('Rp ' + total.toLocaleString('id-ID'));
            
            // Update hidden inputs
            $('#total').val(total);
            $('#tax').val(taxAmount);
            $('#discount').val(discountAmount);
        }
        
        // Form submission
        $('#transaction-form').on('submit', function(e) {
            if (cart.length === 0) {
                e.preventDefault();
                alert('Please add at least one service to the cart');
                return false;
            }
            
            // Add cart items to form
            cart.forEach((item, index) => {
                $(this).append(`<input type="hidden" name="items[${index}][id]" value="${item.id}">`);
                $(this).append(`<input type="hidden" name="items[${index}][quantity]" value="${item.quantity}">`);
                $(this).append(`<input type="hidden" name="items[${index}][price]" value="${item.price}">`);
            });
        });
    });
</script>
@endsection 