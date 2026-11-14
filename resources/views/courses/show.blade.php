<h1>Course Details</h1>

<h2>{{ $course->title }}</h2>
<p>{{ $course->description }}</p>

<!-- 👇 ছবি দেখানোর কোড -->
@if($course->image)
    <div style="margin-top: 20px;">
        <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}" width="300" style="border-radius: 8px;">
    </div>
@endif

<h1>Course Details</h1>

<h2>{{ $course->title }}</h2>
<p>{{ $course->description }}</p>

<!-- 👇 ছবি দেখানোর কোড (আগে থেকে থাকলে রাখুন) -->
@if($course->image)
    <div style="margin-top: 20px;">
        <img src="{{ asset('courses/' . $course->image) }}" alt="{{ $course->title }}" width="300" style="border-radius: 8px;">
    </div>
@endif

<hr>

<!-- 👇 লেসন লিস্ট এবং নতুন লেসন যোগ করার সেকশন -->
<h3>Lessons</h3>

@if($course->lessons->count() > 0)
    <ul>
        @foreach($course->lessons as $lesson)
            <li>
                <strong>{{ $lesson->title }}</strong>
                <p>{{ $lesson->content }}</p>
            </li>
        @endforeach
    </ul>
@else
    <p>No lessons added yet.</p>
@endif

<br>

<!-- 👇 নতুন লেসন যোগ করার বাটন -->
<a href="{{ route('lessons.create', $course->id) }}" style="padding: 10px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">
    + Add New Lesson
</a>

<br><br>
<a href="{{ route('courses.index') }}">Back to All Courses</a>