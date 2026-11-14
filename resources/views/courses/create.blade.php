<h1>Create New Course</h1>
@if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<!-- 👇 এখানে enctype যোগ করা হয়েছে -->
<form action="/courses" method="POST" enctype="multipart/form-data">

    @csrf

    <label>Course Title</label>
    <input type="text" name="title">
    @error('title')
    <p style="color: red;">{{ $message }}</p>
    @enderror

    <br><br>

    <label>Description</label>
    <textarea name="description"></textarea>
    @error('description')
    <p style="color: red;">{{ $message }}</p>
    @enderror

    <br><br>

    <!-- 👇 নতুন ফাইল ইনপুট -->
    <label>Course Thumbnail (Image)</label>
    <input type="file" name="image" accept="image/*">
    @error('image')
    <p style="color: red;">{{ $message }}</p>
    @enderror

    <br><br>

    <button type="submit">Create Course</button>

</form>