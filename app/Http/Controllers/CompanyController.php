<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Company;
use Respect\Validation\Validator as v;
use OpenApi\Annotations as OA;

class CompanyController extends Controller
{

    /**
     * @OA\Get(
     *     tags={"Companies"},
     *     path="/api/companies/all",
     *     description="Retorna todas as companhias",
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
    public function allCompanies()
    {
        return Company::all();
    }


    /**
     * @OA\Get(
     *     tags={"Companies"},
     *     path="/api/companies",
     *     description="Retorna uma lista paginada com 50 companhias",
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
    public function paginatedCompanies()
    {
        return Company::paginate(50);
    }


    /**
     * @OA\Get(
     *     tags={"Companies"},
     *     path="/api/companies/{id}",
     *     description="Retorna uma comapanhia específica",
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
     *         description="Companie ID",
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
    public function showCompany($id)
    {
        return Company::findOrFail($id);
    }


    /**
     * @OA\Get(
     *     tags={"Companies"},
     *     path="/api/companies/{id}/users",
     *     description="Retorna os funcionários vinculados a companhia",
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
     *         description="Companie id",
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
    public function usersByCompany($id)
    {
        return Company::findOrFail($id)->users;
    }


    /**
     * @OA\Post(
     *     tags={"Companies"},
     *     path="/api/companies/new",
     *     description="Cadastra uma nova companhia",
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
     *          @OA\Property(property="nome", type="string", example="Bender Enterprise"),
     *          @OA\Property(property="telefone", type="string", example="49988548268"),
     *          @OA\Property(property="cnpj", type="string", example="70528381000161"),
     *          @OA\Property(property="data", type="string", example="2002/03/21")),
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
    public function storeCompany(Request $companyRequest)
    {
        $validator = Validator::make(
            $companyRequest->all(),
            [
                'nome' => 'required|max:255|string',
                'telefone' => 'max:11|string',
                'cnpj' => 'required|size:14|string',
                'data' => 'required|date|string'
            ],
        );

        if ($validator->fails()) {
            return response()->json(['erro' => $validator->errors()], 400);
        }

        if (!v::cnpj()->validate($companyRequest->cnpj)) {
            return response()->json(['erro' => 'CNPJ invalido'], 400);
        };

        Company::create($companyRequest->all());
        return response()->json(['sucesso' => 'Empresa cadastrada.']);
    }
}
