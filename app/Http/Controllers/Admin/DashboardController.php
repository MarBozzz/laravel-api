<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){

        $count_project = Project::where('user_id', Auth::id())->count();
        return view('admin.home', compact('count_project'));
    }
}
