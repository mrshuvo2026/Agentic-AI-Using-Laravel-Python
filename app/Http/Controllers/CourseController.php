<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
 public function index(Request $request)
{
    $search = $request->input('search');
    $sort = $request->input('sort');
    $filter = $request->input('filter'); // 👈 নতুন লাইন

    $courses = Course::query()
        ->when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                         ->orWhere('description', 'like', '%' . $search . '%');
        })
        ->when($filter === 'has_lessons', function ($query) {
            // 👈 শুধু সেই কোর্সগুলো দেখাবে যেগুলোতে অন্তত ১টি লেসন আছে
            return $query->has('lessons'); 
        })
        ->when($filter === 'no_lessons', function ($query) {
            // 👈 শুধু সেই কোর্সগুলো দেখাবে যেগুলোতে কোনো লেসন নেই
            return $query->doesntHave('lessons'); 
        })
        ->when($sort, function ($query, $sort) {
            if ($sort === 'oldest') {
                return $query->orderBy('created_at', 'asc');
            }
            return $query->orderBy('created_at', 'desc');
        })
        ->paginate(10);

    return view('courses.index', compact('courses', 'search', 'sort', 'filter'));
}
public function show(Course $course)
{
    return view('courses.show', compact('course'));
}

public function create()
{
    return view('courses.create');
}

public function store(Request $request)
{
    // ১. ভ্যালিডেশন
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // ২. ডেটা প্রস্তুত করা
    $data = $request->only(['title', 'description']);

    // ৩. যদি ছবি আপলোড করা হয়
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('courses'), $imageName);
        $data['image'] = $imageName; 
    }

    // ৪. ডাটাবেসে সেভ করা
    Course::create($data);

    return redirect()->route('courses.index')->with('success', 'Course created successfully.');
}

public function edit(Course $course)
{
    return view('courses.edit', compact('course'));
}

public function update(Request $request, Course $course)
{
    // ১. ভ্যালিডেশন
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 👈 নতুন
    ]);

    // ২. ডেটা প্রস্তুত করা
    $data = $request->only(['title', 'description']);

    // ৩. যদি নতুন ছবি আপলোড করা হয়
    if ($request->hasFile('image')) {
        // আগের ছবিটি ডিলিট করে দাও (যদি থাকে)
        if ($course->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($course->image);
        }
        // নতুন ছবি সেভ করো
        $data['image'] = $request->file('image')->store('courses', 'public');
    }

    // ৪. ডাটাবেসে আপডেট করা
    $course->update($data);

    return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
}

public function destroy($id)
{
    $course = Course::findOrFail($id);
    
    $course->delete();
    return redirect('/courses');
}

}
