<x-app-layout>
  <section class="property" id="property">
    <div class="container">
      <h1>{{ $assessment->title }}</h1>

      @if ($completedRequiredReviews)
        <p>The student has completed the required number of reviews.</p>
        
        @if ($hasFinalScore)
            <p>The final score is: {{ $finalScore }}</p>
        @else
            <p>No final score has been set yet.</p>
        @endif
      @else
          <p>The student has not yet completed the required number of reviews.</p>
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

          <!-- Show Form -->
          <div class="d-flex justify-content-center mt-3">
            <button class="btn btn-primary" id="addReviewBtn">Add Review</button>
          </div>

          <div id="reviewForm" style="display: none;" class="mt-4">
            <form action="{{ route('peer_reviews.store') }}" method="POST" class="col-md-12">
              @csrf
              <input type="hidden" name="course_id" value="{{ $course->id }}">
              <input type="hidden" name="assessment_id" value="{{ $assessment->id }}">

              <div class="form-group">
                <label for="reviewee_id">Select Reviewee</label>
                <select name="reviewee_id" id="reviewee_id" class="form-control">
                  @foreach($potentialReviewees as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="review">Review</label>
                <textarea name="review" id="review" class="form-control" rows="4"></textarea>
              </div>

              <div class="form-group">
                <label for="score">Score</label>
                <input type="number" name="score" id="score" class="form-control" min="0" max="100">
              </div>

              <div class="d-flex justify-content-between mt-3">
                <button type="submit" class="btn btn-primary">Submit Review</button>
                <button type="button" class="btn btn-secondary" id="cancelBtn">Cancel</button>
              </div>
            </form>
          </div>
          
          @if ($errors->any())
            <div class="alert alert-danger mt-3">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
            </div>
          @endif
        </div>
      </div>
    </div>
  </section>

  <script>
    document.getElementById('addReviewBtn').addEventListener('click', function() {
      document.getElementById('reviewForm').style.display = 'block';
      this.style.display = 'none';
    });

    document.getElementById('cancelBtn').addEventListener('click', function() {
      document.getElementById('reviewForm').style.display = 'none';
      document.getElementById('addReviewBtn').style.display = 'block';
    });
  </script>
</x-app-layout>
