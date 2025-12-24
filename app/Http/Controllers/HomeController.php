<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\ClassModel;
use App\Models\Subject;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Will add auth middleware later
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get counts for dashboard stats
        $stats = [
            'students' => Student::count(),
            'teachers' => Teacher::count(),
            'classes' => ClassModel::count(),
            'subjects' => Subject::count(),
        ];

        // For HTMX requests - return ONLY the inner content (no wrapper)
        if ($request->header('HX-Request')) {
            return response()
                ->view('dashboard.partials.content', compact('stats'))
                ->header('HX-Title', 'Dashboard - ' . config('app.name'));
        }

        // For regular requests - return full page with layout
        return view('dashboard.index', compact('stats'));
    }

    /**
     * Show the welcome/landing page.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view('index');
    }
}
