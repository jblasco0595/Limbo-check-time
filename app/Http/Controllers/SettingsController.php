<?php

namespace App\Http\Controllers;

use App\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    private function getLastSettingsRecord()
    {
        $settingsRecord = Settings::get()->last();
        return $settingsRecord;
    }

    public function index()
    {
        $lastSettingsRecord = $this->getLastSettingsRecord();

        if(Auth::user()->role == 'employee')
        {
            return view('welcome');
              
        } elseif (Auth::user()->role =='admin') 
        {
            return view('settings')
            ->with([
                'lastSettingsRecord' => $lastSettingsRecord
            ]);
        }
    }

    public function store(Request $request)
    {   
        Settings::create(array(
            'montly_goal'=> $request->montlyGoal,
            'limbocoin_ars_price' =>  $request->limboCoinsArsPrice
        ));
        return redirect(route('settings'));
    }
}
