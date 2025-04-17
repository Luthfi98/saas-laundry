<?php

namespace App\Http\Controllers\Tenant;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

class TDashboardController extends Controller
{
    public function __construct() {
        $this->helpers = App::make('generalhelper');
    }
    public function index(){
        $this->helpers->canAccess('module-dashboard-tenant-read');

        $data = [
            'title' => 'Dashboard',
        ];
        return view('tenant.dashboard.index', $data);
    }
}
