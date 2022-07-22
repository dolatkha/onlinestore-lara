<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function property(){
        return $this->belongsToMany(Property::class)->withPivot(['id','amount','unit']);
    }
}
