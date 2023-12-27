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
                    <li class="nav-item1"><a class="nav-link1" href="{{ url('/home') }}">Home</a></li>
                    @auth
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <li class="nav-item1"><a class="nav-link1" href= "{{ url('/product-list') }}">Products</a></li>
                        <li class="nav-item1"><a class="nav-link1" href="{{ url('/user-list') }}">Users</a></li>
                    @endif
                    <li class="nav-item1"><a class="nav-link1" href="{{ route('logout') }}">Logout</a></li>
                    @else
                    <li class="nav-item1"><a class="nav-link1" href="{{ url('/login') }}">Login</a></li>
                    <li class="nav-item1"><a class="nav-link1" href="{{ url('/register') }}">Register</a></li>
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
            $('#productTable').DataTable(); // Add your table ID here
            
        });
    </script>
</body>

</html>
