<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{


    /**
     * @OA\Get(
     *     tags={"Products"},
     *     path="/api/products/all",
     *     description="Retorna todos os produtos",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Error: Unauthorized"
     *     )
     * )
     */
    public function allProducts()
    {
        return Product::all();
    }


    /**
     * @OA\Get(
     *     tags={"Products"},
     *     path="/api/products",
     *     description="Retorna uma lista paginada com 50 produtos",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Error: Unauthorized"
     *     )
     * )
     */
    public function paginatedProducts()
    {
        return Product::paginate(50);
    }


    /**
     * @OA\Get(
     *     tags={"Products"},
     *     path="/api/products/{id}",
     *     description="Retorna um produto específico",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         @OA\Schema(type="integer"),
     *         description="Product ID",
     *         required=true,
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Error: Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Error: Product not found."
     *     ),
     * )
     */
    public function showProduct($id)
    {
        try {
            return Product::findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Product not found.'], 404);
        }
    }


    /**
     * @OA\Get(
     *     tags={"Products"},
     *     path="/api/products/{id}/employee",
     *     description="Retorna o funcionário vinculado ao produto",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         @OA\Schema(type="integer"),
     *         description="Product ID",
     *         required=true,
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Error: Unauthorized"
     *     ),
     * )
     */
    public function userByProduct($id)
    {
        try {
            return Product::findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([]);
        }
    }


    /**
     * @OA\Post(
     *     tags={"Products"},
     *     path="/api/products/new",
     *     description="Cadastra uma novo produto",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *     name="Body",
     *     in="query",
     *     description="",
     *     required=true,
     *     @OA\Schema(
     *          type="object",
     *          @OA\Property(property="nome", type="string", example="Caixa de Som"),
     *          @OA\Property(property="quantidade", type="string", example="675"),
     *          @OA\Property(property="ncm", type="string", example="00000000"),
     *          @OA\Property(property="data", type="string", example="2002/03/21"),
     *          @OA\Property(property="cpf_cadastro", type="string", example="58447018016")),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Error: Unauthorized"
     *     ),
     * )
     */
    public function storeProduct(Request $productRequest)
    {
        $validator = Validator::make(
            $productRequest->all(),
            [
                'nome' => 'required|max:255|string',
                'quantidade' => 'required|between:-1000000,1000000|integer',
                'ncm' => 'required|digits_between:0,8|numeric',
                'data' => 'required|date|string',
                'cpf_cadastro' => 'required|size:11|exists:users,cpf|string',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['erro' => $validator->errors()], 400);
        }

        Product::create($productRequest->all());
        return response()->json(['sucesso' => 'Produto cadastrado.']);
    }
}
