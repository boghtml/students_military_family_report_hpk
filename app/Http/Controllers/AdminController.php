<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->withErrors(['msg' => 'Доступ заборонено']);
        }

        return view('admin.dashboard');
    }
}
