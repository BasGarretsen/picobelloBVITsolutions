
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Legoland Doetinchem</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    @vite(['resources/js/app.js', 'resources/js/script.js', 'resources/css/app.css'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <header>
        <h1>Hoi</h1>
    </header>
    <div class="container">
        @yield('content')
        @yield('sidebar')
    </div>
    <footer>
        <p>© Legoland Doetinchem B.V., alle rechten voorbehouden</p>
    </footer>
</body>
</html>

