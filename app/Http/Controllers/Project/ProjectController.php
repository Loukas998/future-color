<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Project\CreateProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Http\Resources\Project\ProjectResource;
use App\Models\Project;
use App\Services\FileUploaderService;

class ProjectController extends Controller
{
    protected $fileUploader;
    public function __construct(FileUploaderService $fileUploader)
    {
        $this->fileUploader = $fileUploader; 
   
    }

    public function index()
    {
        if(request()->query('category_id') !== null)
        {
            $projects = Project::where('category_id', request()->query('category_id'))->latest()->paginate(10);
            return response()->json([
               'message' => 'Projects retrieved successfully',
                'data' => ProjectResource::collection($projects)
            ], 200);
        }
        $projects = Project::latest()->paginate(10);
        return response()->json([
            'message' => 'Projects retrieved successfully',
            'data' => ProjectResource::collection($projects)
        ], 200);
    }

    public function store(CreateProjectRequest $request)
    {
        $data = $request->validated();
        $project = Project::create([
            'category_id'     => $data['category_id'],
            'title'           => $data['title'],
            'description_one' => $data['description_one'],
            'deadline'        => $data['deadline'],
            'location'        => $data['location'],
        ]);

        if($request->hasFile('images'))
        {
            $this->fileUploader->uploadMultipleFiles($project, $request['images'], 'images');
        }

        return response()->json([
            'message' => 'Project created successfully',
            'data' => new ProjectResource($project)
        ], 201);
    }

    public function show(Project $project)
    {
        return response()->json([
            'message' => 'Project retrieved successfully',
            'data' => new ProjectResource($project)
        ], 200);
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();
        $project->update([
            'category_id'     => $data['category_id'],
            'title'           => $data['title'],
            'description_one' => $data['description_one'],
            'deadline'        => $data['deadline'],
            'location'        => $data['location'],
        ]);

        if($request->hasFile('images'))
        {
            $this->fileUploader->clearCollection($project, 'images');
            $this->fileUploader->uploadMultipleFiles($project, $request['images'], 'images');
        }

        return response()->json([
            'message' => 'Project updated successfully',
            'data' => new ProjectResource($project)
        ], 200);
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return response()->json([
            'message' => 'Project deleted successfully'
        ], 200);
    }
}
