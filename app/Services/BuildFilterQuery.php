<?php

namespace App\Services;

use App\Models\Product;

class BuildFilterQuery
{
    public static function build($params) {
        $query = Product::query();

        if($params->has('place') && !$params->has('type')) {

            $query->whereNull('buyer_id')
                ->whereRelation('category','place',$params['place'])
                ->with(['category','seller']);
        }
        if($params->has('place') && $params->has('type')) {
            $query->whereNull('buyer_id')
                ->whereRelation('category','type',$params['type'])
                ->with(['category','seller']);
        }
        if($params->has('sort')) {
            $order = explode(".",$params['sort']);
            $query->orderBy($order[0],$order[1]);
        }

        return $query;

    }
}
