<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $courses = Course::with('courseLecturers.lecturer.user')
            ->inRandomOrder()
            ->take(4)
            ->get();

        if($user){
            $notifications = Notification::where('userId', $user->id)
                ->orderBy('notificationDate', 'desc')
                ->get();
            $unreadCount = Notification::where('status', 'unread')
            ->where('userId', $user->id)
            ->count();

            if ($user->role === 'admin') {
                return redirect()->route('admin.home');
            } elseif ($user->role === 'lecturer') {
                return redirect()->route('lecturer.home');
            }
        }else{
            $notifications = collect(); 
            $unreadCount = 0;   
        }
            

        return view('Artcademy.home', compact('courses', 'notifications', 'unreadCount'));
    }
}
