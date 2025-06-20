<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCoursesHours = Course::select('course_duration')
                            ->where('courses.hours_pack', false)
                            ->sum('course_duration');

        $totalRevenues = Course::select(DB::raw('SUM('.$totalCoursesHours.' * hourly_rate) / 60 as total'))
            ->pluck('total')
            ->first();

        $classHoursPerSubject = DB::table('students')
                                    ->join('courses', 'courses.student_id', '=', 'students.id')
                                    ->join('subjects', 'subjects.id', '=', 'students.subject_id')
                                    ->where('courses.hours_pack', false)
                                    ->select(DB::raw('subjects.name, ROUND(SUM(course_duration/ 60)) as total'))
                                    ->groupBy('subjects.name')
                                    ->orderBy('total', 'desc')
                                    ->pluck('total', 'subjects.name');

        return view('dashboard')->with([
            'totalCoursesHours'    => $totalCoursesHours / 60,
            'totalRevenues'        => intval($totalRevenues),
            'totalStudents'        => Student::count(),
            'totalCourses'         => Course::count(),
            'totalHoursPerSubject' => $classHoursPerSubject,
        ]);
    }
}
