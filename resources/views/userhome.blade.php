<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Modern Library - Home</title>

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
    <div class="container" style="padding-top: 6px;">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav d-flex align-items-center justify-content-between">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{ route('siswas.dashboard') }}" class="d-flex align-items-center">
                        <img src="{{ asset('/LOGIN/images/logo.png') }}" alt="Library Logo" style="height: 55px; width:55px; margin-right: 10px;">
                        <h2 style="color: white; margin: 0;">Library</h2>
                    </a>
                    <!-- ***** Logo End ***** -->

                    <!-- ***** Menu Start ***** -->
                    <ul class="nav d-flex align-items-center justify-content-center" style="flex-grow: 1; margin-bottom: 0;">
                        <li><a href="{{ route('siswas.dashboard') }}" class="active">Home</a></li>
                        <li><a href="{{ route('siswas.loan') }}">Loan</a></li>
                        <li><a href="{{ route('userlog') }}">History</a></li>
                        <li><a href="{{ route('userbookmark') }}">Bookmarks</a></li>
                    </ul>
                    <!-- ***** Menu End ***** -->
                    
                    <!-- ***** Profile Start ***** -->
                    <div class="nav-profile d-flex align-items-center" style="margin-left: 20%">
                        @if(Auth::user()->profile_picture)
                            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}" class="h-10 w-10 object-cover mr-2" style="border-radius: 50%;">
                        @else
                            <img src="{{ asset('storage/null.png') }}" class="h-5 w-5 object-cover mr-2" style="border-radius: 50%;">
                        @endif
                        <div class="px-4 text-white">
                            <a href="{{ route('profile.edituser') }}" class="no-underline" style="color: white;">
                                <div class="font-medium text-base">{{ Auth::user()->name }}</div>
                            </a>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                        <li>
                          <a href="#" data-toggle="modal" data-target="#notificationModal">
                              <i class="fas fa-bell fa-1x"></i>
                          </a>
                      </li>
                    </div>
                    <!-- ***** Profile End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>


<!-- Notification Modal Start -->
<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="notificationModalLabel">Notifications</h5>
          </div>
          <div class="modal-body">
              <ul class="list-group">
                  @foreach($unreadmail as $mail)
                  <li class="list-group-item">
                      <p>{{ $mail->created_at }}</p>
                      <p>Admin - Modern Library</p>
                      <h4>{{ $mail->status }}</h4>
                      <p style="color: black">{{ $mail->header }}</p>
                      <p>Click for more details.</p>
                      <button type="button" class="btn btn-success btn-sm" onclick="markAsRead('{{ $mail->id }}')">Mark as Read</button>
                  </li>
                  @endforeach
              </ul>
              @if(count($unreadmail) === 0)
              <p>No new mail notifications.</p>
              @endif
          </div>
          <div class="modal-footer">
              <a href="{{ route('siswas.mails') }}" class="btn btn-success">Go to Mail Dashboard</a>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>



  <!-- ***** Header Area End ***** -->

  <!-- ***** Main Banner Area Start ***** -->
  <section id="section-1">
    <div class="content-slider">
      <input type="radio" id="banner1" class="sec-1-input" name="banner" checked>
      <input type="radio" id="banner2" class="sec-1-input" name="banner">
      <input type="radio" id="banner3" class="sec-1-input" name="banner">
      <input type="radio" id="banner4" class="sec-1-input" name="banner">
      <div class="slider">
        <div id="top-banner-1" class="banner">
          <img src="{{ asset('storage/screen.png') }}">
        </div>
        <div id="top-banner-2" class="banner">
            <img src="{{ asset('storage/screen2.png') }}">
        </div>
        <div id="top-banner-3" class="banner">
            <img src="{{ asset('storage/screen.png') }}">
        </div>
        <div id="top-banner-4" class="banner">
            <img src="{{ asset('storage/screen2.png') }}">
        </div>
      </div>
      <nav>
        <div class="controls">
          <label for="banner1"><span class="progressbar"><span class="progressbar-fill"></span></span></label>
          <label for="banner2"><span class="progressbar"><span class="progressbar-fill"></span></span></label>
          <label for="banner3"><span class="progressbar"><span class="progressbar-fill"></span></span></label>
          <label for="banner4"><span class="progressbar"><span class="progressbar-fill"></span></span></label>
        </div>
      </nav>
    </div>
  </section>
  <!-- ***** Main Banner Area End ***** -->
  
  <div class="visit-country">
    <div class="container">

            <h2 style="color: white">Recommendation</h2>

            <form action="{{ route('books.search') }}" method="GET" class="mb-4">
              <div class="row">
                  <div class="col-lg-12">
                      <div class="input-group">
                          <input type="text" name="query" class="form-control" placeholder="Search by title" value="{{ request('query') }}">
                          <span class="input-group-btn">
                              <button type="submit" class="btn btn-success">Search</button>
                          </span>
                      </div>
                  </div>
              </div>
          </form>

        <div class="row">
          <div class="col-lg-12">
              <div class="row">
                @foreach($offlineBooks as $book)
                  <div class="col-sm-4 col-md-4 col-lg-2 m-5">
                    <div class="item">
                      <a href="{{ url('detailbook/'.$book->id) }}">
                        <div class="card" style="width: 250px; height: 370px;">
                            <img src="{{ $book->book_picture ? asset('storage/' . $book->book_picture) : asset('default-book-cover.jpg') }}" class="card-img" style="width: 100%; height: 80%;">
                            <div class="card-body">
                                <h1 class="card-title">{{ $book->title }}</h1>
                                <p class="card-text">
                                    {{ $book->category }}
                                    <span style="margin-left: 100px; color: gold;"><i class='bx bxs-star'></i></span>
                                    <span class="rating-percentage">{{ $book->stock }}</span>
                                </p>
                            </div>
                        </div>                        
                      </a>
                    </div>
                  </div>
                @endforeach
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
    document.addEventListener('DOMContentLoaded', function() {
    function applyForBorrow() {
        var bookId;

        // Check borrow status when the button is clicked
        $.ajax({
            type: 'POST',
            url: '{{ route('check-borrow-status') }}',
            data: {
                book_id: bookId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.exists) {
                    Swal.fire({
                        title: "You already borrowed this book",
                        icon: "info",
                        confirmButtonText: "OK"
                    });
                } else {
                    var borrowDuration = document.getElementById('borrowDuration').value;

                    Swal.fire({
                        title: "Borrow Book?",
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: "Borrow",
                        denyButtonText: `Cancel`
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var formData = new FormData();
                            formData.append('book_id', bookId);
                            formData.append('borrow_duration', borrowDuration);

                            $.ajax({
                                type: 'POST',
                                url: '{{ route('apply-for-borrow') }}',
                                data: formData,
                                contentType: false,
                                processData: false,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    console.log(response);
                                    Swal.fire({
                                        title: "Success",
                                        text: "Borrow Request Submitted Successfully!",
                                        icon: "success"
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                    Swal.fire({
                                        title: "Error",
                                        text: "Failed to submit borrow request.",
                                        icon: "error"
                                    });
                                }
                            });
                        } else if (result.isDenied) {
                            // Handle if user denies action
                        }
                    });
                }
            }
        });
    }

    // Attach the function to the button
    document.getElementById('applyForBorrowButton').onclick = applyForBorrow;
});

function markAsRead(mailId) {
        $.ajax({
            url: '/update-mail-status/' + mailId,
            type: 'PUT',
            data: {
                _token: '{{ csrf_token() }}', // If you're using CSRF protection
            },
            success: function(response) {
                console.log(response.message);
                $('#notificationModal').modal('hide');
                // You may reload the modal content or refresh the page here if needed
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }


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
  <script>
    function bannerSwitcher() {
      next = $('.sec-1-input').filter(':checked').next('.sec-1-input');
      if (next.length) next.prop('checked', true);
      else $('.sec-1-input').first().prop('checked', true);
    }

    var bannerTimer = setInterval(bannerSwitcher, 5000);

    $('nav .controls label').click(function() {
      clearInterval(bannerTimer);
      bannerTimer = setInterval(bannerSwitcher, 5000)
    });
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
