<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Respect\Validation\Validator as v;

class UserController extends Controller
{

    /**
     * @OA\Get(
     *     tags={"Employees"},
     *     path="/api/employees/all",
     *     description="Retorna todos os funcionários",
     *     @OA\Parameter(
     *         name="Token",
     *         in="query",
     *         @OA\Schema(type="string"),
     *         description="JWT Token",
     *         required=true,
     *     ),
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
    public function allUsers()
    {
        return User::all();
    }


    /**
     * @OA\Get(
     *     tags={"Employees"},
     *     path="/api/employees",
     *     description="Retorna uma lista paginada com 50 funcionários",
     *     @OA\Parameter(
     *         name="Token",
     *         in="query",
     *         @OA\Schema(type="string"),
     *         description="JWT Token",
     *         required=true,
     *     ),
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
    public function paginatedUsers()
    {
        return User::paginate(50);
    }


    /**
     * @OA\Get(
     *     tags={"Employees"},
     *     path="/api/employees/{id}",
     *     description="Retorna um funcionário específico",
     *     @OA\Parameter(
     *         name="Token",
     *         in="query",
     *         @OA\Schema(type="string"),
     *         description="JWT Token",
     *         required=true,
     *     ),
     *      @OA\Parameter(
     *         name="id",
     *         in="query",
     *         @OA\Schema(type="integer"),
     *         description="Employee ID",
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
     *         description="Error: User not found."
     *     ),
     * )
     */
    public function showUser($id)
    {
        try {
            return User::findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'User not found.'], 404);
        }
    }


    /**
     * @OA\Get(
     *     tags={"Employees"},
     *     path="/api/employees/{id}/products",
     *     description="Retorna os produtos no qual o funcionário está vinculado",
     *     @OA\Parameter(
     *         name="Token",
     *         in="query",
     *         @OA\Schema(type="string"),
     *         description="JWT Token",
     *         required=true,
     *     ),
     *      @OA\Parameter(
     *         name="id",
     *         in="query",
     *         @OA\Schema(type="integer"),
     *         description="Employee ID",
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
     *      *     @OA\Response(
     *         response=404,
     *         description="Error: User not found."
     *     ),
     * )
     */
    public function productsByUser($id)
    {
        try {
            return User::findOrFail($id)->products;
        } catch (\Throwable $th) {
            return response()->json(['error' => 'User not found.'], 404);
        }
    }


    /**
     * @OA\Get(
     *     tags={"Employees"},
     *     path="/api/employees/{id}/company",
     *     description="Retorna a empresa na qual o funcionário está vinculado",
     *     @OA\Parameter(
     *         name="Token",
     *         in="query",
     *         @OA\Schema(type="string"),
     *         description="JWT Token",
     *         required=true,
     *     ),
     *      @OA\Parameter(
     *         name="id",
     *         in="query",
     *         @OA\Schema(type="integer"),
     *         description="Employee ID",
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
     *      *     @OA\Response(
     *         response=404,
     *         description="Error: User not found."
     *     ),
     * )
     */
    public function companyByUser($id)
    {
        try {
            return User::findOrFail($id)->products;
        } catch (\Throwable $th) {
            return response()->json(['error' => 'User not found.'], 404);
        }
    }


    /**
     * @OA\Post(
     *     tags={"Employees"},
     *     path="/api/employees/new",
     *     description="Cadastra uma novo funcionário",
     *     @OA\Parameter(
     *         name="Token",
     *         in="query",
     *         @OA\Schema(type="string"),
     *         description="JWT Token",
     *         required=true,
     *     ),
     *   @OA\Parameter(
     *     name="Body",
     *     in="query",
     *     description="",
     *     required=true,
     *     @OA\Schema(
     *          type="object",
     *          @OA\Property(property="nome", type="string", example="Bender"),
     *          @OA\Property(property="telefone", type="string", example="49988548268"),
     *          @OA\Property(property="cpf", type="string", example="58447018016"),
     *          @OA\Property(property="data", type="string", example="2002/03/21"),
     *          @OA\Property(property="cnpj_empresa", type="string", example="22947693000167")),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error: Bad Request"
     *     ),     
     *     @OA\Response(
     *         response=401,
     *         description="Error: Unauthorized"
     *     ),
     * )
     */
    public function storeUser(Request $userRequest)
    {
        $validator = Validator::make(
            $userRequest->all(),
            [
                'nome' => 'required|max:255|string',
                'telefone' => 'max:11|string',
                'cpf' => 'required|size:11|string',
                'data' => 'required|date|string',
                'cnpj_empresa' => 'required|size:14|exists:companies,cnpj|string'
            ],
        );

        if ($validator->fails()) {
            return response()->json(['erro' => $validator->errors()], 400);
        }

        if (!v::cpf()->validate($userRequest->cpf)) {
            return response()->json(['erro' => 'CPF invalido.'], 400);
        }

        User::create($userRequest->all());
        return response()->json(['sucesso' => 'Usuario cadastrado.']);
    }
}
