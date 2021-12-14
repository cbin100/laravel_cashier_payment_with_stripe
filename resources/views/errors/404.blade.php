@section('title', 'New Post')
@extends('view_visitor.layout_visitor_404')

@section('content_visitor')

    {{-- }}
   <!-- Breadcrumb -->
   {{-- --}}@include('view_visitor.view_breadcrumb_error') {{-- --}}
    <!-- / End Breadcrumb -->
    {{-- --}}
    <!-- Features Area -->
    @include('view_visitor.visitor_404_content')
    <!--/ Features Area -->

    <!-- Client Area -->
    {{-- }}
    @include('view_visitor.index_client')
    {{-- --}}
    <!--/ Client Area -->

    {{-- --}}
    <!-- Call To Action -->
    @include('view_visitor.call_to_contact')
    <!--/ Call To Action -->
{{-- --}}

    {{-- -}}
    <!-- Counterup -->
    @include('view_visitor.index_counterup')
    <!--/ Counterup -->
    {{-- --}}
@endsection

