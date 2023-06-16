<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use App\Services\RateService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function store(string $id,ReviewRequest $request) {

        $product = Product::where('id',$id)->first();
        $data = $request->validated('rate');
        if($product->buyer_id != auth('sanctum')->user()->id) {
            return response()->json([
                'error' => 'Вы не можете оставить отзыв'
            ],403);
        }
        if(Review::where('product_id',$id)->first()) {
            return response()->json([
                'error' => 'Отзыв уже оставлен.'
            ],403);
        }

        $review = Review::create([
            'rate' => $data,
            'seller_id' => $product->seller_id,
            'buyer_id' => $product->buyer_id,
            'product_id' => $product->id,
        ]);
        RateService::setAvgRate($product->seller_id);
        return $review;

    }
}
