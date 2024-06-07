<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Modern Library - Loan</title>

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
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

    <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="notificationModalLabel">Notifications</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  No new notifications.
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>

    <div class="detail" style="background-color: #343a40">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-12 p-3">
            <div class="sticky-section">
              <div class="box-image mx-auto text-center">
                <img src="{{ $book->book_picture ? asset('storage/' . $book->book_picture) : asset('default-book-cover.jpg') }}" alt="Book Cover" class="img-detail d-block mx-auto">
              </div>
              <button class="btn-bookmark" id="bookmarkButton" data-book-id="{{ $book->id }}"><i class='bx bxs-bookmark'></i> Bookmark</button>
              <button class="btn-bookmark" id="deleteBookmark" data-book-id="{{ $book->id }}" style="background-color: white; display: none"><i class='bx bxs-bookmark'></i> Delete Bookmark</button>
            </div>
          </div>
          <div class="col-md-8 p-3">
            <div class="row-product ">
              <div class="col-12">
                <div class="box-info">
                  <p>{{ $book->writer }}</p>
                  <h1 style="color: white">{{ $book->title }}</h1>
                </div>
              </div>
              <div class="product-detail">
                <h3 style="margin-top: 20px; color: white">Synopsis</h3>
                <div class="sinop">
                  <p>
                    {{ $book->sinopsis }}
                  </p>
                  
                </div>
                <div class="detail-buku">
                  <h3 style="color: white">Detail Buku</h3>
                  <ul>
                    <li>
                      <span>
                        <h6 style="color: white">Page</h6>
                        <p>{{ $book->page }}</p>
                      </span>
  
                      <span>
                        <h6 style="color: white">Writer</h6>
                        <p>{{ $book->writer }}</p>
                      </span>
                    </li>
                    <li>
                      <span>
                        <h6 style="color: white">Language</h6>
                        <p>{{ $book->language }}</p>
                      </span>
  
                      <span>
                        <h6 style="color: white">Publisher</h6>
                        <p>{{ $book->publisher }}</p>
                      </span>
                    </li>
                    <li>
                      <span>
                        <h6 style="color: white">Rate</h6>
                        <p>{{ $book->rate }}</p>
                      </span>
                      <span>
                        <h6 style="color: white">Category</h6>
                        <p>{{ $book->category }}</p>
                      </span>
                    </li>
                    <li>
                      <span>
                        <h6 style="color: white">Stock</h6>
                        <p>{{ $book->stock }}</p>
                      </span>
                      <span>
                        <h6 style="color: white">Like</h6>
                        <p>{{ $book->like }}</p>
                      </span>
            
                    </li>
                  </ul>
                </div>
              </div>
              <div class="form-group">
                <label for="borrowDuration" style="color: white">Borrow Duration:</label>
                <input type="datetime-local" id="borrowDuration" class="form-control">
            </div>
            <div id="borrowButtonContainer">
              <button class="btn-detail" id="applyForBorrowButton" data-book-id="{{ $book->id }}">Apply for Borrow</button>
              <button class="btn-detail" id="cannotLoanText" style="background-color: orange" disabled>Cannot Apply</button>
            </div>
            </div> 
          </div>
        </div>
      </div>
    </div>


  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/wow.js"></script>
  <script src="assets/js/tabs.js"></script>
  <script src="assets/js/popup.js"></script>
  <script src="assets/js/custom.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', (event) => {
      // Get the current date and time
      const now = new Date();

      // Calculate the date 30 days from now
      const maxDate = new Date(now);
      maxDate.setDate(now.getDate() + 30);

      // Format the date to match the required format for datetime-local input
      const formattedMaxDate = maxDate.toISOString().slice(0, 16);

      // Set the max attribute of the input
      document.getElementById('borrowDuration').max = formattedMaxDate;
    });
</script>
<script>
  $(document).ready(function() {
    var bookId = $('#bookmarkButton').data('book-id');

    $.ajax({
        url: '/check-bookmark-status',
        method: 'POST',
        data: {
            book_id: bookId,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.exists) {
                $('#bookmarkButton').hide();
                $('#deleteBookmark').show();
            } else {
                $('#bookmarkButton').show();
                $('#deleteBookmark').hide();
            }
        }
    });

    $('#buttonBookmark').click(function() {
        $.ajax({
            url: '/add-bookmark',
            method: 'POST',
            data: {
                book_id: bookId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#bookmarkButton').hide();
                $('#deleteBookmark').hide();
            }
        });
    });

    $('#deleteBookmark').click(function() {
        $.ajax({
            url: '/delete-bookmark',
            method: 'DELETE',
            data: {
                book_id: bookId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#bookmarkButton').show();
                $('#deleteBookmark').hide();
            }
        });
    });
});

</script>
  <script>
    $(document).ready(function() {
        var bookId = $('#applyForBorrowButton').data('book-id');

        $.ajax({
            url: '/check-borrow-status',
            method: 'POST',
            data: {
                book_id: bookId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.exists) {
                    $('#applyForBorrowButton').hide();
                    $('#cannotLoanText').show();
                } else {
                    $('#applyForBorrowButton').show();
                    $('#cannotLoanText').hide();
                }
            }
        });
    });
</script>
  <script>

    document.addEventListener('DOMContentLoaded', function() {
            function applyForBorrow() {
                var bookId = '{{ $book->id }}';
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

            function addBookmark() {
              var bookId = '{{ $book->id }}';
              var formData = new FormData();
              formData.append('book_id', bookId);

              $.ajax({
                  type: 'POST',
                  url: '{{ route('add-bookmark') }}',
                  data: formData,
                  contentType: false,
                  processData: false,
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function(response) {
                      console.log(response);
                      // Hide Add Bookmark button
                      $('#bookmarkButton').hide();
                      // Show Delete Bookmark button
                      $('#deleteBookmark').show();
                  },
                  error: function(xhr, status, error) {
                      console.error(xhr.responseText);
                      alert("Failed to submit add request.");
                  }
              });
          }




            document.getElementById('bookmarkButton').onclick = addBookmark;
            // Attach the function to the button
            document.getElementById('applyForBorrowButton').onclick = applyForBorrow;
        });
        
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






