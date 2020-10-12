<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ProjectPayment;
use App\Project;

class ProjectPaymentController extends Controller
{
    private function getAllProjectRecord()
    {
        $projects = Project::latest()->get();
        return $projects;
    }

    public function index()
    {
        $projectsForPayments = $this->getAllProjectRecord();

        if(Auth::user()->role == 'employee')
        {
            return view("welcome");

        } elseif (Auth::user()->role =='admin') 
        {
            return view("projectPayment.index")
                ->with([
                    'projectsForPayments' => $projectsForPayments
                ]);
        }   
    }

    public function store(Request $request)
    {
        return $request;
        
        ProjectPayment::create([
            'project_id' => Auth::id(),
            'date' => $request->hours,
            'amount' => $request->description,
        ]);

        return redirect(route('projectPayment.index'));
    }
}
