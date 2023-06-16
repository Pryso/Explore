<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','seller_id','buyer_id','rate'];

    public function product() {
        return $this->hasOne('App\Models\Product','id','product_id');
    }
    public function seller() {
        return $this->belongsTo('App\Models\User','seller_id','id');
    }
}
