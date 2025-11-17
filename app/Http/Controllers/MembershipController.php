<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Membership;

class MembershipController extends Controller
{
    public function index()
    {
        $memberships = Membership::all();
        return view('membership.membership', compact('memberships'));
    }

    public function detail($membershipId)
    {
        $membership = Membership::findOrFail($membershipId);
        return view('membership.membership-detail', compact('membership'));
    }

    public function checkoutInfo($membershipId)
    {
        $user = Auth::user();
        $membership = Membership::findOrFail($membershipId);
        return view('membership.membership-checkout-info', compact('user', 'membership'));
    }
}
