<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $courses = Course::with('courseLecturers.lecturer.user')
            ->inRandomOrder()
            ->take(4)
            ->get();
        return view('Artcademy.home', compact('courses'));
    }
}
