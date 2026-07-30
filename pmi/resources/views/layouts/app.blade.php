<!DOCTYPE html>
<html>

<head>
    <title>PMI</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/fonts.css')}}">
    <link rel="stylesheet" href="{{asset('css/w3.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Raleway", sans-serif
        }
    </style>
</head>

<body class="w3-light-grey w3-content" style="max-width:1600px">

    <!-- Sidebar/menu -->
    <x-sidebar />


    <!-- !PAGE CONTENT! -->
    <div class="w3-main" style="margin-left:300px">

        <!-- Header -->
        <header id="portfolio">
            @yield('note-header-new')
            @yield('recipe-header')
        </header>

        <!-- Content -->

        {{-- home view --}}
        @yield('home')

        {{-- note view --}}
        @yield('note-grid')

        {{-- meal view  --}}
        @yield('meals')

        <!-- End page content -->
    </div>



</body>

</html>
