<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\Home\CreateHomeRequest;
use App\Http\Requests\Home\UpdateHomeRequest;
use App\Http\Resources\Home\HomeResource;
use App\Models\Home;
use App\Services\FileUploaderService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $fileUploader;
    public function __construct(FileUploaderService $fileUploader)
    {
        $this->fileUploader = $fileUploader;
    }

    // public function index()
    // {
    //     $homes = Home::latest()->paginate(10);
    //     return response()->json([
    //         'message' => 'Homes retrieved successfully',
    //         'data' => HomeResource::collection($homes)
    //     ], 200);
    // }

    // public function store(CreateHomeRequest $request)
    // {
    //     $data = $request->validated();
    //     $home = Home::create($data);

    //     return response()->json([
    //         'message' => 'Home created successfully',
    //         'data' => new HomeResource($home)
    //     ], 201);
    // }

    public function show()
    {
        $home = Home::first();
        return response()->json([
            'message' => 'Home retrieved successfully',
            'data' => new HomeResource($home)
        ], 200);
    }

    public function update(UpdateHomeRequest $request)
    {
        $data = $request->validated();
        $home = Home::first();
        $home->update($data);

        return response()->json([
            'message' => 'Home updated successfully',
            'data' => new HomeResource($home)
        ], 200);
    }

    // public function destroy(Home $home)
    // {
    //     $home->delete();

    //     return response()->json([
    //         'message' => 'Home deleted successfully'
    //     ], 200);
    // }
}
