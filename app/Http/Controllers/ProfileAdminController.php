<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ProfileAdminController extends Controller
{
    public function index(Request $id)
    {
        
        return view('profile_admin.index');
    }

}
