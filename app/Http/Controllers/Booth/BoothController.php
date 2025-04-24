<?php

namespace App\Http\Controllers\Booth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Booth\CreateBoothRequest;
use App\Http\Requests\Booth\UpdateBoothRequest;
use App\Http\Resources\Booth\BoothResource;
use App\Models\Booth;
use App\Services\FileUploaderService;

class BoothController extends Controller
{
    protected $fileUploader;
    public function __construct(FileUploaderService $fileUploader)
    {
        $this->fileUploader = $fileUploader;
    }


    public function index()
    {
        $booths = Booth::latest()->paginate(10);
        return response()->json([
            'message' => 'Booths retrieved successfully',
            'data' => BoothResource::collection($booths)
        ], 200);
    }

    public function store(CreateBoothRequest $request)
    {
        $data = $request->validated();
        $booth = Booth::create();

        if ($request->hasFile('images')) {
            $this->fileUploader->uploadMultipleFiles($booth, $request['images'], 'images');
        }

        return response()->json([
            'message' => 'Booth created successfully',
            'data' => new BoothResource($booth)
        ], 201);
    }

    public function show(Booth $booth)
    {
        return response()->json([
            'message' => 'Booth retrieved successfully',
            'data' => new BoothResource($booth)
        ], 200);
    }

    public function update(UpdateBoothRequest $request, Booth $booth)
    {
        $data = $request->validated();

        if ($request->has('images')) {
            foreach ($request['images'] as $newImage) {
                $this->fileUploader->replaceFile($booth, $newImage['image'], $newImage['id'], 'images');
            }
        }

        return response()->json([
            'message' => 'Booth updated successfully',
            'data' => new BoothResource($booth)
        ], 200);
    }

    public function destroy(Booth $booth)
    {
        $booth->delete();
        $this->fileUploader->clearCollection($booth, 'images');
        return response()->json([
            'message' => 'Booth deleted successfully'
        ], 200);
    }
}
