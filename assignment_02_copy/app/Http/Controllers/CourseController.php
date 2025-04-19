<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\User;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CourseController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth', only:[])
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->check()) {
            $user = auth()->user(); 

            if ($user->user_type == 'student'){
                $courses = $user->enrolledCourses;
            } elseif ($user->user_type == 'teacher'){
                $courses = $user->taughtCourses;
            } else {
                $courses = collect();
            }
        } else {
            $courses = Course::all();
        }
    
        return view('index', compact('courses'));
    }

    public function teacher_index()
    {
        $courses = Course::all();
        return view('teacher.teacher_enroll')->with('courses', $courses);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::find($id);
        $potentialEnrollees = User::where('user_type', 'student')
                              ->whereDoesntHave('enrolledCourses', function ($query) use ($id) {
                                  $query->where('course_id', $id);
                              })->get();

        if (auth()->check() && auth()->user()->user_type == 'teacher') {
            return view('teacher.detail', compact('course', 'potentialEnrollees'));
        }
    
        return view('detail', compact('course'));
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

    public function uploadForm()
    {
        return view('teacher.upload');
    }
}
