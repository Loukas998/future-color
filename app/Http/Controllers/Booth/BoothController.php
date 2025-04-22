<?php

namespace App\Http\Controllers\Booth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Booth\CreateBoothRequest;
use App\Http\Requests\Booth\UpdateBoothRequest;
use App\Http\Resources\Booth\BoothResource;
use App\Models\Booth;
use App\Services\FileUploaderService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;

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
        $booth = Booth::create([
            'title'       => $data['title'],
            'description' => $data['description'],
        ]);

        if($request->hasFile('images'))
        {
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
        $booth->update([
            'title'       => $data['title'],
            'description' => $data['description'],
        ]);

        if($request->hasFile('images'))
        {
            $this->fileUploader->clearCollection($booth, 'images');
            $this->fileUploader->uploadMultipleFiles($booth, $request['images'], 'images');
        }

        return response()->json([
            'message' => 'Booth updated successfully',
            'data' => new BoothResource($booth)
        ], 200);
    }

    public function destroy(Booth $booth)
    {
        $booth->delete();
        return response()->json([
            'message' => 'Booth deleted successfully'
        ], 200);
    }
}
