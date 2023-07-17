<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function Dashboard()
    {
        return view('admin.dashboard');
    }

    public function Profile()
    {
        $id = Auth::guard('admin')->id();
    
        $result['admin'] = Admin::where('id', $id)->first();
      
        return view('admin.profile',  $result);
    }

    
}
