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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js">
    </script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js">
    </script>
    <title>API</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css?family=Roboto');

    body {
        font-family: 'Roboto', sans-serif;
    }

    .auth__header {
        padding: 13vh 1rem calc(11vh + 35px);
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f0f0f0;
        background-image: linear-gradient(#3280e4, #584dc3);
        background-size: cover;
        background-position: center center;
        position: relative;
        box-shadow: 0 3px 5px rgba(0, 0, 0, 0.3);
    }

    .auth__logo {
        position: relative;
        z-index: 18;
        background: #fff;
        padding: 10px;
        border-radius: 50%;
        box-shadow: 0 2px 7px rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }

    .auth__body {
        padding-bottom: 2rem;
    }

    .auth__form {
        min-width: 280px;
        max-width: 340px;
        margin: auto;
        margin-top: -40px;
        padding: 0 10px;
        position: relative;
        z-index: 999;
    }

    .auth__form_body {
        padding: 0.7rem 1.5rem 35px;
        border-radius: 0.5rem;
        background: #fff;
        border: 1px solid #eee;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    .auth__form_title {
        font-size: 1.3rem;
        text-align: center;
        text-transform: uppercase;
        margin-bottom: 1.2rem;
    }

    .auth__form_actions {
        text-align: center;
        padding: 0 2rem;
        margin-top: -25px;
    }

    .auth__form_actions .btn {
        border-radius: 30px;
        box-shadow: 0 2px 12px rgba(50, 128, 228, 0.5);
    }

</style>

<body>
    <div class="container">
            <div class="auth__header" />
            <div class="auth__body">
                <div class="auth__form_body">
                    <h3 class="auth__form_title">Login</h3>
                    <form class="form mb-3" action="{{route('login')}}" method="POST">
                        <div>
                            <div class="form-group">
                                <label class="text-uppercase small">User</label>
                                <input class="form-control" placeholder="Enter a user">
                            </div>
                            <div class="form-group">
                                <label class="text-uppercase small">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <div class="auth__form_actions">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            LOGIN
                        </button>
                    </div>
                </form>
            </div>
    </div>
</body>

</html>
