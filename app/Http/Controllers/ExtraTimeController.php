<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\ExtraTime;
use App\TimeRange;
use Carbon\Carbon;
use App\User;

class ExtraTimeController extends Controller
{
    private function getExtraTimeRecords()
    {
        $extraTimeRecords = ExtraTime::with('user')->orderBy('id', 'desc')->paginate(10);
        $extraTimeRecords->setPath('');
        return $extraTimeRecords;
    }

    private function getUserExtraTimes()
    {
        $userExtraTimeList = ExtraTime::where('user_id', Auth::id())->orderBy('id', 'desc')->paginate(10);
        $userExtraTimeList->setPath('');
        return $userExtraTimeList;
    }

    public function index()
    {
        $extraTimeRecords = $this->getExtraTimeRecords();
        $userExtraTimes = $this->getUserExtraTimes();

        if(Auth::user()->role == 'employee')
        {
            return view("extraTime.extraTimeEmployee")
                ->with([
                    'userExtraTimes' => $userExtraTimes
                ]);

        } elseif (Auth::user()->role =='admin') 
        {
            return view("extraTime.index")
                ->with([
                    'extraTimeRecords' => $extraTimeRecords
                ]);
        }   
    }

    public function store(Request $request)
    {
        ExtraTime::create([
            'user_id' => Auth::id(),
            'hours' => $request->hours,
            'description' => $request->description,
        ]);

        return redirect(route('extraTime'));
    }

    public function destroy(ExtraTime $extraTime)
    {
        if($extraTime->approved == 0)
        {
            $extraTime->delete();

            return redirect(route('extraTime'));
        } else {

            return redirect(route('extraTime'));
        }

        
    }

    public function update(Request $request, ExtraTime $extraTime )
    {
        if($extraTime->approved == 0)
        {
            $extraTime->update([
                'hours' => $request["hours"],
                'description' => $request["description"]
            ]);   
            return redirect(route('extraTime'));
        } else {

            return redirect(route('extraTime'));
        }
        
    }

    public function approved(Request $request, ExtraTime $extraTime)
    {   
        $extraTime->update([
            'approved' => true,
        ]);   
        return redirect(route('extraTime'));
    }
}
