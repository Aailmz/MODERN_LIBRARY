<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Modern Library - Profile</title>

    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <link href="{{ asset('/css/nucleo-icons.css'); }}" rel="stylesheet" />
    <link href="{{ asset('/css/nucleo-svg.css'); }}" rel="stylesheet" />
    <link href="{{ asset('/css/templatemo-woox-travel.css'); }}" rel="stylesheet" />

    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('/css/nucleo-svg.css'); }}" rel="stylesheet" />
    
    <link id="pagestyle" href="{{ asset('/css/soft-ui-dashboard.css'); }}" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
      .header-area {
          width: 100%;
          margin: 0;
          padding: 0;
      }
      .header-area .container {
          width: 100%;
          max-width: 100%;
          padding: 0;
      }
      .header-area .row {
          width: 100%;
          margin: 0;
      }
      .main-nav {
          display: flex;
          justify-content: space-between;
          align-items: center;
      }
      .nav {
          list-style: none;
          padding: 0;
          margin: 0;
          display: flex;
      }
      .nav li {
          margin-right: 20px;
      }
      .nav-profile {
          display: flex;
          align-items: center;
          margin-left: 10%;
      }
      .nav-profile img {
          border-radius: 50%;
      }
  </style>
  </head>

<body>
    <header class="header-area">
        <div class="container" style="padding-top: 6px">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="{{ route('siswas.dashboard') }}" class="d-flex align-items-center">
                            <img src="{{ asset('/LOGIN/images/logo.png') }}" alt="Library Logo" style="height: 55px; margin-right: 10px;">
                            <h2 style="color: white; margin: 0;">Library</h2>
                        </a>
                        <!-- ***** Logo End ***** -->
                      
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    

  <!-- ***** Header Area Start ***** -->

  <!-- ***** Header Area End ***** -->

  <!-- ***** Main Banner Area Start ***** -->

  <!-- ***** Main Banner Area End ***** -->
  
  <div class="visit-country">
    <div class="container">

        <div class="py-12 d-flex justify-content-center"  style="margin-top: -15%">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow" style="border-radius: 20px;">
                    <div class="max-w-xl text-center">
                        @if(Auth::user()->profile_picture)
                            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}" class="h-40 w-40 object-cover mx-auto mb-4 rounded-circle">
                        @else
                            <img src="{{ asset('storage/null.png') }}" class="w-40 h-40 mx-auto mb-4 rounded-circle object-cover">
                        @endif
                        <div class="flex flex-col items-center">
                            <h1 class="text-lg font-medium text-gray-900 mb-2" style="font-size: 30px">{{ $user->name }}</h1>
                            <p class="text-sm text-gray-600" style="font-size: 20px">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div class="py-12" style="margin-top: -35%">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg" style="border-radius: 20px;">
                        <div class="max-w-xl" style="margin-top: -10%">
                            @include('profile.partials.userupdate-profile-information-form')
                        </div>
                    </div>
        
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg" style="border-radius: 20px; margin-top:5%">
                        <div class="max-w-xl" style="margin-top: -10%">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
        
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg" style="border-radius: 20px; margin-top:5%">
                        <div class="max-w-xl" style="margin-top: -10%">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
      
      
        </div>
    </div>
  </div>

  

  <div class="call-to-action">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <h2>Modern Library</h2>
          <h4>Created by Group 2</h4>
        </div>
        <div class="col-lg-4">
          <div class="border-button">
            <a href="reservation.html">Read Now!</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <div class="container">
      <div class="row">
      </div>
    </div>
  </footer>


  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/wow.js"></script>
  <script src="assets/js/tabs.js"></script>
  <script src="assets/js/popup.js"></script>
  <script src="assets/js/custom.js"></script>
  <script>
    function logout(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to log out.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, log out'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        });
    }
</script>

  <link rel="stylesheet" href="https://unpkg.com/pspdfkit@latest/dist/pspdfkit.css">
  <script src="https://unpkg.com/pspdfkit@latest/dist/pspdfkit.js"></script>
  <!-- Include jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <!-- Include Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('/js/soft-ui-dashboard.min.js'); }}"></script>

  </body>

</html>




