<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Assessment;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($course_id, $assessment_id)
    {
        $course = Course::findOrFail($course_id);
        $assessment = Assessment::findOrFail($assessment_id);

        $enrollments = Enrollment::with([
            'student.studentAssessments' => function ($query) use ($assessment_id) {
                $query->where('assessment_id', $assessment_id); 
            },
            'student.receivedPeerReviews' => function ($query) use ($assessment_id) {
                $query->where('assessment_id', $assessment_id); 
            },
            'student.givenPeerReviews' => function ($query) use ($assessment_id) {
                $query->where('assessment_id', $assessment_id); 
            }
        ])
        ->where('course_id', $course_id)
        ->paginate(8);

        return view('teacher.assessment_detail', compact('enrollments', 'course', 'assessment'));
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
            'student_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        $course = Course::find($request->input('course_id'));

        $alreadyEnrolled = Enrollment::where('course_id', $course->id)
                            ->where('student_id', $request->input('student_id'))
                            ->exists();

        if ($alreadyEnrolled) {
            return redirect()->back()->with('error', 'Student is already enrolled in this course.');
        }
                    
        $enrollment = new Enrollment();
        $enrollment->student_id = $request->input('student_id');  
        $enrollment->course_id = $request->input('course_id');    

        $enrollment->save();

        $potentialEnrollees = User::where('user_type', 'student')
                              ->whereDoesntHave('enrolledCourses', function ($query) use ($course) {
                                  $query->where('course_id', $course->id);
                              })->get();

        return redirect()->route('teacher.courses.show', ['course' => $course->id])
                        ->with('success', 'Student enrolled successfully.')
                        ->with(compact('course', 'potentialEnrollees'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
