<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Menu;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DashboardController extends Controller
{
    function index()
    {
        $helpers = App::make('generalhelper');
        $permissions = Permission::count();
        $roles = Role::count();
        $menus = Menu::count();
        $users = User::count();
        $activities = Activity::with('user')->limit(5, 1)->orderBy('id', 'desc')->get();
        $data = [
            'title' => 'Dashboard',
            'permissions' => $permissions,
            'roles' => $roles,
            'menus' => $menus,
            'users' => $users,
            'activities' => $activities
        ];
        return view('cms.dashboard', $data);
    }
}
