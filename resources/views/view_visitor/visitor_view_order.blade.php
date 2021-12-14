@section('title', 'New Post')
@extends('view_visitor.layout_visitor')

@section('content_visitor')

    {{-- }}
   <!-- Breadcrumb -->
   {{-- --}}@include('view_visitor.view_breadcrumb') {{-- --}}
    <!-- / End Breadcrumb -->
    {{-- --}}
    <!-- Features Area -->
    @include('view_visitor.visitor_view_order_billing_form')
    <!--/ Features Area -->

    {{-- -}}
    <!-- Call To Action -->
    @include('view_visitor.call_to_action')
    <!--/ Call To Action -->
    {{-- --}}
    {{-- -}}
    <!-- Latest Blog -->
    @include('view_visitor.index_blog')
    <!--/ Latest Blog -->
    {{-- --}}
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

