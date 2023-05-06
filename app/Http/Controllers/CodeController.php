<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Product;
use App\Models\Code;

class CodeController extends Controller
{
    public function generateCode(Request $request)
    {
        ['email' => $email, 'nameProduct' => $nameProduct] = $request;

        $userId = User::where('email', $email)->first()->id;
        $productId = Product::where('name', $nameProduct)->first()->id;

        // Se genera el codigo
        $string = Str::orderedUuid();
        $code = explode("-", $string)[4];
        $discount_code = substr($code, 0, 6);

        Code::create([
            'code' => $discount_code,
            'user_id' => $userId,
            'product_id' => $productId
        ]);

        return response()->json([
            "message" => 'Codigo generado exitosamente'
        ]);
    }

    public function getAllCodes(string $id)
    {
        $discountCodes = Product::with('code')
            ->whereHas('code', function ($query) use($id){
                $query->where('user_id', $id);
            })
            ->get();
        return $discountCodes;
    }
}
