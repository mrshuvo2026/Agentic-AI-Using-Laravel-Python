<h1>Available Courses</h1>


<!-- সার্চ ফর্ম শুরু -->
<form action="{{ route('courses.index') }}" method="GET" style="margin-bottom: 20px;">
    <input type="text" name="search" placeholder="Search courses..." value="{{ $search }}">

<select name="sort">
        <option value="newest" {{ $sort == 'newest' ? 'selected' : '' }}>Newest First</option>
        <option value="oldest" {{ $sort == 'oldest' ? 'selected' : '' }}>Oldest First</option>
    </select>

<select name="filter">
    <option value="">All Courses</option>
    <option value="has_lessons" {{ $filter == 'has_lessons' ? 'selected' : '' }}>Has Lessons</option>
    <option value="no_lessons" {{ $filter == 'no_lessons' ? 'selected' : '' }}>No Lessons</option>
</select>    

    <button type="submit">Search</button>
</form>
<!-- সার্চ ফর্ম শেষ -->

@forelse ($courses as $course)
    <!-- ছবি দেখানোর কোড -->
    @if($course->image)
        <div style="margin-bottom: 10px;">
            <img src="{{ asset($course->image) }}" width="150">
        </div>
    @endif

    <h2>{{ $course->title }}</h2>
    <a href="/courses/{{ $course->id }}">View Details</a>
    
    <!-- 👇 এডিট বাটনও শুধু অ্যাডমিন দেখবে (ঐচ্ছিক, তবে ভালো) -->

@can('manage-courses')
    <div style="margin-top: 10px; margin-bottom: 10px;">
        <!-- এডিট বাটন -->
        <a href="/courses/{{ $course->id }}/edit" style="margin-right: 10px;">Edit Course</a>

        <!-- ডিলিট বাটন (শুধু অ্যাডমিন) -->
        @can('is-admin')
            <form action="/courses/{{ $course->id }}" method="POST" 
                  onsubmit="return confirm('Are you sure to delete this course?')" 
                  style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete Course</button>
            </form>
        @endcan
    </div>
@endcan
    <p>{{ $course->description }}</p>
    <hr>
@empty
    <p>এখনো কোনো Course যোগ করা হয়নি।</p>
@endforelse

<!-- 👇 পেজিনেশন লিঙ্ক (লুপের বাইরে) -->
<div style="margin-top: 20px;">
    {{ $courses->links() }}
</div>