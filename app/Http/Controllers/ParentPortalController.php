<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParentPortalController extends Controller
{
    public function index()
    {
        if (!auth()->user()->hasRole('parent')) {
            abort(403, 'Unauthorized');
        }
        return view('parent.portal');
    }
}
