<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\Assessment;
use App\Models\Enrollment;

class UploadController extends Controller
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
        //
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

    public function uploadCourseFile(Request $request)
    {
        $request->validate([
            'course_file' => 'required|file|mimes:txt',
        ]);

        $file = $request->file('course_file');
        $content = file_get_contents($file);

        $data = $this->parseCourseFile($content);

        $existingTeacher = User::where('email', $data['teacher']['email'])
                            ->orWhere('s_number', $data['teacher']['s_number'])
                            ->first();

        if ($existingTeacher) {
            return back()->with('error', 'Teacher with the same credentials already exists.');
        }

        $t_user = new User();
        $t_user->name = $data['teacher']['name'];
        $t_user->email = $data['teacher']['email'];
        $t_user->s_number = $data['teacher']['s_number'];
        $t_user->user_type = $data['teacher']['user_type'];
        $t_user->password = bcrypt($data['teacher']['password']);

        $t_user->save();

        $t_user_id = $t_user->id;


        $existingCourse = Course::where('code', $data['course']['code'])->first();
        if ($existingCourse) {
            return back()->with('error', 'Course with the same code already exists.');
        }

        // dd($existingCourse);
        // dd((int)$data['course']['code']);

        $course = new Course();
        $course->code = (int)$data['course']['code'];
        $course->name = $data['course']['name'];
        $course->teacher_id = $t_user_id;

        $course->save();

        $course_id = $course->id;

        $assessment = new Assessment();
        $assessment->title = $data['assessment']['title'];
        $assessment->instruction = $data['assessment']['instruction'];
        $assessment->required_reviews = (int)$data['assessment']['required_reviews'];
        $assessment->assessment_type = $data['assessment']['assessment_type'];
        $assessment->max_score = (int)$data['assessment']['max_score'];
        $assessment->course_id = $course_id;
        $assessment->due_date = $data['assessment']['due_date'];

        $assessment->save();

        $existingStudent = User::where('email', $data['student']['email'])
                            ->orWhere('s_number', $data['student']['s_number'])
                            ->first();

        if ($existingStudent) {
            return back()->with('error', 'Student with the same credentials already exists.');
        }

        $user = new User();
        $user->name = $data['student']['name'];
        $user->email = $data['student']['email'];
        $user->s_number = $data['student']['s_number'];
        $user->user_type = $data['student']['user_type'];
        $user->password = bcrypt($data['student']['password']);

        $user->save();

        $user_id = $user->id;

        $enrollment = new Enrollment();
        $enrollment->student_id = $user_id;
        $enrollment->course_id = $course_id;

        $enrollment->save();

        return redirect()->back()->with('success', 'File upload successful!');
    }

    private function parseCourseFile($content)
    {
        $lines = explode("\n", $content);
        $data = [
            'course' => [],
            'teacher' => [],
            'assessment' => [],
            'students' => [],
        ];

        foreach ($lines as $line) {
            $line = trim($line);

            // course
            if (strpos($line, 'course_name:') === 0) {
                $data['course']['name'] = trim(substr($line, strlen('course_name:')));
            }

            if (strpos($line, 'course_code:') === 0) {
                $data['course']['code'] = (int)trim(substr($line, strlen('course_code:'))); 
            }
            
            // teacher
            if (strpos($line, 'teacher_name:') === 0) {
                $data['teacher']['name'] = trim(substr($line, strlen('teacher_name:')));
            }

            if (strpos($line, 'teacher_email:') === 0) {
                $data['teacher']['email'] = trim(substr($line, strlen('teacher_email:')));
            }

            if (strpos($line, 'teacher_s_number:') === 0) {
                $data['teacher']['s_number'] = trim(substr($line, strlen('teacher_s_number:')));
            }
            
            if (strpos($line, 'teacher_user_type:') === 0) {
                $data['teacher']['user_type'] = trim(substr($line, strlen('teacher_user_type:')));
            }

            if (strpos($line, 'teacher_password:') === 0) {
                $data['teacher']['password'] = trim(substr($line, strlen('teacher_password:')));
            }

            // assessment
            if (strpos($line, 'title:') === 0) {
                $data['assessment']['title'] = trim(substr($line, strlen('title:')));
            }

            if (strpos($line, 'instruction:') === 0) {
                $data['assessment']['instruction'] = trim(substr($line, strlen('instruction:')));
            }

            if (strpos($line, 'required_reviews:') === 0) {
                $data['assessment']['required_reviews'] = trim(substr($line, strlen('required_reviews:')));
            }

            if (strpos($line, 'assessment_type:') === 0) {
                $data['assessment']['assessment_type'] = trim(substr($line, strlen('assessment_type:')));
            }            

            if (strpos($line, 'max_score:') === 0) {
                $data['assessment']['max_score'] = trim(substr($line, strlen('max_score:')));
            }        

            if (strpos($line, 'due_date:') === 0) {
                $data['assessment']['due_date'] = trim(substr($line, strlen('due_date:')));
            }        
            
            //student
            if (strpos($line, 'student_name:') === 0) {
                $data['student']['name'] = trim(substr($line, strlen('student_name:')));
            }

            if (strpos($line, 'student_email:') === 0) {
                $data['student']['email'] = trim(substr($line, strlen('student_email:')));
            }

            if (strpos($line, 'student_s_number:') === 0) {
                $data['student']['s_number'] = trim(substr($line, strlen('student_s_number:')));
            }
            
            if (strpos($line, 'student_user_type:') === 0) {
                $data['student']['user_type'] = trim(substr($line, strlen('student_user_type:')));
            }

            if (strpos($line, 'student_password:') === 0) {
                $data['student']['password'] = trim(substr($line, strlen('student_password:')));
            }
        }

        return $data;
    }
}
