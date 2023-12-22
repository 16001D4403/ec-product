<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Laravel App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <!-- Add your CSS stylesheets or include a CSS framework like Bootstrap here -->
    <style>
        /* Your custom CSS */
.custom-width {
    width: 300px; /* Adjust the width as needed */
}

.bg-color {
            background-color: #3b4465;
        }
 
        .nav-item1 a {
            color: white;
            font-size: 16px;
            font-weight: 600;
            padding: 10px
        }
        .button {
  --width: 100px;
  --height: 35px;
  --tooltip-height: 35px;
  --tooltip-width: 90px;
  --gap-between-tooltip-to-button: 18px;
  --button-color: #222;
  --tooltip-color: #fff;
  width: var(--width);
  height: var(--height);
  background: var(--button-color);
  position: relative;
  text-align: center;
  border-radius: 0.45em;
  font-family: "Arial";
  transition: background 0.3s;
}

.button::before {
  position: absolute;
  content: attr(data-tooltip);
  width: var(--tooltip-width);
  height: var(--tooltip-height);
  background-color: #555;
  font-size: 0.9rem;
  color: #fff;
  border-radius: .25em;
  line-height: var(--tooltip-height);
  bottom: calc(var(--height) + var(--gap-between-tooltip-to-button) + 10px);
  left: calc(50% - var(--tooltip-width) / 2);
}

.button::after {
  position: absolute;
  content: '';
  width: 0;
  height: 0;
  border: 10px solid transparent;
  border-top-color: #555;
  left: calc(50% - 10px);
  bottom: calc(100% + var(--gap-between-tooltip-to-button) - 10px);
}

.button::after,.button::before {
  opacity: 0;
  visibility: hidden;
  transition: all 0.5s;
}

.text {
  display: flex;
  align-items: center;
  justify-content: center;
}

.button-wrapper,.text,.icon {
  overflow: hidden;
  position: absolute;
  width: 100%;
  height: 100%;
  left: 0;
  color: #fff;
}

.text {
  top: 0
}

.text,.icon {
  transition: top 0.5s;
}

.icon {
  color: #fff;
  top: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.icon svg {
  width: 24px;
  height: 24px;
}

.button:hover {
  background: #222;
}

.button:hover .text {
  top: -100%;
}

.button:hover .icon {
  top: 0;
}

.button:hover:before,.button:hover:after {
  opacity: 1;
  visibility: visible;
}

.button:hover:after {
  bottom: calc(var(--height) + var(--gap-between-tooltip-to-button) - 20px);
}

.button:hover:before {
  bottom: calc(var(--height) + var(--gap-between-tooltip-to-button));
}




        </style>

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-color">
            <!-- Brand/logo -->
            <a class="navbar-brand" href="/home">PHP Council</a>

            <!-- Links -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item1"><a class="nav-link1" href="/home">Home</a></li>
                    @auth
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <li class="nav-item1"><a class="nav-link1" href="/product-list">Products</a></li>
                        <li class="nav-item1"><a class="nav-link1" href="/user-list">Users</a></li>
                    @endif
                    <li class="nav-item1"><a class="nav-link1" href="{{ route('logout') }}">Logout</a></li>
                    @else
                    <li class="nav-item1"><a class="nav-link1" href="/login">Login</a></li>
                    <li class="nav-item1"><a class="nav-link1" href="/register">Register</a></li>
                    @endauth
                    <!-- Add more navigation links as needed -->
                </ul>
            </div>
        </nav>
    </header>
    <br>
    <main class="container">
        @yield('content')
    </main>
    <br>
    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} Your Company</p>
        </div>
    </footer>

    <!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <!-- Include Font Awesome -->
<!-- Include Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">

<script>
    $(document).ready(function() {
        $('.wishlist-btn').click(function() {
            $(this).toggleClass('active'); // Toggle heart button class for visual feedback

            // Toggle heart color on click
            if ($(this).hasClass('active')) {
                $(this).find('i').css('color', 'red');
            } else {
                $(this).find('i').css('color', 'initial');
            }

            // Retrieve product ID from the button's data attribute
            let productId = $(this).data('product-id');

            // Handle adding/removing product to/from the wishlist
            if ($(this).hasClass('active')) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'wishlist[]',
                    value: productId
                }).appendTo('#wishlistForm');
            } else {
                $('#wishlistForm input[value="' + productId + '"]').remove();
            }
        });
    });
</script>

    <script>
        $(document).ready(function() {
            $('#productTable').DataTable(); // Add your table ID here
            
        });
    </script>
</body>

</html>
