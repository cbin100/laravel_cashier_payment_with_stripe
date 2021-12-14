@section('title', 'New Images')
@extends('view_admin.layout')

@section('content_admin')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">New images</h1>
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

                    <div class="card-header">
                        <!--<h3 class="card-title">Expandable Table</h3>-->
                        <!-- HERE THE DIV FOR NOTIFICATION MESSAGE -->
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if ($message = Session::get('unauthorised'))
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                                <p>{{ $message }}</p>
                            </div>
                        @endif


                    </div>

                    <!-- /.card-header -->
                    <!-- form start -->
                    {{-- action="{{ route('files.store') }}" --}}
                    {{-- action="javascript:void(0)" --}}
                    <form method="POST" action="{{ route('files.store') }}" enctype="multipart/form-data">
                        @csrf
                       @method('POST')

                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="post_title">Title</label>
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
                                        <label for="file_caption">Caption</label>
                                        <textarea id="file_caption" name="file_caption" class="form-control @error('file_caption') is-invalid @enderror" required>
                            {{ old('file_caption') }}
                            </textarea>

                                    </div>

                                </div>

                            </div>


                            <!-- /.row -->
                            <div class="row">
                                <div class="form-group">
                                    {{-- -}}
                                        <label for="exampleInputImage">Image:</label>
                                        <input type="file" name="profile_image" id="exampleInputImage" class="image" required>
                                        <input type="hidden" name="x1" value="" />
                                        <input type="hidden" name="y1" value="" />
                                        <input type="hidden" name="w" value="" />
                                        <input type="hidden" name="h" value="" />
                                    {{-- --}}
                                            {{-- --}}
                                            <input name="file_upload[]" id="file_upload" type="file" class="form-control @error('file_upload') is-invalid @enderror" multiple/>
                                    <input name="x_size" id="x_size" min="100" max="5000" type="text" value="100" class="form-controle" placeholder="X-Size"/>
                                    <input name="y_size" id="y_size" min="100" max="5000" type="text" value="100" class="form-controle" placeholder="Y-Size"/>

                                    <span class="text-danger" id="image-input-error"></span>
                                            @error('file_upload')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                    {{-- --}}
                                </div>

                                <div class="row mt-5">
                                    <p><img id="previewimage" style="display:none;"/></p>
                                    @if(session('path'))
                                        <img src="{{ session('path') }}" />
                                    @endif
                                </div>
                            </div>
                            <!-- /.row -->

                        </div>


                        <div class="card-body">
                            <h3> Description</h3>
                            <textarea id="summernote" name="post_content" class="form-control @error('post_content') is-invalid @enderror"
                                      required>
                            {{ old('post_content') }}
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

                    <div class="card-body">
                        sede
                    </div>
                </div>
                <!-- /.card -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
        @endsection


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('js/jquery.imgareaselect.min.js') }}"></script>
<script>
    jQuery(function($) {
        var p = $("#previewimage");

        $("body").on("change", ".image", function(){
            var imageReader = new FileReader();
            imageReader.readAsDataURL(document.querySelector(".image").files[0]);

            imageReader.onload = function (oFREvent) {
                p.attr('src', oFREvent.target.result).fadeIn();
            };
        });

        $('#previewimage').imgAreaSelect({
            onSelectEnd: function (img, selection) {
                $('input[name="x1"]').val(selection.x1);
                $('input[name="y1"]').val(selection.y1);
                $('input[name="w"]').val(selection.width);
                $('input[name="h"]').val(selection.height);
            }
        });
    });
</script>






        <script type="text/javascript">
            $(document).ready(function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $(function() {
// Multiple images preview with JavaScript
                    var ShowMultipleImagePreview = function(input, imgPreviewPlaceholder) {
                        if (input.files) {
                            var filesAmount = input.files.length;
                            for (i = 0; i < filesAmount; i++) {
                                var reader = new FileReader();
                                reader.onload = function(event) {
                                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                                }
                                reader.readAsDataURL(input.files[i]);
                            }
                        }
                    };
                    $('#images').on('change', function() {
                        ShowMultipleImagePreview(this, 'div.show-multiple-image-preview');
                    });
                });
                $('#multiple-image-preview-ajax').submit(function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    let TotalImages = $('#images')[0].files.length; //Total Images
                    let images = $('#images')[0];
                    for (let i = 0; i < TotalImages; i++) {
                        formData.append('images' + i, images.files[i]);
                    }
                    formData.append('TotalImages', TotalImages);
                    $.ajax({
                        type:'POST',
                        url: "{{ url('files')}}",
                        data: formData,
                        cache:false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            this.reset();
                            alert('Images has been uploaded using jQuery ajax with preview');
                            $('.show-multiple-image-preview').html("")
                        },
                        error: function(data){
                            console.log(data);
                        }
                    });
                });
            });
        </script>
