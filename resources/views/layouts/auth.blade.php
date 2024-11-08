<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <a class="navbar-brand mx-auto" href="{{ route('dashboard') }}">
            <img src="{{ asset('image/logo.png') }}" alt="YUPITA Air Minum" style="height: 60px; width: auto;">
            </a>
        </div>
    </nav>
    <section id="login" class="py-5" style="margin-top: 50px; margin-bottom: 50px;">
        <div class="container" style="height: 100%; align-content: center;">
            <div class="row justify-content-center">
                <!-- Memperlebar form dengan ukuran kolom yang lebih besar -->
                <div class="col-lg-5 col-md-6 col-sm-10">
                    <div class="card" style="width: 100%; max-width: 500px; margin: auto;">
                        <div class="card-header text-center">
                            @yield('name')
                        </div>
                        <div class="card-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="bg-primary fixed-bottom text-light py-2 text-center">
        <p>&copy; 2024 Yupita Air Minum</p>
    </footer>
</body>

</html>
