<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\TimeRange;
use Carbon\Carbon;
use App\User;


class HomeController extends Controller
{
    private function getAllTimeRecords()
    {
        $allTimeRecords = TimeRange::where('user_id', Auth::id())->paginate(10);
        return $allTimeRecords;
    }
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
        $recordsForReturn = $this->getAllTimeRecords(); 

        return view('home')
            ->with([
                'allTimeRecords' => $recordsForReturn,
            ]);
    }
}
