<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $portfolios = Portfolio::where('userId', $user->id)->get();

        return view('profile.my-profile', compact('user', 'portfolios'));

    }
}
