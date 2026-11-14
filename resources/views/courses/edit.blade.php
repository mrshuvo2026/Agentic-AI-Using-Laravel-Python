<h1>Edit Course</h1>
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
@endif

<!-- 👇 এখানে enctype যোগ করা হয়েছে -->
<form action="/courses/{{ $course->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Course Title</label>
    <input type="text" name="title" value="{{ $course->title }}">

    <br><br>

    <label>Description</label>
    <textarea name="description">{{ $course->description }}</textarea>

    <br><br>

    <!-- 👇 নতুন ফাইল ইনপুট এবং আগের ছবি দেখানো -->
    <label>Course Thumbnail (Image)</label>
    <br>
    @if($course->image)
        <!-- যদি আগে থেকে ছবি থাকে, তবে সেটি দেখাবে -->
        <img src="{{ asset('storage/' . $course->image) }}" width="150" style="margin-bottom: 10px;">
    @endif
    <input type="file" name="image" accept="image/*">

    <br><br>

    <button type="submit">Update Course</button>
</form>