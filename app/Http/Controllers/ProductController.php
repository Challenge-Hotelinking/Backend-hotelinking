<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function getAllProducts()
    {
        $products = Product::all();
        if ($products) {
            return response()->json([
                "products" => $products
            ]);
        }else{
            return response()->json([
                "message" => 'Se ha producido un error al obtener los productos'
            ],404);
        }
    }
}
