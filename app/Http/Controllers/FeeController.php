<?php

namespace App\Http\Controllers;

use App\Fee;
use App\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $fees = Fee::latest()->paginate(10);

        return view('46728.fees.index', compact('fees'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $students = Student::All();

        return view('46728.fees.fees', compact('students'));
    }

    /**
     * Create form for specific student
     * @param Student $student
     * @return Response
     */
    public function directPay(Student $student)
    {
        return view('46728.fees.direct', compact('student'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        // Custom field names
        $customAttributes = [
            'student_id' => 'student'
        ];
        $request->validate([
            'amount' => 'required|integer|min:100|max:1000000',
            'student_id' => 'required|exists:students,id',
        ], [], $customAttributes);

        Fee::create($request->all());

        return redirect()->route('fees.index')
            ->with('success', 'Payment made successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Fee $fee
     * @return Response
     */
    public function show(Fee $fee)
    {
        return view('46728.fees.show', compact('fee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Fee $fee
     * @return Response
     */
    public function edit(Fee $fee)
    {
        $students = Student::All();

        return view('46728.fees.edit', compact('fee', 'students'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Fee $fee
     * @return Response
     */
    public function update(Request $request, Fee $fee)
    {
        // Custom field names
        $customAttributes = [
            'student_id' => 'student'
        ];

        $request->validate([
            'amount' => 'required|integer|min:100|max:1000000',
            'student_id' => 'required|exists:students,id',
        ], [], $customAttributes);

        $fee->update($request->all());

        return redirect()->route('fees.index')
            ->with('success', 'Payment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Fee $fee
     * @return Response
     * @throws Exception
     */
    public function destroy(Fee $fee)
    {
        $fee->delete();

        return redirect()->route('fees.index')
            ->with('success', 'Payment deleted successfully');
    }
}
