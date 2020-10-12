<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ProjectPayment;

class ProjectPaymentController extends Controller
{
    public function index()
    {
        if(Auth::user()->role == 'employee')
        {
            return view("welcome");

        } elseif (Auth::user()->role =='admin') 
        {
            return view("projectPayment.index");
        }   
    }
}
