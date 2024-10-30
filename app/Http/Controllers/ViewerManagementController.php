<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ViewerManagementController extends Controller
{
    /**
     * Display a listing of the viewers.
     */
    public function index()
    {
        $viewers = User::where('role', 'viewer')->get();
        return view('admin.viewers.index', compact('viewers'));
    }

    /**
     * Show the form for creating a new viewer.
     */
    public function create()
    {
        return view('admin.viewers.create');
    }

    /**
     * Store a newly created viewer in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'viewer',
        ]);

        return redirect()->route('admin.viewers.index')->with('success', 'Глядача додано');
    }

    /**
     * Show the form for editing the specified viewer.
     */
    public function edit($id)
    {
        $viewer = User::findOrFail($id);
        return view('admin.viewers.edit', compact('viewer'));
    }

    /**
     * Update the specified viewer in storage.
     */
    public function update(Request $request, $id)
    {
        $viewer = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $viewer->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $viewer->name = $request->name;
        $viewer->email = $request->email;

        if ($request->filled('password')) {
            $viewer->password = Hash::make($request->password);
        }

        $viewer->save();

        return redirect()->route('admin.viewers.index')->with('success', 'Глядача оновлено');
    }

    /**
     * Remove the specified viewer from storage.
     */
    public function destroy($id)
    {
        $viewer = User::findOrFail($id);
        $viewer->delete();

        return redirect()->route('admin.viewers.index')->with('success', 'Глядача видалено');
    }
}
