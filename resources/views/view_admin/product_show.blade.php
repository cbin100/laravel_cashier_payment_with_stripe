@section('title', $product->product_name)
@extends('view_admin.layout')

@section('content_admin')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Show :  {{ $product->product_name }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">

                            <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Back</a></li>
                            <!--<li class="breadcrumb-item active">Dashboard v1</li>-->
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>



        <section class="content">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- Default box -->
                        <div class="card">
                            <div class="card-header">
                                @php
                                    $username = DB::table('products')
                                    ->join('users', 'products.user_id', '=', 'users.id')
                                    ->where('products.user_id', '=', ($product->user_id))
                                    //->select('users.name')
                                    ->first();

                                @endphp
                                Author: {{ $username->name }} |
                                Created:  {{ $product->created_at->diffForHumans() }} |
                                Updated:  {{ $product->updated_at->diffForHumans() }}

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>


                            @if (session('notification'))
                                <div class="notification is-primary">
                                    {{ session('notification') }}
                                </div>
                            @endif

                            <div class="card-body">
                                <div>
                                    {!! ($product->product_caption) !!}

                                </div>

                                <div>
                                    {!! ($product->product_description) !!}
                                    <img src="data:image/{{$product->product_mime_type}};base64, {{ $product->product_mine_base64 }}" style="width: 50%; float: right;">

                                 </div>

                            </div>

                            <!-- /.card-body  -->
                            <div class="card-footer">
                                <!-- Footer-->

                                <form method="post" action="{{ route('productDestroy', [$product->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="field is-grouped">
                                        <div class="control">
                                            <a href="{{ route('productEdit', [$product->id])}}" class="btn btn-primary"> Edit </a>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                            <!-- /.card-footer-->
                        </div>

                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
