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
}
