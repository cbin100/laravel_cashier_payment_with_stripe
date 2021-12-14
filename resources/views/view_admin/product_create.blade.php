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
                        <h1 class="m-0">New product</h1>
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
                    <form method="POST" action="{{ route('productStore') }}" enctype="multipart/form-data">
                        @csrf
                        {{-- -}}@method('PUT'){{-- --}}
                        @method('POST')
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_name">Title or product name *</label>
                                        <input type="text" id="product_name" name="product_name"
                                               class="form-control form-control-lg @error('product_name') is-invalid @enderror" value="{{ old('product_name') }}"
                                               placeholder="Type the tittle">
                                        @error('product_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_status">Status</label>
                                        <select id="product_status" name="product_status" class="form-control select2"
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
                                        <label for="product_price">Price *</label>
                                        <input type="number" id="product_price" name="product_price"
                                               class="form-control form-control-lg @error('product_price') is-invalid @enderror" min="1" value="{{ old('product_price') }}"
                                               placeholder="Type the Unit Price">
                                        @error('product_price')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_currency">Currency *</label>
                                        <select id="product_currency" name="product_currency" class="form-control select2"
                                                style="width: 100%;">
                                            <option value="gbp" selected="selected">British Pound</option>
                                            <option value="eur">Euro</option>
                                            <option value="usd">US Dollar</option>
                                            <option value="cad">Canadian Dollar</option>
                                        </select>
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_vat_rate">VAT Rate (%) *</label>
                                        <input type="number" id="product_vat_rate" name="product_vat_rate"
                                               class="form-control form-control-lg @error('product_vat_rate') is-invalid @enderror" min="0" value="{{ old('product_vat_rate') }}"
                                               placeholder="Type the VAT Rate, e.g 20 for 20% rate">
                                        @error('product_vat_rate')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="" for="">Featured image</label>
                                        <input name="file_upload" id="file_upload" type="file" class="form-control @error('file_upload') is-invalid @enderror"/>
                                        <span class="text-danger" id="image-input-error"></span>
                                        @error('file_upload')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>



                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="product_caption">Caption</label>
                                        <textarea name="product_caption"
                                                  class="form-control @error('product_caption') is-invalid @enderror" required>{{ old('product_caption') }}</textarea>

                                        @error('product_caption')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <h5><strong> Category </strong></h5>
                                        <div class="icheck-primary d-inline">
                                        @foreach (\App\Models\ProductCategory::all() as $category)
                                            <label for="checked_category">
                                                <input type="checkbox" id="checked_category" name="checked_category[]" value="{{ $category->id }}">
                                                    {{ $category->title }}
                                            </label>
                                        @endforeach
                                        </div>

                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{-- -}}
                                        <div
                                            class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input name="checked_comment" type="checkbox" class="custom-control-input"
                                                   id="checked_comment" value="checked_comment">
                                            <label class="custom-control-label" for="checked_comment">Allow comments</label>
                                        </div>
                                        {{-- --}}
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="checked_to_ping" class="custom-control-input"
                                                   id="checked_to_ping" value="1">
                                            <label class="custom-control-label" for="checked_to_ping">Stick this post to
                                                the top</label>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label class="" for="external_link">External link</label>

                                        <input name="external_link" id="external_link" type="text" class="form-control @error('external_link') is-invalid @enderror"/>
                                        <span class="text-danger" id="image-input-error"></span>
                                        @error('external_link')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>


                        </div>

                        <div class="card-body">
                            <h3> Content</h3>
                            <textarea id="summernote" name="product_description"
                                      class="form-control @error('product_description') is-invalid @enderror" minlength="5"
                                      maxlength="6" required>
                            {{ old('product_description') }}
                            </textarea>
                            @error('product_description')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                            @enderror

                        </div>


                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->


            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

@endsection
