@section('title', 'New Post')
@extends('view_visitor.layout_visitor')

@section('content_visitor')

    <!-- Breadcrumb -->
    {{-- --}}@include('view_visitor.view_breadcrumb') {{-- --}}
    <!-- / End Breadcrumb -->

    <!-- Portfolio -->
    @include('view_visitor.index_portfolio')
    <!--/ Portfolio -->

    <!-- Counterup -->
    @include('view_visitor.index_counterup')
    <!--/ Counterup -->

    <!-- Features Area -->
    @include('view_visitor.visitor_features_area')
    <!--/ Features Area -->

    <!-- Client Area -->
    {{-- }}
    @include('view_visitor.index_client')
    {{-- --}}
    <!--/ Client Area -->

    <!-- Call To Action -->
    @include('view_visitor.call_to_contact')
    <!--/ Call To Action -->
@endsection

