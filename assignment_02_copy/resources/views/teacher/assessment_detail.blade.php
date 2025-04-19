<x-app-layout>
    <section class="features">
        <div class="container">
          <h2 class="h2 section-title">{{$course->name}}-{{$assessment->title}}</h2>
          <p>Required Reviews: {{$assessment->required_reviews}}</p>
          <p class="section-subtitle">Students</p>
          <ul class="features-list">
            @foreach ($enrollments as $enrollment)
                <li>
                  <a href="{{ route('assessments.student', ['course_id' => $course->id, 'assessment_id' => $assessment->id, 'student_id' => $enrollment->student->id]) }}" class="features-card">
                    <div class="card-icon">
                      <ion-icon name="person-circle-outline"></ion-icon>
                    </div>

                    <div>
                      <h3 class="card-title">{{ $enrollment->student->name }}</h3>
                    </div>
                    <div>
                        <p>
                            Received Review: {{ $enrollment->student->receivedPeerReviews->count() }}
                        </p>
                    </div>

                    <div>
                        <p>
                            Reviews Given: {{ $enrollment->student->givenPeerReviews->count() }}
                        </p>
                    </div>
       
                    <div>
                        <p>
                            Score: {{ $enrollment->student->studentAssessments->first() ? $enrollment->student->studentAssessments->first()->final_score : 'N/A' }}
                        </p>
                    </div>

                    <div class="card-btn">
                      <ion-icon name="arrow-forward-outline"></ion-icon>
                    </div>
                  </a>
                </li>
            @endforeach
          </ul>
          <div class="mt-4">
              {{ $enrollments->links() }}
          </div>
        </div>
    </section>
</x-app-layout>
