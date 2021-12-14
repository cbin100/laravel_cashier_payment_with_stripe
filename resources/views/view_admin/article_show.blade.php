@section('title', $post->post_title)
@extends('view_admin.layout')

@section('content_admin')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Show :  {{ $post->post_title }}</h1>
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
                                    $username = DB::table('posts')
                                    ->join('users', 'posts.user_id', '=', 'users.id')
                                    ->where('posts.user_id', '=', ($post->user_id))
                                    //->select('users.name')
                                    ->first();

                                @endphp
                                Author: {{ $username->name }} |
                                Created:  {{ $post->created_at->diffForHumans() }} |
                                Updated:  {{ $post->updated_at->diffForHumans() }}

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

                                <div>{!! ($post->post_content) !!}

                                </div>

                            </div>

                            <!-- /.card-body -->
                            <div class="card-footer">
                                <!-- Footer-->

                                <form method="post" action="{{ route('posts.destroy', [$post->id]) }}">
                                    @csrf @method('delete')
                                    <div class="field is-grouped">
                                        <div class="control">
                                            <a
                                                href="{{ route('posts.edit', [$post->id])}}"
                                                class="btn btn-primary"
                                            >
                                                Edit
                                            </a>
                                            <button type="button" class="btn btn-danger">Delete</button>

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
