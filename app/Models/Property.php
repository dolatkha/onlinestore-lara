<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    public function product(){
        return $this->belongsToMany(Product::class)->withPivot(['id','amount','unit']);
    }
}
