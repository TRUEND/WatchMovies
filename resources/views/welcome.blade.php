<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Watch Movies</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">
        
    </head>
    <body style="background-image: url('images/index.image.jpg');">

        <ul class="nav fixed-top">
            <div class="ml-auto p-3">
                <li class="nav-item">
                    <a class="nav-link active text-lg-left text-light font-weight-bold text-uppercase" 
                    href="{{ route('login') }}">Login</a>
                </li>
            </div>
        </ul>


        <div id="registerBox" class="w-100 row">

            <div id="homeTitle" class="col-md-7">
                <h1>
                    Watch Movies
                </h1>
        
                <p>"Gentlemen, you can't fight in here! This is the war room!"</p>
            </div>

            <div id="formBox" class="py-3 col-md-5">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <h2 class="title text-center py-3">Register </h2>

                    <div class="form-group row">
                        <label for="firstName" class="col-md-4 col-form-label text-md-right">First Name</label>

                        <div class="col-md-6">
                            <input id="firstName" type="text" class="form-control @error('firstName') is-invalid 
                            @enderror" name="firstName" value="{{ old('firstName') }}" required autocomplete="firstName" autofocus>

                            @error('firstName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="lastName" class="col-md-4 col-form-label text-md-right">Last Name</label>

                        <div class="col-md-6">
                            <input id="lastName" type="text" class="form-control @error('lastName') is-invalid 
                            @enderror" name="lastName" value="{{ old('lastName') }}" required autocomplete="lastName" autofocus>

                            @error('lastName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nickname" class="col-md-4 col-form-label text-md-right">Nickname</label>

                        <div class="col-md-6">
                            <input id="nickname" type="text" class="form-control @error('nickname') is-invalid 
                            @enderror" name="nickname" value="{{ old('nickname') }}" required autocomplete="nickname" autofocus>

                            @error('nickname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                            name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid 
                            @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" 
                            required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn bg-dark text-light">
                                Register
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
