<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $fillable = ['place','type'];
    public $timestamps = false;

    public function product() {
        return $this->belongsTo('App\Models\Product','category_id','id');
    }
}
