<?php

namespace App\Services;

use App\Models\Product;
use App\Models\User;

class TransferService
{
    public static function transferMoney(User $seller, User $buyer, Product $product): void {
        $seller->balance = $product->price - (($product->price * 5) / 100);
        $buyer->balance = $buyer->balance - $product->price;
        $product->buyer_id = $buyer->id;
        $seller->save();
        $product->save();
        $buyer->save();
    }
}
