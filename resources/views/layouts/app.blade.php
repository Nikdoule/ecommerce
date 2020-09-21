<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    @yield('extra-script')

</head>

<body>
    <div id="app">
        <main>
            @yield('verify')
            @yield('register')
            @yield('login')
            @yield('content')
            @yield('products')
            @yield('users')
            @yield('edit-user')
            @yield('edit-profil-user')
            @yield('product')
            @yield('cart')
            @yield('checkout')
            @yield('thankyou')
            @yield('category')
            @yield('edit-product')
            @yield('create-product')
            @yield('create-code')
        </main>
    </div>
    @yield('extra-js')
   
</body>

</html>
