<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Relative;

class StudentController extends Controller
{
    /**
     * Display a listing of the students.
     */
    public function index()
    {
        $students = Student::with('relatives')->get();
        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        return view('admin.students.create');
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'group_name' => 'required|string|max:255',
            'military_relation' => 'nullable|string|max:255',
        ]);

        $student = Student::create($request->only(['first_name', 'last_name', 'middle_name', 'group_name', 'military_relation']));

        return redirect()->route('students.index')->with('success', 'Студента додано');
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.students.edit', compact('student'));
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'group_name' => 'required|string|max:255',
            'military_relation' => 'nullable|string|max:255',
        ]);

        $student->update($request->only(['first_name', 'last_name', 'middle_name', 'group_name', 'military_relation']));

        return redirect()->route('students.index')->with('success', 'Студента оновлено');
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Студента видалено');
    }
}
