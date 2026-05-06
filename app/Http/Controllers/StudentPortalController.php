<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentPortalController extends Controller
{
    public function index()
    {
        // Ensure user has student role
        if (!auth()->user()->hasRole('student')) {
            abort(403, 'Unauthorized');
        }
        return view('student.portal');
    }
}
