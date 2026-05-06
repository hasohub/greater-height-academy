<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherPortalController extends Controller
{
    public function index()
    {
        if (!auth()->user()->hasRole('teacher')) {
            abort(403, 'Unauthorized');
        }
        return view('teacher.portal');
    }
}
