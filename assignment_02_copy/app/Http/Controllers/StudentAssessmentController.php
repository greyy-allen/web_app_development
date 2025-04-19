<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\StudentAssessment;

class StudentAssessmentController extends Controller
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
    public function store(Request $request, $course_id, $assessment_id, $student_id)
    {
        $assessment = Assessment::findOrFail($assessment_id);

        $request->validate([
            'score' => 'required|integer|min:0|max:' . $assessment->max_score,
        ]);

        $studentAssessment = StudentAssessment::where('student_id', $student_id)
                                ->where('assessment_id', $assessment_id)
                                ->first();

        if ($studentAssessment) {
            $studentAssessment->final_score = $request->input('score');
            $studentAssessment->save();
        } else {
            StudentAssessment::create([
                'student_id' => $student_id,
                'assessment_id' => $assessment_id,
                'final_score' => $request->input('score'),
            ]);
        }

        return redirect()->back()->with('success', 'Score saved successfully!');
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
