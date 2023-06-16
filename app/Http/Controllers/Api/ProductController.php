<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::with(['category','seller'])->get();
        return ProductResource::collection($product);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        $data['seller_id'] = auth('sanctum')->user()->id;
        $product = Product::create($data);
        return response()->json([
            'success' => 'Товар добавлен!',
            'data' => ProductResource::make($product),
        ],200);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = Product::with(['category','seller'])->findOrFail($id);
            return ProductResource::make($product);
        }
        catch (\Exception $e) {
            return response()->json([
                'error' => 'Данный товар не найден!',
            ],404);
        }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {

        try {
            $data = $request->validated();
            $product = Product::findOrFail($id);
            if(auth('sanctum')->user()->id != $product->seller_id) {
                return response()->json([
                    'error' => 'Вы не можете редактировать этот товар.'
                ],403);
            }
            $product->fill($data);
            $product->save();

            return response()->json([
                'success' => 'Вы отредактировали товар!',
                'data' => $product,
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                'error' => 'Данный товар не найден!',
            ],404);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            if(auth('sanctum')->user()->id != $product->seller_id) {
                return response()->json([
                    'error' => 'Вы не можете редактировать этот товар.'
                ],403);
            }
            $product->delete();
            return response()->json([
                'success' => 'Товар успешно удалён!',
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                'error' => 'Данный товар не найден!',
            ],404);
        }


    }
}
