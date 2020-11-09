<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\LimbocoinsMove;
use App\User;

class LimbocoinsMoveController extends Controller
{
    private function getAllUser()
    {
        $Users = User::get();
        return $Users;
    }

    private function getAllLimbocoinsMoveRecords()
    {
        $limboCoins = LimbocoinsMove::with('user')->orderBy('id', 'desc')->paginate(10);
        $limboCoins->setPath('');
        return $limboCoins;
    }

    public function index()
    {
        $allUsers = $this->getAllUser();
        $allLimbocoinsMoveRecords = $this->getAllLimbocoinsMoveRecords();

        if(Auth::user()->role == 'employee')
        {
            return view("welcome");

        } elseif (Auth::user()->role =='admin') 
        {
            return view("limbocoinsMoves.index")
                ->with([
                    'allUsers' => $allUsers,
                    'allLimbocoinsMoveRecords' => $allLimbocoinsMoveRecords
                ]);
        }   
    }

    public function store(Request $request)
    {
        LimbocoinsMove::create([
            'user_id' => $request->userId,
            'amount' => $request->libocoinsAmount, 
            'description' => $request->description

        ]);

        return redirect(route('limbocoinsMove'));
    }

    public function destroy(LimbocoinsMove $LimbocoinsMove)
    {
        $LimbocoinsMove->delete();

        return redirect(route('limbocoinsMove'));
    }

    public function update(Request $request, LimbocoinsMove $LimbocoinsMove)
    {
        $LimbocoinsMove->update([
            'amount' => $request["amount"],
            'description' => $request["description"]
        ]);   
        return redirect(route('limbocoinsMove'));
    }
}
