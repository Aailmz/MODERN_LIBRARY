<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('/LOGIN/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('/LOGIN/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('/LOGIN/css/bootstrap.min.css') }}">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('/LOGIN/css/style.css') }}">

    <title>Library Register</title>
  </head>
  <body style="background-color: #343a40">
    <div class="content">
      <x-auth-session-status class="mb-4" :status="session('status')" />
      
      <div class="content">
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
                      <span style="color: #8ADDC9">Library</span> - Sign Up
                    </h3>
                    <p class="mb-4">Welcome! Please Sign Up to create your account!</p>
                  </div>
                  <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Name -->
                    <div class="form-group first">
                      <label for="name">Name</label>
                      <input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name">
                      <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    
                    <!-- Email Address -->
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username">
                      <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    
                    <!-- Password -->
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password">
                      <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                      </div>

                    <!-- Profile Picture -->
                    <div class="mt-4">
                        <x-input-label for="profile_picture" :value="__('Profile Picture')" style="color: rgb(202, 202, 202)"/>
                        <input id="profile_picture" type="file" class="block mt-1 w-full" name="profile_picture" accept="image/*" required  style="color: rgb(202, 202, 202)"/>
                        <x-input-error :messages="$errors->get('profile_picture')" class="mt-2"/>
                    </div>

                    <!-- Confirm Password -->

                    <div class="d-flex items-center justify-end mt-4">
                        <x-primary-button class="btn btn-block" style="background-color: #8ADDC9">
                          {{ __('Register') }}
                        </x-primary-button>
                      </div>
  
                      <div class="d-flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ url('/loginget') }}" style="color: rgb(187, 187, 187)">
                          Already regitered? <span style="color: rgb(47, 47, 255)">Sign In</span>
                        </a>
                      </div>
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



