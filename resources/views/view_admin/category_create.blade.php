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
                        <h1 class="m-0">Add New Category</h1>
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
            <form class="content" method="POST" action="{{ route('category.store') }}">
                @csrf
                @method('POST')
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
                                    <label for="post_parent_category">Parent Category</label>
                                    <select id="post_parent_category" name="post_parent_category" class="form-control form-control-lg" style="width: 100%;">
                                        <option value="0" selected="selected">None</option>
                                    @php
                                        $posts_category = DB::table('posts')
                                                    ->where('post_type', 'category')
                                                    //->select('posts.*', 'users.name')
                                                    ->get();
                                            foreach ($posts_category as $post_category) {
                                                //echo $post_category;
                                    @endphp
                                        <option value="{{ $post_category->id }}">{{ $post_category->post_title }}</option>
                                        @php
                                            }
                                        @endphp
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


                    <!--
                      <div class="row">
                          <div class="col-md-6">

                              <div class="card card-info">
                                  <div class="card-header">
                                      <h3 class="card-title">Color & Time Picker</h3>
                                  </div>
                                  <div class="card-body">
                                      <div class="form-group">
                                          <label>Color picker:</label>
                                          <input type="text" class="form-control my-colorpicker1">
                                      </div>

                                      <div class="form-group">
                                          <label>Color picker with addon:</label>

                                          <div class="input-group my-colorpicker2">
                                              <input type="text" class="form-control">

                                              <div class="input-group-append">
                                                  <span class="input-group-text"><i class="fas fa-square"></i></span>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="bootstrap-timepicker">
                                          <div class="form-group">
                                              <label>Time picker:</label>

                                              <div class="input-group date" id="timepicker" data-target-input="nearest">
                                                  <input type="text" class="form-control datetimepicker-input" data-target="#timepicker"/>
                                                  <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                                      <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                          </div>

                          <div class="col-md-6">
                              <div class="card card-primary">
                                  <div class="card-header">
                                      <h3 class="card-title">Date picker</h3>
                                  </div>
                                  <div class="card-body">

                                      <div class="form-group">
                                          <label>Date:</label>
                                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                              <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                              <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <label>Date range:</label>

                                          <div class="input-group">
                                              <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="far fa-calendar-alt"></i>
                            </span>
                                              </div>
                                              <input type="text" class="form-control float-right" id="reservation">
                                          </div>
                                      </div>

                                  </div>

                              </div>



                          </div>
                      </div>
                      -->
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
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
            <!-- /.container-fluid -->
        <!-- /.content -->
    </div>
    <!-- Content Wrapper. Contains page content -->


@endsection
