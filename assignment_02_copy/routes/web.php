<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\PeerReviewController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\StudentAssessmentController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Home
Route::get('/', [CourseController::class, 'index'])->name('index');

//Course 
Route::resource('courses', CourseController::class);

//Assessment
Route::get('courses/{course_id}/assessments/{assessment_id}', [AssessmentController::class, 'show'])->name('show');

Route::post('/peer_reviews', [PeerReviewController::class, 'store'])->name('peer_reviews.store');


// Teacher Routes
// Route::get('/teacher', [CourseController::class, 'teacher_index'])->name('teacher.index');

// Route::resource('/teacher/courses', CourseController::class);

// // Teacher Enrollments
// Route::post('/teacher/courses/{course}/enroll', [EnrollmentController::class, 'store'])->name('enrollments.store');

// // Teacher Create Assessment
// Route::post('/teacher/courses/{course}/create_assessment', [AssessmentController::class, 'store'])->name('assessments.store');

// // Teacher Update Assessment
// Route::put('/teacher/courses/{course_id}/assessments/{assessment_id}', [AssessmentController::class, 'update'])->name('assessments.update');

Route::get('/test2', function(){
    return view('teacher.assessment_detail');
});

Route::prefix('teacher')->middleware('auth')->group(function () {
    Route::get('/', [CourseController::class, 'teacher_index'])->name('teacher.index');

    // Teacher Course Routes
    Route::resource('courses', CourseController::class);

    // Teacher Enrollment Routes
    Route::post('courses/{course}/enroll', [EnrollmentController::class, 'store'])->name('enrollments.store');

    // Teacher Courses
    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('teacher.courses.show');

    // Teacher Assessment Routes
    Route::post('courses/{course}/create_assessment', [AssessmentController::class, 'store'])->name('assessments.store');
    
    // Update Assessment Details
    Route::put('courses/{course_id}/assessments/{assessment_id}', [AssessmentController::class, 'update'])->name('assessments.update');

    // Assessment Details Page listing the students
    Route::get('courses/{course_id}/assessments/{assessment_id}/detail', [EnrollmentController::class, 'index'])->name('assessments.detail');

    // Assessment Details Page student details
    Route::get('courses/{course_id}/assessments/{assessment_id}/detail/{student_id}', [AssessmentController::class, 'teacher_show'])->name('assessments.student');

    // Set Score for student
    Route::post('courses/{course_id}/assessments/{assessment_id}/detail/{student_id}/set_score', [StudentAssessmentController::class, 'store'])->name('set_score.student');

    Route::get('uploadForm', [CourseController::class, 'uploadForm'])->name('uploadForm');
    // Upload file
    Route::post('uploadForm/upload', [UploadController::class, 'uploadCourseFile'])->name('uploadCourseFile');
});

//Go to upload form
// Route::get('/test', function(){
//     return view('teacher.upload');
// });

require __DIR__.'/auth.php';

