<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectPayment;
use App\Project;

class ProjectsController extends Controller
{
    private function getProjectsRecords()
    {
        $projectsRecords = Project::with('project_payment')->orderBy('id', 'desc')->paginate(10);
        return $projectsRecords;
    }

    public function index()
    {
        $allProjectsRecords = $this->getProjectsRecords();

        return view('projects')
            ->with([
                'allProjectsRecords' => $allProjectsRecords,
            ]);;
    }

    public function store(Request $request)
    {
        Project::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect(route('projects'));
    }

    public function destroy(Project $project)
    {   
        $projectId = $project->id;
        $projectStatus = ProjectPayment::where('project_id', $projectId)->count();

        if ( $projectStatus > 0) {
            return redirect(route('projects'));
        } else {
            $project->delete();
            return redirect(route('projects'));
        }
    }

    public function update(Request $request, Project $project)
    {
        $project->update([
            'name' => $request["name"],
            'description' => $request["description"]
        ]);   
        return redirect(route('projects'));
    }
}
