<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Zoom;
use App\Models\Course;
use App\Models\CourseLecturer;

class AdminZoomController extends Controller
{
    public function index(Request $request)
    {
        $query = Zoom::query();

        if ($request->zoomStatus && $request->zoomStatus != 'Semua') {
            $now = Carbon::now();

            if ($request->zoomStatus === 'Akan Datang') {
                $query->where('zoomStatus', 'publikasi')
                    ->whereRaw("STR_TO_DATE(CONCAT(zoomDate, ' ', start_time), '%Y-%m-%d %H:%i') > ?", [$now]);
            } elseif ($request->zoomStatus === 'Selesai') {
                $query->where('zoomStatus', 'publikasi')
                    ->whereRaw("STR_TO_DATE(CONCAT(zoomDate, ' ', start_time), '%Y-%m-%d %H:%i') <= ?", [$now]);
            } elseif ($request->zoomStatus === 'Draft') {
                $query->where('zoomStatus', 'draft');
            } elseif ($request->zoomStatus === 'Dihapus') {
                $query->where('zoomStatus', 'dihapus');
            }
        }

        if ($request->search) {
            $query->where('zoomName', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->input('perPage', 5);

        $zooms = $query->orderBy('created_at', 'desc')
                        ->paginate($perPage)
                        ->appends($request->query());

        return view('admin.zoom.zoomManagement', compact('zooms'));
    }

    // create new zoom
    public function create()
    {
        $courses = Course::all();
        $tutors = CourseLecturer::with('lecturer.user')->get();

        return view('admin.zoom.zoom-create', compact('courses', 'tutors'));
    }

    public function createZoom(Request $request)
    {
        $validated = $request->validate([
            'zoomTopic' => 'required|string|max:255',
            'courseDesc' => 'required|string',
            'zoomLink' => 'required|string|max:255',
            'zoomTutor' => 'required|integer',
            'zoomCourse' => 'required|integer',
            'zoomDate' => 'required|date',
            'zoomTime' => 'required',
            'zoomDuration' => 'required|integer',
            'zoomQuota' => 'required|integer',
        ]);

        $startTime = Carbon::createFromFormat('H:i', $request->zoomTime);
        $endTime = (clone $startTime)->addMinutes((int) $request->zoomDuration);

        $course = Course::findOrFail($validated['zoomCourse']);
        $courseLecturer = $course->courseLecturers() // userId
                ->where('lecturerId', $validated['zoomTutor'])
                ->first();

        $zoom = Zoom::create([
            'zoomName' => $validated['zoomTopic'],
            'zoomDesc' => $validated['courseDesc'],
            'zoomLink' => $validated['zoomLink'],
            'courseId' => $validated['zoomCourse'],
            'tutorId' => $courseLecturer->id,
            'zoomDate' => $validated['zoomDate'],
            'start_time'  => $startTime->format('H:i'),
            'end_time'    => $endTime->format('H:i'),
            'zoomDuration' => $validated['zoomDuration'],
            'zoomQuota' => $validated['zoomQuota'],
            'zoomStatus' => $request->input('action') === 'publish' ? 'publikasi' : 'draft',
        ]);

       return redirect()->route('admin.zoom.index');
    }

    // edit zoom
    public function edit($id)
    {
        $zoom = Zoom::findOrFail($id);
        $courses = Course::all();
        $tutors = CourseLecturer::with('lecturer.user')->get();

        return view('admin.zoom.zoom-edit', compact('zoom', 'courses', 'tutors'));
    }

    public function updateZoom(Request $request, $zoomId)
    {
        $validated = $request->validate([
            'zoomTopic' => 'required|string|max:255',
            'courseDesc' => 'required|string',
            'zoomLink' => 'required|string|max:255',
            'zoomTutor' => 'required|integer',
            'zoomCourse' => 'required|integer',
            'zoomDate' => 'required|date',
            'zoomTime' => 'required',
            'zoomDuration' => 'required|integer',
            'zoomQuota' => 'required|integer',
        ]);

        $zoom = Zoom::findOrFail($zoomId);

        $startTime = Carbon::parse($request->zoomTime);
        $endTime = (clone $startTime)->addMinutes((int)$request->zoomDuration);

        $zoom->update([
            'zoomName'      => $validated['zoomTopic'],
            'zoomDesc'      => $validated['courseDesc'],
            'zoomLink'      => $validated['zoomLink'],
            'courseId'      => $validated['zoomCourse'],
            'tutorId'       => $validated['zoomTutor'], // tutorId di tabel zoom
            'zoomDate'      => $validated['zoomDate'],
            'start_time'    => $startTime->format('H:i'),
            'end_time'      => $endTime->format('H:i'),
            'zoomDuration'  => $validated['zoomDuration'],
            'zoomQuota'     => $validated['zoomQuota'],
            'zoomStatus' => 'publikasi',

        ]);

        return redirect()->route('admin.zoom.index')
                        ->with('success', 'Kelas Zoom berhasil diperbarui!');
    }

    // delete zoom
    public function destroy($id)
    {
        $zoom = Zoom::findOrFail($id);
        $zoom->zoomStatus = 'dihapus';
        $zoom->save();

        return redirect()->route('admin.zoom.index');
    }
}
