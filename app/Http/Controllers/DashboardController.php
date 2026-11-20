<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;     // 👈 User মডেল
use App\Models\Course;   // 👈 Course মডেল
use App\Models\Lesson;   // 👈 Lesson মডেল

class DashboardController extends Controller
{
    public function index()
    {
        // ডাটাবেস থেকে মোট সংখ্যা বের করা
        $totalUsers = User::count();
        $totalCourses = Course::count();
        $totalLessons = Lesson::count();

        // ড্যাশবোর্ড ভিউতে ডেটা পাঠানো
        return view('dashboard', compact('totalUsers', 'totalCourses', 'totalLessons'));
    }
}