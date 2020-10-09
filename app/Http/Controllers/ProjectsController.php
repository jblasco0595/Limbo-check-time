<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectsController extends Controller
{
    private function getProjectsRecords()
    {
        $projectsRecords = Project::orderBy('id', 'desc')->paginate(10);
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
        $project->delete();

        return redirect(route('projects'));
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
