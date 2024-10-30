<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Relative;

class StudentRelativeController extends Controller
{
    /**
     * Display a listing of the students with their relatives.
     */
    public function index()
    {
        $students = Student::with('relatives')->get();
        return view('admin.students_relatives.index', compact('students'));
    }

    /**
     * Show the form for creating a new student with relatives.
     */
    public function create()
    {
        return view('admin.students_relatives.create');
    }

    /**
     * Store a newly created student and relatives in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'group_name' => 'required|string|max:255',
            'military_relation' => 'nullable|string|max:255',
  
            'relatives.*.first_name' => 'required|string|max:255',
            'relatives.*.last_name' => 'required|string|max:255',
            'relatives.*.middle_name' => 'nullable|string|max:255',
            'relatives.*.military_unit' => 'nullable|string|max:255',
            'relatives.*.relationship_type' => 'required|string|max:255',
        ]);

        $student = Student::create($request->only(['first_name', 'last_name', 'middle_name', 'group_name', 'military_relation']));

        foreach ($request->input('relatives') as $relativeData) {
            $relative = Relative::create([
                'first_name' => $relativeData['first_name'],
                'last_name' => $relativeData['last_name'],
                'middle_name' => $relativeData['middle_name'],
                'military_unit' => $relativeData['military_unit'],
            ]);

            $student->relatives()->attach($relative->id, ['relationship_type' => $relativeData['relationship_type']]);
        }

        return redirect()->route('admin.students-relatives.index')->with('success', 'Студента та родичів додано');
    }

    /**
     * Show the form for editing the specified student and their relatives.
     */
    public function edit($id)
    {
        $student = Student::with('relatives')->findOrFail($id);
        return view('admin.students_relatives.edit', compact('student'));
    }

    /**
     * Update the specified student and relatives in storage.
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

            'relatives.*.id' => 'nullable|exists:relatives,id',
            'relatives.*.first_name' => 'required|string|max:255',
            'relatives.*.last_name' => 'required|string|max:255',
            'relatives.*.middle_name' => 'nullable|string|max:255',
            'relatives.*.military_unit' => 'nullable|string|max:255',
            'relatives.*.relationship_type' => 'required|string|max:255',
        ]);

        $student->update($request->only(['first_name', 'last_name', 'middle_name', 'group_name', 'military_relation']));

        $existingRelatives = $student->relatives->pluck('id')->toArray();

        $syncData = [];
        $updatedRelativeIds = [];
        
        foreach ($request->input('relatives') as $relativeData) {
            if (isset($relativeData['id'])) {
                $relative = Relative::findOrFail($relativeData['id']);
                $relative->update([
                    'first_name' => $relativeData['first_name'],
                    'last_name' => $relativeData['last_name'],
                    'middle_name' => $relativeData['middle_name'],
                    'military_unit' => $relativeData['military_unit'],
                ]);
                $updatedRelativeIds[] = $relative->id;  
            } else {
                
                $relative = Relative::create([
                    'first_name' => $relativeData['first_name'],
                    'last_name' => $relativeData['last_name'],
                    'middle_name' => $relativeData['middle_name'],
                    'military_unit' => $relativeData['military_unit'],
                ]);
                $updatedRelativeIds[] = $relative->id;
            }

            $syncData[$relative->id] = ['relationship_type' => $relativeData['relationship_type']];
        }

        $relativesToDelete = array_diff($existingRelatives, $updatedRelativeIds);
        if (!empty($relativesToDelete)) {
            Relative::destroy($relativesToDelete);  
        }

        $student->relatives()->sync($syncData);

        return redirect()->route('admin.students-relatives.index')->with('success', 'Студента та родичів оновлено');
    }


    /**
     * Remove the specified student and their relatives from storage.
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('admin.students-relatives.index')->with('success', 'Студента та його родичів видалено');
    }
}
