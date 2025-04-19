<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeerReview;
use App\Models\Assessment;

class PeerReviewController extends Controller
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
        $assessment = Assessment::findOrFail($request->input('assessment_id'));
        // validations
        $request->validate([
            'assessment_id' => 'required|integer',
            'reviewee_id' => 'required|integer',
            'review' => [
                'required',
                'string',
                'max:255',
                function($attribute, $value, $fail) {
                    if (str_word_count($value) < 5) {
                        $fail('The ' . $attribute . ' must have at least 5 words.');
                    }
                },
            ],
            'score' => 'required|integer|min:0|max:' . $assessment->max_score,
        ]);
    
        $peerReview = new PeerReview();
        $peerReview->assessment_id = $request->input('assessment_id');
        $peerReview->reviewer_id = auth()->id();
        $peerReview->reviewee_id = $request->input('reviewee_id');
        $peerReview->review = $request->input('review');
        $peerReview->score = $request->input('score');
        
        $peerReview->save();
 
        return redirect()->route('show', [
            'course_id' => $request->input('course_id'),
            'assessment_id' => $request->input('assessment_id')
        ])->with('success', 'Review successfully added.');
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
