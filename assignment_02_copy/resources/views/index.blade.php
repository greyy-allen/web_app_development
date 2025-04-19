<x-app-layout>
    <section class="course" id="course">
        <div class="container">
            <p class="section-subtitle">
                @auth
                    @if (auth()->user()->user_type === 'teacher')
                        Courses to Teach
                    @else
                        Your Courses
                    @endif
                @else
                    Available Courses
                @endauth
            </p>
            <ul class="course-list">
                @if($courses->isEmpty())
                    <p>
                        @auth
                            @if (auth()->user()->user_type === 'student')
                                You are not enrolled in any courses.
                            @else
                                You are not teaching any courses.
                            @endif
                        @else
                            No courses are available.
                        @endauth
                    </p>
                @else
                    @foreach ($courses as $course)
                        <li>
                            <div class="course-card">
                                <div class="card-icon">
                                    <img src="{{ asset('images/icon.png') }}" alt="Service icon" height="100px" width="100px">
                                </div>
                                <h3 class="h3 card-title">
                                    <a href="{{ url('courses/' . $course->id) }}">{{ $course->name }}</a>
                                </h3>
                                <p class="card-text">
                                    {{ $course->code }}
                                </p>
                                <a href="@auth {{ url('courses/' . $course->id) }} @else {{ route('login') }} @endauth" class="card-link">
                                    <span>See Details</span>
                                    <ion-icon name="arrow-forward-outline"></ion-icon>
                                </a>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </section>
</x-app-layout>
