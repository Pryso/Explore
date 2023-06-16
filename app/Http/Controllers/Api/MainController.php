<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BuyProductRequest;
use App\Http\Requests\FilterRequest;
use App\Http\Requests\GetCategoriesRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Services\BuildFilterQuery;
use App\Services\TransferService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function categories(GetCategoriesRequest $request) {
        $categories = Category::where('place', $request->place)->get()->map->only('type');
        return response()->json($categories);
    }
    public function filter(FilterRequest $request) {
        $params = collect($request->data);
        $products = BuildFilterQuery::build($params)->get();

        return ProductResource::collection($products);;
    }
    public function buy(string $id) {
        $product = Product::where('id',$id)->first();
        $user = User::where('id',auth('sanctum')->user()->id)->first();
        $seller = User::where('id',$product->seller_id)->first();
        if($seller->id === auth('sanctum')->user()->id) {
            return response()->json([
                'error' => 'Вы не можете купить свой товар'
            ],403);
        }
        if($product->buyer_id) {
            return response()->json([
                'error' => 'Товар уже куплен!',
            ],403);
        }
        if($user->balance < $product->price) {
            return response()->json([
                'error' => 'Недостаточно средств!',
            ],403);
        }
        TransferService::transferMoney($seller,$user,$product);
        return response()->json([
            'success' => 'Вы приобрели товар!',
            'data' => $product->account,
        ]);
    }
}
