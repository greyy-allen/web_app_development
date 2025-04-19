<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\PeerReview;
use App\Models\User;
use App\Models\Course;
use App\Models\StudentAssessment;

class AssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:20',
            'instruction' => 'required|string',
            'required_reviews' => 'required|integer|min:1',
            'assessment_type' => 'required|string|in:student_select,teacher_assign',
            'max_score' => 'required|integer|min:1',
            'due_date' => 'required|date|after:today',
        ]);

        $assessment = new Assessment();
        $assessment->title = $request->input('title');
        $assessment->instruction = $request->input('instruction');
        $assessment->required_reviews = $request->input('required_reviews');
        $assessment->assessment_type = $request->input('assessment_type');
        $assessment->course_id = $request->input('course_id'); 
        $assessment->max_score = $request->input('max_score');
        $assessment->due_date = $request->input('due_date');
    
        $assessment->save();

        return redirect()->route('teacher.courses.show', $request->input('course_id'))
                        ->with('success', 'Assessment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($course_id, $assessment_id)
    {
        $assessment = Assessment::find($assessment_id);
        $course = Course::find($course_id);

        $reviewedUsers = PeerReview::where('reviewer_id', auth()->id())
                                 ->where('assessment_id', $assessment_id)
                                 ->pluck('reviewee_id')->toArray();

        $potentialReviewees = User::where('user_type', 'student')
                                ->where('id', '!=', auth()->id())
                                ->whereNotIn('id', $reviewedUsers)
                                ->get(); 

        $reviewsReceived = PeerReview::where('reviewee_id', auth()->id())
                                    ->where('assessment_id', $assessment_id)
                                    ->get();
        
        $reviewsSent = PeerReview::where('reviewer_id', auth()->id())
                                ->where('assessment_id', $assessment_id)
                                ->get();

        $studentAssessment = StudentAssessment::where('student_id', auth()->id())
                    ->where('assessment_id', $assessment_id)
                    ->first();
    
        $hasFinalScore = $studentAssessment ? $studentAssessment->final_score !== null : false;

        $completedRequiredReviews = $reviewsSent->count() == $assessment->required_reviews;                               
        
        return view('assessment', [
            'assessment' => $assessment,
            'course' => $course,
            'peer_reviews' => $assessment->peerReviews,
            'reviewsReceived' => $reviewsReceived,
            'reviewsSent' => $reviewsSent,
            'potentialReviewees' => $potentialReviewees, 
            'hasFinalScore' => $hasFinalScore,
            'completedRequiredReviews' => $completedRequiredReviews,
            'finalScore' => $studentAssessment ? $studentAssessment->final_score : null,
        ]);
    }

    public function teacher_show($course_id, $assessment_id, $student_id)
    {
        $assessment = Assessment::find($assessment_id);
        $course = Course::find($course_id);
        $student = User::find($student_id);

        $studentAssessment = StudentAssessment::where('student_id', $student_id)
                                ->where('assessment_id', $assessment_id)
                                ->first();

        $reviewsReceived = PeerReview::where('reviewee_id', $student_id)
                                    ->where('assessment_id', $assessment_id)
                                    ->get();
        
        $reviewsSent = PeerReview::where('reviewer_id', $student_id)
                                ->where('assessment_id', $assessment_id)
                                ->get();

        $reviewsSentIncomplete = $reviewsSent->count() !== $assessment->required_reviews;                                
        
        return view('teacher.assessment_student', [
            'assessment' => $assessment,
            'course' => $course,
            'student' => $student,
            'peer_reviews' => $assessment->peerReviews,
            'reviewsReceived' => $reviewsReceived,
            'reviewsSent' => $reviewsSent,
            'studentAssessment' => $studentAssessment,
            'reviewsSentIncomplete' => $reviewsSentIncomplete,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $course_id = $request->input('course_id');
        $assessment_id = $request->input('assessment_id');

        $assessment = Assessment::findOrFail($assessment_id);

        $hasSubmissions = $assessment->peerReviews()->exists();
        
        if ($hasSubmissions) {
            return redirect()->back()->with('error', 'Cannot update assessment because submissions have already been made.');
        }

        $request->validate([
            'title' => 'required|string|max:20',
            'instruction' => 'required|string',
            'required_reviews' => 'required|integer|min:1',
            'assessment_type' => 'required|string|in:student_select,teacher_assign',
            'max_score' => 'required|integer|min:1',
            'due_date' => 'required|date|after:today',
        ]);
    
        $assessment->title = $request->input('title');
        $assessment->instruction = $request->input('instruction');
        $assessment->required_reviews = $request->input('required_reviews');
        $assessment->assessment_type = $request->input('assessment_type');
        $assessment->max_score = $request->input('max_score');
        $assessment->due_date = $request->input('due_date');

        $assessment->save();
    
        return redirect()->route('courses.show', $course_id)
                         ->with('success', 'Assessment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
