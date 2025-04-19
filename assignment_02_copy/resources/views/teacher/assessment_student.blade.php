<x-app-layout>
  <section class="property" id="property">
    <div class="container">
        <h1>{{ $student->name }}</h1>
        <div class="mt-4 col-md-1">
            <form action="{{ route('set_score.student', ['course_id' => $course->id, 'assessment_id' => $assessment->id, 'student_id' => $student->id]) }}" method="POST" class="col-md-12">
                @csrf

                @if ($reviewsSentIncomplete == false)
                    <div class="form-group">
                        <label for="score">Set Score:</label>
                        <input name="score" id="score" class="form-control" value="{{ $studentAssessment ? $studentAssessment->final_score : 'N/A' }}">
                    </div>
                      
                    <div class="d-flex justify-content-between mt-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                @else
                    <p>Required reviews sent has not been achieved.</p>
                @endif
            </form>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
      
        <div class="row">
        <!-- Reviews Received -->
        <div class="col">
          <div class="container">
            <p class="section-subtitle">Reviews Received</p>
            <ul class="property-list">
              @if($reviewsReceived->isEmpty())
                <p>No reviews received.</p>
              @else
                @foreach ($reviewsReceived as $peer_review)
                  <li>
                    <div class="property-card">
                      <div class="card-content">
                        <div class="card-price">
                          Score: {{ $peer_review->score }}
                        </div>
                        <p class="card-text">
                          {{ $peer_review->review }}
                        </p>
                      </div>
                      <div class="card-footer">
                        <div class="card-author">
                          <p class="author-name">
                            Reviewer: {{ $peer_review->reviewer->name }}
                          </p>
                        </div>
                      </div>
                    </div>
                  </li>
                @endforeach
              @endif
            </ul>
          </div>
        </div>

        <!-- Reviews Sent -->
        <div class="col">
          <div class="container">
            <p class="section-subtitle">Reviews Sent</p>
            <ul class="property-list">
              @if($reviewsSent->isEmpty())
                <p>No reviews sent.</p>
              @else
                @foreach ($reviewsSent as $peer_review)
                  <li class="mt-2">
                    <div class="property-card">
                      <div class="card-content">
                        <div class="card-price">
                          Score: {{ $peer_review->score }}
                        </div>
                        <p class="card-text">
                          {{ $peer_review->review }}
                        </p>
                      </div>
                      <div class="card-footer">
                        <div class="card-author">
                          <p class="author-name">
                            Reviewee: {{ $peer_review->reviewee->name }}
                          </p>
                        </div>
                      </div>
                    </div>
                  </li>
                @endforeach
              @endif
            </ul>
        </div>
</x-app-layout>
