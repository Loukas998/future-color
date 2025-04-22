<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use App\Services\FileUploaderService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $fileUploader;
    public function __construct(FileUploaderService $fileUploader)
    {
        $this->fileUploader = $fileUploader;    
    }

    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return response()->json([
            'message' => 'Categories retrieved successfully',
            'data' => CategoryResource::collection($categories)
        ], 200);
    }

    public function store(CreateCategoryRequest $request)
    {
        $data = $request->validated();
        $category = Category::create($data);

        return response()->json([
            'message' => 'Category created successfully',
            'data' => new CategoryResource($category)
        ], 201);
    }

    public function show(Category $category)
    {
        return response()->json([
            'message' => 'Category retrieved successfully',
            'data' => new CategoryResource($category)
        ], 200);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $category->update($data);

        return response()->json([
            'message' => 'Category updated successfully',
            'data' => new CategoryResource($category)
        ], 200);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        
        return response()->json([
            'message' => 'Category deleted successfully'
        ], 200);
    }
}
