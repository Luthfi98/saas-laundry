<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Cms\MenuController;
use App\Http\Controllers\Cms\RoleController;
use App\Http\Controllers\Cms\UserController;
use App\Http\Controllers\Cms\TenantController;
use App\Http\Controllers\Cms\ProfileController;
use App\Http\Controllers\Cms\WebsiteController;
use App\Http\Controllers\Cms\DashboardController;
use App\Http\Controllers\Cms\PermissionController;
use App\Http\Controllers\Cms\SubscriptionController;
use App\Http\Controllers\Cms\SubscriptionHistoryController;
use App\Http\Controllers\Tenant\TDashboardController;
use App\Http\Controllers\Tenant\TBranchController;
use App\Http\Controllers\Tenant\CustomerController;
use App\Http\Controllers\Tenant\ServiceCategoryController;
use App\Http\Controllers\Tenant\ServiceController;
use App\Http\Controllers\Tenant\TCustomerController;
use App\Http\Controllers\Tenant\TServiceCategoryController;
use App\Http\Controllers\Tenant\TServiceController;
use App\Http\Controllers\Tenant\TTransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login.do', [AuthController::class, 'doLogin'])->name('login.do');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register.do', [AuthController::class, 'doRegister'])->name('register.do');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/', [AuthController::class, 'index']);

// Protected routes
Route::middleware('auth')->group(function() {
    // CMS routes
    Route::prefix('cms')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        
        // Menu routes
        Route::prefix('menus')->group(function() {
            Route::get('trashed', [MenuController::class, 'trashed'])->name('menus.trashed');
            Route::post('trashed', [MenuController::class, 'storeTrashed'])->name('menus.trashed.store');
            Route::get('sorting', [MenuController::class, 'sorting'])->name('menus.sorting');
            Route::post('sorting', [MenuController::class, 'storeSorting'])->name('menus.sorting.store');
        });
        Route::resource('menus', MenuController::class);
        
        // Other CMS resources
        Route::resource('roles', RoleController::class);
        Route::resource('website', WebsiteController::class);
        Route::resource('users', UserController::class);
        Route::resource('permissions', PermissionController::class);
        Route::resource('subscriptions', SubscriptionController::class);
        Route::resource('subscription-histories', SubscriptionHistoryController::class);
        Route::resource('tenants', TenantController::class);
        
        // User management
        Route::prefix('users')->group(function() {
            Route::get('trashed', [UserController::class, 'trashed'])->name('users.trashed');
            Route::post('trashed', [UserController::class, 'storeTrashed'])->name('users.trashed.store');
        });
        
        // Role permissions
        Route::get('roles/permission/{role}', [RoleController::class, 'permission'])->name('roles.permission');
        Route::post('roles/permission', [RoleController::class, 'storePermission'])->name('roles.storePermission');
        
        // Profile management
        Route::prefix('profile')->group(function() {
            Route::get('/', [ProfileController::class, 'index'])->name('profile');
            Route::post('/', [ProfileController::class, 'store'])->name('profile.store');
            Route::post('preference', [ProfileController::class, 'storePreference'])->name('profile.preference');
            Route::post('change/{type}', [ProfileController::class, 'change'])->name('profile.change');
        });
        
        // Reports
        Route::get('report-activity-user', [WebsiteController::class, 'userActivity'])->name('report-activity-user');
        Route::get('report-activity-user/{id}', [WebsiteController::class, 'userActivity']);
    });

    // Tenant routes
    Route::middleware('tenant')->group(function() {
        Route::prefix('{code}')->group(function () {
            Route::get('/', [TDashboardController::class, 'index'])->name('tenant.dashboard');
            Route::get('/dashboard', [TDashboardController::class, 'index'])->name('tenant.dashboard');
            
            // Branch routes
            Route::prefix('branch')->group(function () {
                Route::get('/', [TBranchController::class, 'index'])->name('tenant.branch.index');
                Route::get('/create', [TBranchController::class, 'create'])->name('tenant.branch.create');
                Route::post('/', [TBranchController::class, 'store'])->name('tenant.branch.store');
                Route::get('/{id}/edit', [TBranchController::class, 'edit'])->name('tenant.branch.edit');
                Route::post('/{id}', [TBranchController::class, 'update'])->name('tenant.branch.update');
                Route::delete('/{id}', [TBranchController::class, 'destroy'])->name('tenant.branch.destroy');
            });

            // Customer routes
            Route::prefix('customer')->group(function () {
                Route::get('/', [TCustomerController::class, 'index'])->name('tenant.customer.index');
                Route::get('/data', [TCustomerController::class, 'data'])->name('tenant.customer.data');
                Route::get('/create', [TCustomerController::class, 'create'])->name('tenant.customer.create');
                Route::post('/', [TCustomerController::class, 'store'])->name('tenant.customer.store');
                Route::get('/{customer}/edit', [TCustomerController::class, 'edit'])->name('tenant.customer.edit');
                Route::put('/{customer}', [TCustomerController::class, 'update'])->name('tenant.customer.update');
                Route::delete('/{customer}', [TCustomerController::class, 'destroy'])->name('tenant.customer.destroy');
            });

            // Service Category routes
            Route::prefix('service-categories')->group(function () {
                Route::get('/', [TServiceCategoryController::class, 'index'])->name('tenant.service-categories.index');
                Route::get('/data', [TServiceCategoryController::class, 'data'])->name('tenant.service-categories.data');
                Route::get('/create', [TServiceCategoryController::class, 'create'])->name('tenant.service-categories.create');
                Route::post('/', [TServiceCategoryController::class, 'store'])->name('tenant.service-categories.store');
                Route::get('/{serviceCategory}/edit', [TServiceCategoryController::class, 'edit'])->name('tenant.service-categories.edit');
                Route::put('/{serviceCategory}', [TServiceCategoryController::class, 'update'])->name('tenant.service-categories.update');
                Route::delete('/{serviceCategory}', [TServiceCategoryController::class, 'destroy'])->name('tenant.service-categories.destroy');
            });

            // Service routes
            Route::prefix('services')->group(function () {
                Route::get('/', [TServiceController::class, 'index'])->name('tenant.services.index');
                Route::get('/data', [TServiceController::class, 'data'])->name('tenant.services.data');
                Route::get('/create', [TServiceController::class, 'create'])->name('tenant.services.create');
                Route::post('/', [TServiceController::class, 'store'])->name('tenant.services.store');
                Route::get('/{service}/edit', [TServiceController::class, 'edit'])->name('tenant.services.edit');
                Route::put('/{service}', [TServiceController::class, 'update'])->name('tenant.services.update');
                Route::delete('/{service}', [TServiceController::class, 'destroy'])->name('tenant.services.destroy');
            });
            
            // Transaction routes
            Route::prefix('transactions')->group(function () {
                Route::get('/', [TTransactionController::class, 'index'])->name('tenant.transactions.index');
                Route::get('/create', [TTransactionController::class, 'create'])->name('tenant.transactions.create');
                Route::get('/pos', [TTransactionController::class, 'pos'])->name('tenant.transactions.pos');
                Route::post('/', [TTransactionController::class, 'store'])->name('tenant.transactions.store');
                Route::get('/{transaction}/edit', [TTransactionController::class, 'edit'])->name('tenant.transactions.edit');
                Route::put('/{transaction}', [TTransactionController::class, 'update'])->name('tenant.transactions.update');
                Route::delete('/{transaction}', [TTransactionController::class, 'destroy'])->name('tenant.transactions.destroy');
            });
            
            // Fallback for tenant routes
            Route::fallback(function () {
                return redirect()->route('tenant.dashboard', ['code' => request()->route('code')]);
            });
        });
    });
});


