<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script> --}}

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
    <title>API</title>
</head>
<body>
    <style>
        .my-custom-scrollbar {
            position: relative;
            height: 27rem;
            overflow: auto;
        }
        .table-wrapper-scroll-y {
            display: block;
        }

    </style>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                Empresas
            </div>
            <div class="card-body">
                <form class="form mb-3" action="{{route('getCompanies')}}" method="GET">
                    <div class="row">
                        <div class="d-flex align-items-center col-10">
                            <input type="text" name="url" class="form-control">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary">GET</button>
                        </div>
                    </div>
                </form>
                @isset ($companies)
                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-fixed">
                        <thead>
                        <tr>
                            @foreach ($companiesKeys as $key)
                                <th scope="col">{{ $key }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($companies as $company)
                            <tr>
                                @foreach ($companiesKeys as $key)
                                <td>
                                    {{$company->$key}}
                                </td>
                                 @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endisset
            </div>
        </div>
        <div class="card mt-5">
            <div class="card-header">
                Usuarios
            </div>
            <div class="card-body">
                <form class="form mb-3" action="{{route('getUsers')}}" method="GET">
                    <div class="row">
                        <div class="d-flex align-items-center col-10">
                            <input type="text" name="url" class="form-control">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary">GET</button>
                        </div>
                    </div>
                </form>
                @isset ($users)
                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table">
                        <thead>
                            <tr>
                                @foreach ($usersKeys as $key)
                                    <th scope="col">{{ $key }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                @foreach ($usersKeys as $key)
                                    <td>{{$user->$key}}</td>                                    
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endisset
            </div>
        </div>
        <div class="card mt-5 mb-5">
            <div class="card-header">
                Produtos
            </div>
            <div class="card-body">
                <form class="form mb-3" action="{{route('getProducts')}}" method="GET">
                    <div class="row">
                        <div class="d-flex align-items-center col-10">
                            <input type="text" name="url" class="form-control">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary">GET</button>
                        </div>
                    </div>
                </div>
                @isset ($products)
                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table">
                        <thead>
                            <tr>
                                @foreach ($productsKeys as $key)
                                    <th scope="col">{{ $key }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $user)
                            <tr>
                                @foreach ($productsKeys as $key)
                                    <td>{{$user->$key}}</td>                                    
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endisset
            </div>
        </div>
    </div>
</body>
</html>