<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GulaHub</title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<style>
    ::-webkit-scrollbar {
        display: none
    }
</style>

<body class="bg-gray-50 text-gray-800 font-sans scrollbar-hide">

    @include('components.navbar')

    <main>
        @yield('content')
    </main>

</body>
</html>
