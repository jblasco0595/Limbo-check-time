<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\TimeRange;
use Carbon\Carbon;
use App\User;

class CheckController extends Controller
{
    private function getLastTimeRecord()
    {
        $lastTimeRecord = TimeRange::where('user_id', Auth::id())->get()->last();
        return $lastTimeRecord;
    }

    private function getAccumTime()
    {
        $today = Carbon::today();

        return  TimeRange::where('user_id', Auth::id())
            ->where('created_at','>=',$today)
            ->sum('seconds_difference');
    }

    private function makeNewStartTime()
    {
        $newTimeRange = TimeRange::create(array(
            'user_id' => Auth::id(),
            'init_time' => Carbon::now()
        ));

        return response()->json([
            'code' => 200,
            'msg' => 'startTimeSi',
            'lastTimeRange' => $newTimeRange
        ]);
    }

    private function takeAccumTime ($endingTime)
    {
        $lastTimeRecord = $this->getLastTimeRecord();
        $lastInitTime = $lastTimeRecord->init_time;
        $endTime = $endingTime;

        return $accumTime = $endTime->diffInSeconds($lastInitTime);

    }

    public function index()
    {
        $timeRecord = $this->getLastTimeRecord();
        $lastAccumTime = $this->getAccumTime();
        return view('check')
            ->with([
                'timeRecord' => $timeRecord,
                'accTime' => $lastAccumTime
            ]);
    }

    public function startTime(Request $request)
    {
        $lastRecord = $this->getLastTimeRecord();

        if($lastRecord)
        {
            if($lastRecord->end_time != null)
            {
               return $this->makeNewStartTime();
            } else {
                return response()->json([
                    'code' => 205,
                    'msg' =>  'startTimeNo'
                ]);
            }
        } else {
            return $this->makeNewStartTime();
        }
    }

    public function endTime()
    {
        $lastRecord = $this->getLastTimeRecord();

        if($lastRecord)
        {
            if($lastRecord->end_time == null)
            {
                $endTime = Carbon::now();
                $accumTime = $this->takeAccumTime($endTime);

                $lastRecord->update([
                        'end_time'=> $endTime,
                        'seconds_difference' => $accumTime
                    ]);
                $lastAccumulateTime = $this->getAccumTime();

                return response()
                    ->json([
                        'code' => 200,
                        'msg' => 'endTimeSi',
                        'lastTimeRange' => $lastRecord,
                        'lastAccumulateTime' => $lastAccumulateTime
                    ]);
            } else {
                return response()->json([
                    'code' => 205,
                    'msg'=> 'endTimeNo',
                ]);
            }
        } else {
            return response()
                ->json([
                    'code' => 205,
                    'msg' => 'endTimeNo'
                ]);
        }
    }
}
