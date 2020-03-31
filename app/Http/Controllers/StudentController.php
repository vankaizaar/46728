<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $students = Student::latest()->paginate(10);

        return view('46728.students.index', compact('students'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('46728.students.student');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $customAttributes = [
            'first_name' => 'first name',
            'last_name' => 'last name',
            'dob' => 'date of birth'
        ];

        $request->validate([
            'first_name' => 'required|string|min:2|max:20',
            'last_name' => 'nullable|string|min:2|max:20',
            'surname' => 'required|string|min:2|max:20',
            'dob' => 'required|date',
            'course' => 'required'
        ], [], $customAttributes);


        Student::create($request->all());


        return redirect()->route('students.index')
            ->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Student $student
     * @return Response
     */
    public function show(Student $student)
    {
        return view('46728.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Student $student
     * @return Response
     */
    public function edit(Student $student)
    {
        return view('46728.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Student $student
     * @return Response
     */
    public function update(Request $request, Student $student)
    {
        $customAttributes = [
            'first_name' => 'first name',
            'last_name' => 'last name',
            'dob' => 'date of birth'
        ];

        $request->validate([
            'first_name' => 'required|string|min:2|max:20',
            'last_name' => 'nullable|string|min:2|max:20',
            'surname' => 'required|string|min:2|max:20',
            'dob' => 'required|date',
            'course' => 'required'
        ], [], $customAttributes);
        
        $student->update($request->all());


        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Student $student
     * @return Response
     * @throws \Exception
     */
    public function destroy(Student $student)
    {
        $student->delete();


        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully');
    }
}
