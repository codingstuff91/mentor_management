<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Customer;
use App\Models\Subject;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Services\CourseService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class StudentController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        $students = Student::with(['customer', 'subject'])
                    ->orderByDesc('active')
                    ->paginate(10);

        return view('student.index')->with(['students' => $students]);
    }

    /**
     * @return View
     */
    public function create()
    {
        $customers = Customer::all();
        $subjects = Subject::all();

        return view('student.create')->with(['customers' => $customers, 'subjects' => $subjects]);
    }

    /**
     * @param StoreStudentRequest $request
     * @return RedirectResponse
     */
    public function store(StoreStudentRequest $request)
    {
        Student::create([
            'name' => $request->name,
            'subject_id' => $request->subject,
            'customer_id' => $request->customer,
            'goals' => $request->goals,
            'comments' => $request->comments
        ]);

        return redirect()->route('student.index');
    }

    /**
     * @param Student $student
     * @return View
     */
    public function show(Student $student)
    {
        $student = Student::where('id',$student->id)
            ->with('subject')
            ->with('courses', function ($query){
                return $query->orderByDesc('date');
            })
            ->withCount('courses')
            ->withSum('courses', 'course_duration')
            ->first();

        $coursesDuration = CourseService::tranform_duration_into_HH_MM_format($student->courses_sum_course_duration);

        return view('student.show')->with([
            'student' => $student,
            'totalCourseHours' => $coursesDuration,
        ]);
    }

    /**
     * @param Student $student
     * @return View
     */
    public function edit(Student $student)
    {
        $subjects = Subject::all();
        $customers = Customer::all();

        return view('student.edit')->with([
            'student' => $student,
            'subjects' => $subjects,
            'customers' => $customers
        ]);
    }

    /**
     * @param UpdateStudentRequest $request
     * @param Student $student
     * @return RedirectResponse
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update([
            'name' => $request->name,
            'active' => $request->active,
            'subject_id' => $request->subject,
            'customer_id' => $request->customer,
            'goals' => $request->goals,
            'comments' => $request->comments
        ]);

        return redirect()->route('student.index');
    }
}
