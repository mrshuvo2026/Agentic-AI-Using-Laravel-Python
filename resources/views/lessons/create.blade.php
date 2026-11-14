<h1>Add New Lesson to: {{ $course->title }}</h1>

@if ($errors->any())
    <div style="color: red;">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form action="{{ route('lessons.store', $course->id) }}" method="POST">
    @csrf

    <label>Lesson Title</label>
    <input type="text" name="title" value="{{ old('title') }}">
    @error('title')
        <p style="color: red;">{{ $message }}</p>
    @enderror

    <br><br>

    <label>Lesson Content</label>
    <textarea name="content">{{ old('content') }}</textarea>
    @error('content')
        <p style="color: red;">{{ $message }}</p>
    @enderror

    <br><br>

    <button type="submit">Save Lesson</button>
</form>

<br>
<a href="{{ route('courses.show', $course->id) }}">Back to Course</a>