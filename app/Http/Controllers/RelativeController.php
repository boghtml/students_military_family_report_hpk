<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Relative;

class RelativeController extends Controller
{
    public function index()
    {
        $relatives = Relative::all();
        return view('admin.relatives.index', compact('relatives'));
    }

    public function create()
    {
        return view('admin.relatives.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'military_unit' => 'nullable|string|max:255',
        ]);

        Relative::create($request->only(['first_name', 'last_name', 'middle_name', 'military_unit']));

        return redirect()->route('relatives.index')->with('success', 'Родича додано');
    }

    public function edit($id)
    {
        $relative = Relative::findOrFail($id);
        return view('admin.relatives.edit', compact('relative'));
    }

    public function update(Request $request, $id)
    {
        $relative = Relative::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'military_unit' => 'nullable|string|max:255',
        ]);

        $relative->update($request->only(['first_name', 'last_name', 'middle_name', 'military_unit']));

        return redirect()->route('relatives.index')->with('success', 'Родича оновлено');
    }

    public function destroy($id)
    {
        $relative = Relative::findOrFail($id);
        $relative->delete();

        return redirect()->route('relatives.index')->with('success', 'Родича видалено');
    }
}
