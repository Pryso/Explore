<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $category = Category::create($data);
        return response()->json([
            'success' => 'Категория создана!',
            'data' => $category,
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            return CategoryResource::make($category);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Категория не найдена',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        try {
            $data = $request->validated();
            $category = Category::findOrFail($id);
            $category->fill($data);
            $category->save();
            return response()->json([
                'success' => 'Вы отредактировали категорию!',
                'data' => $category,
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                'error' => 'Данная категория не найдена!',
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            return response()->json([
                'success' => 'Категория успешно удалена!',
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Категория не найдена',
            ],404);
        }
    }
}
