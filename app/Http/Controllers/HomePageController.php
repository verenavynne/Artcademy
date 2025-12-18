<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Notification;
use App\Models\User;
use App\Models\Membership;
use App\Models\Event;
use App\Models\Testimoni;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user) {
            if ($user->role === 'admin') {
                return redirect('/admin/home');
            } elseif ($user->role === 'lecturer') {
                return redirect('/lecturer/home');
            }
        }

        // ambil 7 kursus yg statusnya publikasi dan belum dienroll jika sudah login
        $courses = Course::with('courseLecturers.lecturer.user')
            ->where('courseStatus', 'publikasi')
            ->when($user, function($query) use ($user) {
                $query->whereDoesntHave('courseEnrollments', function($q) use ($user) {
                    $q->where('studentId', $user->id);
                });
            })
            ->inRandomOrder()
            ->take(4)
            ->withAvg('testimonis', 'rating')
            ->withCount('testimonis')
            ->get();

        // ambil 7 tutor yg statusnya active
        $tutors = User::with('lecturer')
            ->where('role', 'lecturer')
            ->where('userStatus', 'active')
            ->inRandomOrder()
            ->take(7)
            ->get();

        // ambil semua data membership
        $memberships = Membership::all();

        // ambil 7 event
        $events = Event::inRandomOrder()
            ->where(function ($q) {
                $q->where('eventDate', '>', Carbon::today())
                ->orWhere(function ($q2) {
                    $q2->where('eventDate', Carbon::today())
                        ->where('start_time', '>', Carbon::now()->format('H:i:s'));
                });
            })
            ->take(7)
            ->get();

        $testimonis = Testimoni::with('student.user')->get();
  

        return view('Artcademy.home', compact('courses', 'tutors', 'memberships', 'events', 'testimonis'));
    }
}
