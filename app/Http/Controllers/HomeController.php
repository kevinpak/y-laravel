<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $salaries = Employee::select(DB::raw("AVG(salary) as count"))
                        ->orderBy("created_at")
                        ->groupBy(DB::raw("year(created_at)"))
                        ->get()->toArray();
        $salaries = array_column($salaries, 'count');
    

    return view('welcome')
        ->with('salaries',json_encode($salaries,JSON_NUMERIC_CHECK));
    }
}
