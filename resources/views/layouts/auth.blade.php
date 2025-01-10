<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="Jassa">
    <meta name="keywords"
        content="Jassa, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png">

    <link rel="canonical" href="pages-sign-up.html">

    <title>Sign Up</title>

    <link href="css2.css?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Choose your prefered color scheme -->
    <!-- <link href="css/light.css" rel="stylesheet"> -->
    <!-- <link href="css/dark.css" rel="stylesheet"> -->

    <!-- BEGIN SETTINGS -->
    <!-- Remove this after purchasing -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	@stack('css')
    <link class="js-stylesheet" href="{{ asset('css/light.css') }}" rel="stylesheet">
    <style>
        body {
            opacity: 0;
        }
    </style>
    <!-- END SETTINGS -->
</head>


<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">

    @yield('content')

    @stack('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
