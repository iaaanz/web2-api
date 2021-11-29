<?php

$router->get('/docs', function () {
    return view('docs');
});

$router->get('/', 'ConsultController@home');
$router->get('/admin_login', function () {
    return view('admin_login');
});

$router->get('/admin', function () {
});

$router->post('/admin_login', [
    'as' => 'login',
    'uses' => 'AdminController@login'
]);
$router->get('/admin/logout/{id}', [
    'as' => 'logoutUser',
    'uses' => 'AdminController@logoutUser'
]);
$router->get('/admin/delete/{id}', [
    'as' => 'deleteUser',
    'uses' => 'AdminController@deleteUserPermanently'
]);

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('/getToken', 'AuthController@register');
    $router->post('/login', 'AuthController@login');
    $router->get('/logout', 'AuthController@logout');
});

$router->group(['prefix' => 'api'], function () use ($router) {
    // $router->group(['prefix' => 'api', 'middleware' => 'auth'], function () use ($router) {
    $router->get('/me', 'AuthController@me');

    $router->group(['prefix' => 'companies'], function () use ($router) {
        $router->get('/all', 'CompanyController@allCompanies');
        $router->get('/', 'CompanyController@paginatedCompanies');
        $router->get('/{id}', 'CompanyController@showCompany');
        $router->get('/{id}/employees', 'CompanyController@usersByCompany');
        $router->post('/new', 'CompanyController@storeCompany');
    });

    $router->group(['prefix' => 'employees'], function () use ($router) {
        $router->get('/all', 'UserController@allUsers');
        $router->get('/', 'UserController@paginatedUsers');
        $router->get('/{id}', 'UserController@showUser');
        $router->get('/{id}/company', 'UserController@companyByUser');
        $router->get('/{id}/products', 'UserController@productsByUser');
        $router->post('/new', 'UserController@storeUser');
    });

    $router->group(['prefix' => 'products'], function () use ($router) {
        $router->get('/all', 'ProductController@allProducts');
        $router->get('/', 'ProductController@paginatedProducts');
        $router->get('/{id}', 'ProductController@showProduct');
        $router->get('/{id}/employee', 'ProductController@userByProduct');
        $router->post('/new', 'ProductController@storeProduct');
    });

    $router->group(['prefix' => 'consult'], function () use ($router) {
        $router->get(
            '/companies',
            ['as' => 'getCompanies', 'uses' => 'ConsultController@getCompanies']
        );
        $router->get(
            '/users',
            ['as' => 'getUsers', 'uses' => 'ConsultController@getUsers']
        );
        $router->get(
            '/products',
            ['as' => 'getProducts', 'uses' => 'ConsultController@getProducts']
        );
    });
});
