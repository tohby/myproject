<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>LawPost | SignUp</title>

    <link rel="Stylesheet" href="CSS/app.css" />
    <link rel="Stylesheet" href="CSS/floating-labels.css" />

    <!-- Bootstrap core CSS -->
    <link href="/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>

<body>
    <form class="form-signin" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="text-center mb-4">
            <img class="mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">LawPost</h1>
            <p>Please fill the form below to create and account.</p>
        </div>
        <div class="form-label-group">
            <div class="form-label-group">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"
                    required autofocus>
                <label for="name">{{ __('Name') }}</label> @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span> @endif
            </div>
        </div>

        <div class="form-label-group">

            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                required> <label for="email">{{ __('E-Mail Address') }}</label> @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span> @endif
        </div>



        <div class="form-label-group">
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                required><label for="password">{{ __('Password') }}</label> @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span> @endif
        </div>



        <div class="form-label-group">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            <label for="password-confirm">{{ __('Confirm Password') }}</label>
        </div>


        <button type="submit" class="btn btn-lg btn-primary btn-block">{{ __('Register') }}</button>
        <p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2019</p>
    </form>
</body>

</html>