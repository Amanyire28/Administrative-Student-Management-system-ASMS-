<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

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
    public function index()
    {
        $recentAnnouncements = Announcement::active()
            ->orderBy('created_at', 'desc')
            ->limit(2)
            ->get();

        return view('dashboard.index', compact('recentAnnouncements'));
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