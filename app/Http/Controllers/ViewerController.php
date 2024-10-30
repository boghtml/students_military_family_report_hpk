<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

use Illuminate\Support\Facades\Auth;

class ViewerController extends Controller
{
    public function dashboard()
    {
        
        if (Auth::user()->role !== 'viewer') {
            return redirect('/')->withErrors(['msg' => 'Доступ заборонено']);
        }

        return view('viewer.dashboard');
    }

    public function index(Request $request)
    {
        $sort = $request->input('sort', 'last_name');
        $direction = $request->input('direction', 'asc');
        $search = $request->input('search', '');
        $group = $request->input('group', '');
        $name = $request->input('name', '');

        $allowedSorts = ['last_name', 'first_name', 'middle_name', 'group_name', 'relatives_count'];
        $allowedDirections = ['asc', 'desc'];

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'last_name';
        }

        if (!in_array($direction, $allowedDirections)) {
            $direction = 'asc';
        }

        // Запит з пошуком і фільтрацією
        $students = Student::with(['relatives'])
            ->withCount('relatives') // Підраховуємо кількість родичів для сортування
            ->when($search, function ($query, $search) {
                return $query->where('first_name', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%$search%")
                    ->orWhere('middle_name', 'like', "%$search%");
            })
            ->when($group, function ($query, $group) {
                return $query->where('group_name', 'like', "%$group%");
            })
            ->when($name, function ($query, $name) {
                return $query->where('first_name', 'like', "%$name%")
                    ->orWhere('last_name', 'like', "%$name%");
            })
            ->orderBy($sort, $direction)
            ->paginate(10)
            ->appends(['sort' => $sort, 'direction' => $direction, 'search' => $search, 'group' => $group, 'name' => $name]);

        return view('viewer.students.index', compact('students', 'search', 'group', 'name', 'sort', 'direction'));
    }



}
