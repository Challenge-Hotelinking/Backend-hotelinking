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

        $generatedCode = Code::create([
            'code' => $discount_code,
            'user_id' => $userId,
            'product_id' => $productId
        ]);

        if ($generatedCode) {

            return response()->json([
                "message" => 'Codigo generado exitosamente'
            ], 200);
        } else {
            return response()->json([
                "message" => 'Se produjo un error inesperado al generar código'
            ], 404);
        }
    }
    public function getAllCodes(string $id)
    {
        $discountCodes = Product::with(['code' => function ($query) use ($id) {
            $query->where('user_id', $id);
        }])
            ->whereHas('code', function ($query) use ($id) {
                $query->where('user_id', $id);
            })
            ->get();

        if($discountCodes)    {
            return response()->json([
                "discountCodes" => $discountCodes
            ], 200);
        }else {
            return response()->json([
                "message" => 'Se produjo un error al obtener los códigos'
            ], 404);
        }
    }

    public function changeStateCode(string $code_id, string $user_id)
    {
        $code = Code::where('id', $code_id)
            ->where('user_id', $user_id)
            ->first();

        $code->redeem = true;
        $code->save();

        if($code)    {
            return response()->json([
                "message" => "Codigo canjeado con éxito!!"
            ], 200);
        }else {
            return response()->json([
                "message" => 'Se produjo un error al canjear el código'
            ], 404);
        }
    }
}
