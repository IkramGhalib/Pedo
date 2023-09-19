<ul class="nav nav-tabs mb-4">
    <li class="nav-item">
        <a class="nav-link py-1 {{ request()->is('instructor-course-info*') ? 'active' : '' }}" href="{{ $course->id ? route('instructor.course.info.edit', $course->id) : route('instructor.course.info') }}">Course Info</a>
    </li>
    <li class="nav-item">
        <a class="nav-link py-1 {{ request()->is('instructor-course-image*') ? 'active' : '' }} {{ !$course->id ? 'course-id-empty' : '' }}" href="{{ $course->id ? route('instructor.course.image.edit', $course->id) : 'javascript:void(0);' }}">Course Image</a>
    </li>
    <li class="nav-item">
        <a class="nav-link py-1 {{ request()->is('instructor-course-video*') ? 'active' : '' }} {{ !$course->id ? 'course-id-empty' : '' }}" href="{{ $course->id ? route('instructor.course.video.edit', $course->id) : 'javascript:void(0);' }}">Course Videos</a>
    </li>

    {{-- <li class="nav-item">
        <a class="nav-link py-1 {{ request()->is('instructor-course-curriculum*') ? 'active' : '' }} {{ !$course->id ? 'course-id-empty' : '' }}" href="{{ $course->id ? route('instructor.course.curriculum.edit', $course->id) : 'javascript:void(0);' }}">Curriculum</a>
    </li> --}}
</ul>