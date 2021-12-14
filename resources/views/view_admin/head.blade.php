<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ config('app.name', 'Pelo') }} |
        @hasSection('title')
            @yield('title')
        @else
            {{ Route::currentRouteName() }}
        @endif
    </title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('t_admin/admin1/vendors/images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('t_admin/admin1/vendors/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('t_admin/admin1/vendors/images/favicon-16x16.png') }}">

    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{ asset('t_admin/plugins/dropzone/min/dropzone.min.css') }}">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

<!--
    {% seo %}
-->
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('t_admin/plugins/fontawesome-free/css/all.min.css') }}">
   <!--
    <link rel="stylesheet" href="t_admin/plugins/fontawesome-free/css/all.min.css">
    -->

    <!-- OTHER CSS CODES -->
    <link rel="stylesheet" href="{{ asset('t_admin/assets/css/docs.css') }}">
    <link rel="stylesheet" href="{{ asset('t_admin/assets/css/highlighter.css') }}">
    <!-- /OTHER CSS CODES -->

    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('t_admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('t_admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('t_admin/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('t_admin/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('t_admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('t_admin/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('t_admin/plugins/summernote/summernote-bs4.min.css') }}">

    {{-- -}}<link rel="stylesheet" href="{{ asset('css/imgareaselect-animated.css') }}" /> {{-- --}}

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-1TVJHJCNCY"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-1TVJHJCNCY');
    </script>

    {{-- STRIPE STUFFS -}}
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
    {{-- -}}<script src="{{ asset('js/client.js') }}" defer></script> {{-- --}}
    {{-- /STRIPE STUFFS --}}


</head>
