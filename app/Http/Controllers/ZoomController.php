<?php

namespace App\Http\Controllers;

use App\Models\ZoomRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ZoomController extends Controller
{
    public function register($id)
    {
        $user = Auth::user();

        $existing = ZoomRegistered::where('zoomId', $id)
            ->where('studentId', $user->id)
            ->first();

        if ($existing) {
            return redirect()->back()->with('info', 'Kamu sudah terdaftar di Zoom ini.');
        }

        ZoomRegistered::create([
            'zoomId' => $id,
            'studentId' => $user->id,
        ]);

        return redirect()->back()->with('success', 'Berhasil mendaftar ke Zoom!');
    }

}
