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
                @forelse($course->assessments as $assessment)
                    <div class="d-flex justify-content-start">
                        <a href="{{ route('assessments.detail', ['course_id' => $course->id, 'assessment_id' => $assessment->id]) }}">
                            <li class="about-item">
                                <div class="about-item-icon">
                                    <ion-icon name="document-outline"></ion-icon>
                                </div>
                                <p class="about-item-text">{{ $assessment->title }} - Due: {{ $assessment->due_date }}</p>
                            </li>
                        </a>

                        <div class="d-flex align-items-center">
                            <button class="btn btn-secondary btn-sm" onclick="showEditForm({{ $assessment->id }})">Edit</button>
                        </div>
                    </div>
                @empty
                    <p>No assessments available for this course.</p>
                @endforelse
            </ul>
            <p class="callout">
              Professor: {{$course->teacher->name}}
            </p>
            
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

            <div class="d-flex justify-content-center">
                <div class="d-flex justify-content-center mt-3 px-3">
                    <button class="btn btn-primary" id="enrollStudentBtn">Enroll Student</button>
                </div>

                <div id="enrollForm" style="display: none;" class="mt-4">
                    <form action="{{ route('enrollments.store', ['course' => $course->id]) }}" method="POST" class="col-md-12">
                    @csrf
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        <div class="form-group">
                            <label for="student_id">Select Student to Enroll</label>
                            <select name="student_id" id="student_id" class="form-control">
                            @foreach($potentialEnrollees as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                            </select>
                        </div>
                        
                        <div class="d-flex justify-content-between mt-2">
                            <button type="submit" class="btn btn-primary px-2">Enroll</button>
                            <button type="button" class="btn btn-secondary px-2" id="cancelBtn">Cancel</button>
                        </div>
                    </form>
                </div>
                
                    <div class="d-flex justify-content-center mt-3 px-3">
                        <button class="btn btn-primary" id="addAssessmentBtn">Add Assessments</button>
                    </div>

                    <div id="assessmentForm" style="display: none;" class="mt-4 col-md-10">
                        <form action="{{ route('assessments.store', ['course' => $course->id]) }}" method="POST" class="col-md-12">
                            @csrf

                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            <input type="hidden" name="assessment_id" id="assessment_id" value="">

                            <div class="form-group">
                                <label for="title">Assessment Title</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="instruction">Instructions</label>
                                <textarea name="instruction" id="instruction" class="form-control" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="required_reviews">Required Reviews</label>
                                <input type="number" name="required_reviews" id="required_reviews" class="form-control" min="1" required>
                            </div>

                            <div class="form-group">
                                <label for="assessment_type">Assessment Type</label>
                                <select name="assessment_type" id="assessment_type" class="form-control" required>
                                    <option value="student_select">Student Select</option>
                                    <option value="teacher_assign">Teacher Assign</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="max_score">Max Score</label>
                                <input type="number" name="max_score" id="max_score" class="form-control" min="1" required>
                            </div>

                            <div class="form-group">
                                <label for="due_date">Due Date</label>
                                <input type="date" name="due_date" id="due_date" class="form-control" required>
                            </div>

                            <div class="d-flex justify-content-between mt-2">
                                <button type="submit" class="btn btn-primary px-2">Save Assessment</button>
                                <button type="button" class="btn btn-secondary px-2" id="cancelAssessmentBtn">Cancel</button>
                            </div>
                        </form>
                    </div>

                    @if($course->assessments->count() > 0)
                        <div id="assessmentEditForm" style="display: none;" class="mt-4 col-md-10">
                            <form id="assessmentEditFormElement" action="{{ route('assessments.update', ['course_id' => $course->id, 'assessment_id' => $assessment->id]) }}" method="POST">
                                {{csrf_field()}}
                                {{method_field('PUT')}}

                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                <input type="hidden" name="assessment_id" id="assessment_id_edit" value="{{ $assessment->id }}">

                                <div class="form-group">
                                    <label for="title">Assessment Title</label>
                                    <input type="text" name="title" id="title_edit" class="form-control" value="{{ $assessment->title }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="instruction">Instructions</label>
                                    <textarea name="instruction" id="instruction_edit" class="form-control" required>{{ $assessment->instruction }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="required_reviews">Required Reviews</label>
                                    <input type="number" name="required_reviews" id="required_reviews_edit" class="form-control" min="1" value="{{ $assessment->required_reviews }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="assessment_type">Assessment Type</label>
                                    <select name="assessment_type" id="assessment_type_edit" class="form-control" required>
                                        <option value="student_select" {{ $assessment->assessment_type == 'student_select' ? 'selected' : '' }}>Student Select</option>
                                        <option value="teacher_assign" {{ $assessment->assessment_type == 'teacher_assign' ? 'selected' : '' }}>Teacher Assign</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="max_score">Max Score</label>
                                    <input type="number" name="max_score" id="max_score_edit" class="form-control" min="1" value="{{ $assessment->max_score }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="due_date">Due Date</label>
                                    <input type="date" name="due_date" id="due_date_edit" class="form-control" value="{{ $assessment->due_date }}" required>
                                </div>

                                <div class="d-flex justify-content-between mt-2">
                                    <button type="submit" class="btn btn-primary px-2">Update Assessment</button>
                                    <button type="button" class="btn btn-secondary px-2" id="cancelAssessmentEditBtn">Cancel</button>
                                </div>
                            </form>
                        </div>
                    @endif
            </div>
          </div>

        </div>
    </section>

<script>
    document.getElementById('enrollStudentBtn').addEventListener('click', function() {
      document.getElementById('enrollForm').style.display = 'block';
      document.getElementById('addAssessmentBtn').style.display = 'none';
      this.style.display = 'none';
    });

    document.getElementById('addAssessmentBtn').addEventListener('click', function() {
      document.getElementById('assessmentForm').style.display = 'block';
      document.getElementById('enrollStudentBtn').style.display = 'none';
      this.style.display = 'none';
    });

    document.getElementById('cancelBtn').addEventListener('click', function() {
      document.getElementById('enrollForm').style.display = 'none';
      document.getElementById('assessmentForm').style.display = 'none';
      document.getElementById('enrollStudentBtn').style.display = 'block';
      document.getElementById('addAssessmentBtn').style.display = 'block';
    });

    document.getElementById('cancelAssessmentBtn').addEventListener('click', function() {
      document.getElementById('enrollForm').style.display = 'none';
      document.getElementById('assessmentForm').style.display = 'none';
      document.getElementById('enrollStudentBtn').style.display = 'block';
      document.getElementById('addAssessmentBtn').style.display = 'block';
    });

    document.getElementById('cancelAssessmentEditBtn').addEventListener('click', function() {
      document.getElementById('enrollForm').style.display = 'none';
      document.getElementById('assessmentEditForm').style.display = 'none';
      document.getElementById('enrollStudentBtn').style.display = 'block';
      document.getElementById('addAssessmentBtn').style.display = 'block';
    });

    function showEditForm(assessmentId) {
        const assessments = @json($course->assessments);
        const assessment = assessments.find(a => a.id === assessmentId);

        if (assessment) {
            document.getElementById('assessment_id_edit').value = assessment.id;
            document.getElementById('title_edit').value = assessment.title;
            document.getElementById('instruction_edit').value = assessment.instruction;
            document.getElementById('required_reviews_edit').value = assessment.required_reviews;
            document.getElementById('assessment_type_edit').value = assessment.assessment_type;
            document.getElementById('max_score_edit').value = assessment.max_score;
            document.getElementById('due_date_edit').value = assessment.due_date;

            document.getElementById('assessmentEditForm').style.display = 'block';
            document.getElementById('assessmentForm').style.display = 'none'; 
            document.getElementById('enrollStudentBtn').style.display = 'none';
            document.getElementById('addAssessmentBtn').style.display = 'none';
        }
    }

</script>

</x-app-layout>