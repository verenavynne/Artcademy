<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Zoom;

class TutorJadwalController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'mendatang');

        $lecturerId = Auth::id();
        $now = now();

        if ($status === 'selesai') {
            $zooms = Zoom::with(['tutor.lecturer.user'])
                ->whereHas('tutor', function ($query) use ($lecturerId) {
                    $query->where('lecturerId', $lecturerId);
                })
                ->where('zoomDate', '<', $now)
                ->get();
        } else {
            $zooms = Zoom::with(['tutor.lecturer.user'])
                ->whereHas('tutor', function ($query) use ($lecturerId) {
                    $query->where('lecturerId', $lecturerId);
                })
                ->where('zoomDate', '>=', $now)
                ->get();
        }

        return view('lecturer.jadwal-saya.jadwal-saya', compact('zooms', 'status'));
    }
}
