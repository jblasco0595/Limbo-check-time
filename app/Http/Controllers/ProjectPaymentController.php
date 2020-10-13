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

    private function getAllPaidProjects()
    {
        $paidProjects = ProjectPayment::with('project')->orderBy('id', 'desc')->paginate(10);
        return $paidProjects;
    }

    public function index()
    {
        $projectsForPayments = $this->getAllProjectRecord();
        $allPaidProjects = $this->getAllPaidProjects();

        if(Auth::user()->role == 'employee')
        {
            return view("welcome");

        } elseif (Auth::user()->role =='admin') 
        {
            return view("projectPayment.index")
                ->with([
                    'projectsForPayments' => $projectsForPayments,
                    'allPaidProjects' => $allPaidProjects
                ]);
        }   
    }

    public function store(Request $request)
    {
        ProjectPayment::create([
            'project_id' => $request->projectId,
            'date' => $request->paymentDate,
            'amount' => $request->paymentAmount,
        ]);

        return redirect(route('projectsPayment'));
    }

    public function destroy(ProjectPayment $projectPayment)
    {
        $projectPayment->delete();

        return redirect(route('projectsPayment'));
    }

    public function update(Request $request, ProjectPayment $projectPayment)
    {
        $projectPayment->update([
            'date' => $request["paymentDate"],
            'amount' => $request["amount"]
        ]);   
        return redirect(route('projectsPayment'));
    }
}
