<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\TimeRange;
use App\Settings;
use App\ExtraTime;
use App\User;


class HomeController extends Controller
{
    private function getLimbocoinPrice()
    {
        $settingsRecord = Settings::get()->last();
        return $settingsRecord;
    }
    
    private function getExtraAccumulatedHours()
    {
        $hours = ExtraTime::where('user_id', Auth::id())
            ->where('approved', true)
            ->sum('hours');
        return $hours;
    }

    private function getAllTimeRecords()
    {
        $allTimeRecords = TimeRange::where('user_id', Auth::id())->latest()->paginate(10);
        return $allTimeRecords;
    }

    private function getAllTimeRecordsAdmin()
    {
        $allTimeRecordsAdmin = TimeRange::with('user')->orderBy('id', 'desc')->paginate(10);
        return $allTimeRecordsAdmin;
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
        $extraTimeAccumulatedHours = $this->getExtraAccumulatedHours();
        $settingPrinceLimboCoin = $this->getLimbocoinPrice();
        $allRecordsForReturn = $this->getAllTimeRecordsAdmin();

        if(Auth::user()->role == 'employee')
        {
            return view('home')
                ->with([
                    'allTimeRecords' => $recordsForReturn,
                    'extraTimeAccumulatedHours' => $extraTimeAccumulatedHours,
                    'settingPriceLimboCoin' => $settingPrinceLimboCoin
                ]);
        } elseif (Auth::user()->role =='admin') 
        {
            return view('homeAdmin')
                ->with([
                    'allRecords' => $allRecordsForReturn,
                    'extraTimeAccumulatedHours' => $extraTimeAccumulatedHours,
                    'settingPriceLimboCoin' => $settingPrinceLimboCoin
                ]);
        }   
    }
}
