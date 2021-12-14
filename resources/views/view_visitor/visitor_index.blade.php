@section('title', 'New Post')
@extends('view_visitor.layout_visitor')

@section('content_visitor')


    <!-- Hero Slider -->
    {{-- --}}@include('view_visitor.slidershow') {{-- --}}
    {{-- }}@include('view_visitor.hereslider'){{-- --}}
    <!--/ Hero Slider -->
    {{-- --}}
    <!-- Features Area -->
    @include('view_visitor.visitor_features_area')
    <!--/ Features Area -->

    <!-- Call To Action -->
    @include('view_visitor.call_to_action')
    <!--/ Call To Action -->

    <!-- Services -->
    @include('view_visitor.index_services')
    <!--/ Services -->

    <!-- Counterup -->
    @include('view_visitor.index_counterup')
    <!--/ Counterup -->

    <!-- Portfolio -->
    @include('view_visitor.index_portfolio')
    <!--/ Portfolio -->

    <!-- Testimonials -->
    @include('view_visitor.index_testimonies')
    <!--/ Testimonials -->

    <!-- Latest Blog -->
    @include('view_visitor.index_blog')
    <!--/ Latest Blog -->

    <!-- Client Area -->
    {{-- }}
    @include('view_visitor.index_client')
    {{-- --}}
    <!--/ Client Area -->

    <!-- Call To Action -->
    @include('view_visitor.call_to_contact')
    <!--/ Call To Action -->
@endsection

