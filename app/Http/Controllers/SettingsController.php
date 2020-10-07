<?php

namespace App\Http\Controllers;

use App\Settings;
use Illuminate\Http\Request;

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
        return view('settings')
            ->with([
                'lastSettingsRecord' => $lastSettingsRecord
            ]);
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
