<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GulaHub</title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<style>
    ::-webkit-scrollbar {
        display: none
    }
</style>

<body class="bg-gradient-to-br from-green-50 to-green-100 min-h-screen">

    <main>
        @yield('content')
    </main>

</body>
</html>
