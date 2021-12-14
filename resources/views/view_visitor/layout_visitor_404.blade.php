<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- include head -->
@include('view_visitor.head_404')
<!-- /include head -->

<body id="bg">

<!-- Boxed Layout -->
<div id="page" class="site boxed-layout">


    <!-- Preloader -->

    <div class="preeloader">
        <div class="preloader-spinner"></div>
    </div>
    <!--	-->
    <!--/ End Preloader -->


    <!-- include navbar -->
@include('view_visitor.visitor_navbar')
<!-- /include navbar -->

    <!-- Section -->

@yield('content_visitor')
<!-- /Section -->
{{-- --}}




<!-- include foot -->
@include('view_visitor.footer')
<!-- /include foot -->

</body>
</html>
