<?php

namespace App\Services;

use App\Models\Review;
use App\Models\User;

class RateService
{
    public static function setAvgRate(int $seller_id): void {
        $rates = Review::where('seller_id',$seller_id)->get();


        $seller = User::where('id',$seller_id)->first();
        $avg_rate = 0;

        foreach ($rates as $rate) {
            $avg_rate += $rate->rate;
        }
        $seller->avg_rate = round($avg_rate / $rates->count(),1,PHP_ROUND_HALF_UP);
        $seller->save();
    }
}
