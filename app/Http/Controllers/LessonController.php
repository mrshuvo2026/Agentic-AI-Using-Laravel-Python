<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson; // 👈 Lesson মডেলটি ইনক্লুড করতে হবে

class LessonController extends Controller
{
    // ১. নতুন লেসন তৈরির ফর্ম দেখানোর মেথড
    public function create(Course $course)
    {
        return view('lessons.create', compact('course'));
    }

    // ২. ফর্ম থেকে ডেটা নিয়ে ডাটাবেসে সেভ করার মেথড
    public function store(Request $request, Course $course)
    {
        // ভ্যালিডেশন
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        // কোর্সের সাথে সম্পর্কিত লেসন তৈরি করা
        $course->lessons()->create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        // সেভ হয়ে গেলে আবার কোর্সের ডিটেইলস পেজে ফেরত পাঠানো
        return redirect()->route('courses.show', $course->id)->with('success', 'Lesson added successfully.');
    }
}