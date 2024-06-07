<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('/LOGIN/fonts/icomoon/style.css'); }}">

    <link rel="stylesheet" href="{{ asset('/LOGIN/css/owl.carousel.min.css'); }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('/LOGIN/css/bootstrap.min.css') }}">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('/LOGIN/css/style.css') }}">

    <title>Library Login</title>
  </head>
  <body  style="background-color: #343a40">
    <div class="content">
      <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('loginpost') }}">
            @csrf
            
        <div class="content" >
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <img src="{{ asset('/LOGIN/images/imagesignin.png') }}" alt="Image" class="img-fluid">
            </div>
            <div class="col-md-6 contents">
              <div class="row justify-content-center">
                <div class="col-md-8">
                  <div class="mb-4">
                    <h3 style="color: white">
                      <span style="color: #8ADDC9">Library</span> - Sign In
                  </h3>
                  
                  <p class="mb-4">Welcome! Please Sign In with your account!</p>
                </div>
                <form action="#" method="post">
                  <div class="form-group first">
                    <label for="email">Email</label>
                    <input class="form-control" id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                  </div>
                  <div class="form-group last mb-4">
                    <label for="password">Password</label>
                    <input class="form-control" id="password" type="password" name="password" required autocomplete="current-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                  </div>
                  
                  <div class="d-flex mb-5 align-items-center">
                    <label for="remember_me" class="inline-flex items-center">
                      <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                      <span class="caption" style="color: white">{{ __('Remember me') }}</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="ml-auto" href="{{ route('password.request') }}" style="color: rgb(187, 187, 187)">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                  </div>

                    <x-primary-button class="btn btn-block" style="background-color: #8ADDC9">
                        {{ __('Sign in') }}
                    </x-primary-button>
                    <center style="padding: 3%">
                        <a class="" href="{{ route('register') }}" style="color: rgb(187, 187, 187)">
                            {{ __('Did not have an account?') }}
                            <span style="color: rgb(62, 62, 255)">Sign Up</span>
                        </a>
                    </center>

                  
                </form>
                </div>
              </div>
              
            </div>
            
          </div>
        </div>
        </div>
    </div>

  
    <script src="{{ asset('/LOGIN/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('/LOGIN/js/popper.min.js') }}"></script>
    <script src="{{ asset('/LOGIN/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/LOGIN/js/main.js') }}"></script>

  </body>
</html>