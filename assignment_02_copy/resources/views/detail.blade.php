<x-app-layout>
    <section class="about" id="about">
        <div class="container">
          <div class="about-banner">
            <img src="{{ asset('images/icon2.png') }}" alt="Course Detail">
          </div>
          <div class="about-content">
            <p class="section-subtitle">Course Details</p>
            <h2 class="h2 section-title">{{$course->name}}</h2>
            <p class="about-text">
              {{$course->code}}
            </p>
            <ul class="about-list">
                @foreach($course->assessments as $assessment)
                    <a href="{{ route('show', ['course_id' => $course->id, 'assessment_id' => $assessment->id]) }}">
                        <li class="about-item" href="">
                            <div class="about-item-icon">
                                <ion-icon name="document-outline"></ion-icon>
                            </div>
                            <p class="about-item-text">{{ $assessment->title }} - Due: {{ $assessment->due_date }}</p>
                        </li>
                    </a>
                @endforeach
            </ul>

            <p class="callout">
              Professor: {{$course->teacher->name}}
            </p>

          </div>
        </div>
      </section>
</x-app-layout>