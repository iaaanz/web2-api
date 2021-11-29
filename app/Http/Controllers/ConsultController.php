<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ConsultController extends Controller
{
    public function home()
    {
        return view('index');
    }

    public function getCompanies(Request $url)
    {
        $companiesResponse = Http::get($url->input('url'));
        $objCompanies = $companiesResponse->object();
        $arrCompanies = (array) $objCompanies;
        $companiesKeys = key_exists(0, $arrCompanies) ? array_keys((array) $objCompanies[0]) : array_keys($arrCompanies);
        $companies = key_exists(0, $arrCompanies) ? $arrCompanies : array($objCompanies);
        return view('index', compact('companies', 'companiesKeys'));
    }

    public function getUsers(Request $url)
    {
        $usersResponse = Http::get($url->input('url'));
        $objUsers = $usersResponse->object();
        $arrUsers = (array) $objUsers;
        $usersKeys = key_exists(0, $arrUsers) ? array_keys((array) $objUsers[0]) : array_keys($arrUsers);
        $users = key_exists(0, $arrUsers) ? $arrUsers : array($objUsers);

        return view('index', compact('users', 'usersKeys'));
    }

    public function getProducts(Request $url)
    {
        $productsResponse = Http::get($url->input('url'));
        $objProducts = $productsResponse->object();
        $arrProducts = (array) $objProducts;
        $productsKeys = key_exists(0, $arrProducts) ? array_keys((array) $objProducts[0]) : array_keys($arrProducts);
        $products = key_exists(0, $arrProducts) ? $arrProducts : array($objProducts);

        return view('index', compact('products', 'productsKeys'));
    }
}
