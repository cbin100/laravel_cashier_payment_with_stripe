@section('title', 'New Post')
@extends('view_admin.layout')

@section('content_admin')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add New Product's Category</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Back</a></li>
                            <!--<li class="breadcrumb-item active">Dashboard v1</li>-->
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->


        <!-- Main content -->
        <form class="content" method="POST" action="{{ route('categoryProductStore') }}">
            @csrf

            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <!--
                        <h3 class="card-title">Select2 (Default Theme)</h3>
                        -->
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <!--
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                            -->
                        </div>
                    </div>
                    <!-- /.card-header -->


                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" id="title" name="title" value="{{ old('title') }}"
                                           class="form-control form-control-lg @error('title') is-invalid @enderror"
                                           placeholder="Type the tittle">
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.col -->

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="parent_category">Parent Category</label>
                                    <select id="parent_category" name="parent_category" class="form-control form-control-lg" style="width: 100%;">
                                        <option value="0" selected="selected">None</option>
                                        @foreach (\App\Models\ProductCategory::all() as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <!-- /.row -->

                        <div class="form-group">
                            <h5>Content</h5>
                            <textarea id="summernote" name="content" class="form-control @error('content') is-invalid @enderror" minlength="5" maxlength="6" required>
                            {{ old('content') }}
                            </textarea>
                            @error('content')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                        <!-- /.form-group -->

                    </div>
                    <!-- /.card-body -->

                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                            @php
                                Session::forget('success');
                            @endphp
                        </div>
                @endif

                <!-- /.row -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- /.container-fluid -->
        <!-- /.content -->
    </div>
    <!-- Content Wrapper. Contains page content -->


@endsection
