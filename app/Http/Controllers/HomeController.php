<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job\Job;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $duplicates= DB::table('searches')
        ->select('keyword', DB::raw('COUNT(*) as `count`'))
        ->groupBy('keyword')
        ->havingRaw('COUNT(*)>1')
        ->take(3)
        ->orderBy('count', 'asc')
        ->get();


        $jobs = Job::select()->take(5)->orderby('id', 'desc')->get();
        $totalJobs = Job::all()-> count();

        return view('home', compact('jobs', 'totalJobs', 'duplicates'));
    }

  
}
