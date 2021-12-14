@section('title', 'New Page')
@extends('view_admin.layout')

@section('content_admin')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">New page</h1>
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
        <section class="content">
            <div class="container-fluid">
                <!-- <div class="row"> -->

                <!-- general form elements -->
                <div class="card card-primary">
                    <!--
                    <div class="card-header">
                        <h3 class="card-title">Quick Example</h3>
                    </div>
                    -->
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ route('pages.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tittle">Title</label>
                                        <input type="text" id="post_title" name="post_title"
                                               class="form-control form-control-lg @error('post_title') is-invalid @enderror"
                                               placeholder="Type the tittle">
                                        @error('post_title')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="post_status">Status</label>
                                        <select id="post_status" name="post_status" class="form-control select2"
                                                style="width: 100%;">
                                            <option value="publish" selected="selected">Publish</option>
                                            <option value="inherit">Inherit</option>
                                            <option value="trash">Trush</option>
                                            <option value="private">Private</option>
                                        </select>

                                    </div>

                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label class="" for="">Featured image</label>

                                        <input name="file_upload" id="file_upload" type="file" class="form-control @error('file_upload') is-invalid @enderror"/>
                                        <input name="x_size" id="x_size" min="100" max="5000" type="number" class="form-controle" placeholder="X-Size"/>
                                        <input name="y_size" id="y_size" min="100" max="5000" type="number" class="form-controle" placeholder="Y-Size"/>
                                        <span class="text-danger" id="image-input-error"></span>
                                        @error('file_upload')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="" for="">Other options</label>
                                        <div
                                            class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input name="checked_comment" type="checkbox" class="custom-control-input"
                                                   id="checked_comment" value="checked_comment">
                                            <label class="custom-control-label" for="checked_comment">Allow
                                                comments</label>
                                        </div>

                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="checked_to_ping" class="custom-control-input"
                                                   id="checked_to_ping" value="1">
                                            <label class="custom-control-label" for="checked_to_ping">Stick this post to
                                                the top</label>
                                        </div>
                                    </div>


                                </div>
                            </div>


                            <!-- *************************
                            <div class="form-group">
                                <label for="exampleInputFile">File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>
                            -->

                        </div>

                        <div class="card-body">
                            <h3> Content</h3>
                            <textarea id="summernote" name="post_content"
                                      class="form-control @error('post_content') is-invalid @enderror" minlength="5"
                                      maxlength="6" required>
                            {{ old('content') }}
                            </textarea>
                            @error('post_content')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                            @enderror

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

@endsection
