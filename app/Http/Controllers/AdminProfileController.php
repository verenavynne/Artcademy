<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    public function showAdminProfile()
    {
        $user = auth()->user();
        return view('admin.profile.admin-my-profile', compact('user'));
    }
}
