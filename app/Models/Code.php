<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Code extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','product_id', 'code'];

    public function products(){
        return $this->belongsTo(Product::class);
    }
    
}
