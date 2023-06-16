<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['price','category_id','seller_id','desc','short_desc','account'];
    public function category() {
        return $this->hasOne('App\Models\Category','id','category_id');
    }
    public function seller() {
        return $this->belongsTo('App\Models\User','seller_id','id');
    }
    public function review() {
        return $this->belongsTo('App\Models\Review','product_id','id');
    }
}
