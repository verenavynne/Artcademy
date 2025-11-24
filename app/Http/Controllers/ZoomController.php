<?php

namespace App\Http\Controllers;

use App\Models\Zoom;
use App\Models\ZoomRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ZoomController extends Controller
{
    public function register($id)
    {
        $user = Auth::user();
        $zoom = Zoom::findOrFail($id);

        $existing = ZoomRegistered::where('zoomId', $id)
            ->where('studentId', $user->id)
            ->first();

        $totalPeserta = ZoomRegistered::where('zoomId', $id)->count();

        if ($existing) {
            return redirect()->back()->with('info', 'Kamu sudah terdaftar di Zoom ini.');
        }

        if ($totalPeserta >= $zoom->zoomQuota) {
            return redirect()->back()->with('error', 'Kuota kelas Zoom ini sudah penuh.');
        }

        ZoomRegistered::create([
            'zoomId' => $id,
            'studentId' => $user->id,
        ]);

        return redirect()->back()->with('success','Kamu berhasil terdaftar di zoom ini');
    }

    public function showDetail($id)
    {
        $user = Auth::user();

        if ($user->role === 'student') {
            $layout = 'layouts.master';
        } elseif ($user->role === 'admin') {
            $layout = 'layouts.master-admin';
        }

        $zoom = Zoom::with('tutor')->findOrFail($id);

        $otherZoom = Zoom::where('id', '!=', $id)
        ->inRandomOrder()
        ->take(3)
        ->with('tutor')
        ->get();

        $user = Auth::user();

        $totalPeserta = ZoomRegistered::where('zoomId', '=', $id)
        ->count();

        $quota = $zoom->zoomQuota;

        $progressPeserta = $quota > 0 ? ($totalPeserta / $quota) * 100 : 0;

        $isRegistered = ZoomRegistered::where('zoomId', $id)
        ->where('studentId', $user->id)->exists();


        return view('Artcademy.course-zoom-details', compact('zoom', 'otherZoom','totalPeserta','quota','progressPeserta', 'isRegistered', 'layout'));
    }

}
