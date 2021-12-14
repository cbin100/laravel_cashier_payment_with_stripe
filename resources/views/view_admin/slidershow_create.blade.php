@section('title', 'Slidershow')
@extends('view_admin.layout')

@section('content_admin')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Slidershow</h1>
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

                    <form method="POST" action="{{ route('slider.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slider_title">Title</label>
                                        <input type="text" id="slider_title" name="slider_title"
                                               class="form-control form-control-lg @error('slider_title') is-invalid @enderror"
                                               placeholder="Type the tittle">
                                        @error('slider_title')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slider_status">Status</label>
                                        <select id="slider_status" name="slider_status" class="form-control form-control-lg select2 @error('slider_status') is-invalid @enderror"
                                                style="width: 100%;">

                                            <option value="publish" selected="selected">Publish</option>
                                            <option value="inherit">Inherit</option>
                                            <option value="trash">Trush</option>
                                            <option value="private">Private</option>
                                        </select>
                                        @error('slider_status')
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
                                        <label for="slider_caption">Caption</label>
                                        <textarea name="slider_caption"
                                                  class="form-control @error('slider_caption') is-invalid @enderror" required></textarea>

                                        @error('slider_caption')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="slider_parent">Parent Slidershow</label>
                                        <select id="slider_parent" name="slider_parent" class="form-control form-control-lg @error('slider_parent') is-invalid @enderror" style="width: 100%;">
                                            <option value="0" selected="selected">None</option>
                                            @php
                                                $posts_category = DB::table('slidershows')
                                                            ->where('slider_type', 'slider')
                                                            //->select('posts.*', 'users.name')
                                                            ->get();
                                                    foreach ($posts_category as $post_category) {
                                                        //echo $post_category;
                                            @endphp
                                            <option value="{{ $post_category->id }}">{{ $post_category->slider_title }}</option>
                                            @php
                                                }
                                            @endphp
                                        </select>
                                        @error('slider_parent')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                    {{-- }}
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="checked_to_ping" class="custom-control-input"
                                                   id="checked_to_ping" value="1">
                                            <label class="custom-control-label" for="checked_to_ping">Stick this post to
                                                the top</label>
                                        </div>
                                    </div>

                                    --}}
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="slider_description">Description</label>
                                        <textarea name="slider_description"
                                                  class="form-control @error('slider_description') is-invalid @enderror" required></textarea>

                                        @error('slider_description')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
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

                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="checked_to_ping" class="custom-control-input"
                                                   id="checked_to_ping" value="1">
                                            <label class="custom-control-label" for="checked_to_ping">Stick this post to
                                                the top</label>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row">

                                <table id="example1" class="table table-bordered table-striped" >
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Linked posts</th>
                                        <th>Linked image</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                        {{-- @foreach($posts as $post) --}}
                                        <tr>
                                            <td>{{-- ++$i --}}</td>
                                            <td>
                                                {{-- $post->post_title --}}
                                            @php
                                                $articles = DB::table('posts')
                                                    ->where('post_type', 'article')
                                                    ->orWhere('post_type', 'page')
                                                    ->select('posts.*')
                                                    ->get();
                                                    foreach ($articles as $article) {
                                                        echo '<label for="linked_post" > <input type="radio" name="linked_post" id="linked_post" value="'.$article->id.'">' .$article->post_title. '</label><br/>' ;
                                                    }
                                            @endphp

                                            </td>
                                            <td>
                                                @php
                                                    $pictures = DB::table('posts')
                                                        //->where('post_mime_type', 'like', 'jp%')
                                                        //->orWhere('post_mime_type', 'like', 'png%')
                                                        ->where('posts.post_mime_type', '<>', '')
                                                        ->where('posts.post_mine_base64', '<>', '')
                                                        ->select('posts.*')
                                                        ->get();
                                                        foreach ($pictures as $picture) {
                                                echo '<label for="linked_image"> <input type="radio" name="linked_image" id="linked_image" value="'.$picture->id.'"> <img src="data:image/'.$picture->post_mime_type.';base64,'.$picture->post_mine_base64.'" width="100" height="100"/> </label> ';
                                                    }
                                                @endphp



                                            </td>
                                        </tr>

                                   {{-- @endforeach --}}
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Linked post</th>
                                        <th>Linked image</th>

                                    </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>


                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save the Slider</button>
                        </div>
                    </form>



                    <div class="card-body">
                        <h3> Menu list</h3>




                        <table id="example1" class="table table-bordered table-striped" >
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Sub-slider</th>
                                <th>Linked posts</th>
                                <th>Linked image</th>
                                <th>Caption</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Published</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{-- @foreach($posts as $post) --}}
                            @php
                                $mysliders = DB::table('slidershows')
                                                ->join('posts', 'posts.id', '=', 'slidershows.post_image_id')
                                                ->join('users', 'posts.user_id', '=', 'users.id')
                                                ->where('posts.post_mime_type', 'like', 'jpg%')
                                                ->orWhere('posts.post_mime_type', 'like', 'png%')
                                                //
                                                //->where('posts.post_mime_type', '<>', '')
                                                //->where('posts.post_mine_base64', '<>', '')
                                                //->where('post_type', 'article')
                                                //->orWhere('post_type', 'page')
                                                ->select('posts.*', 'slidershows.*', 'users.name')
                                                ->get();

                                            foreach ($mysliders as $myslider)
                                            {

                               echo '  <tr>';

                                   // echo  '<td> </td>';
                                    echo '<td>' .$myslider->slider_title.'</td>';
                                    echo '<td>' .$myslider->name.'</td>';
                                    echo '<td>' .$myslider->slider_title.'</td>';
                                    echo '<td>' .$myslider->post_title.'</td>';
                                    //{{ 'data:image/'.$post->post_mime_type.';base64,'.$post->post_mine_base64.'' }}
                                    //echo '<td> <img src="'.url('storage/app/public/'.$myslider->guid).'" width="100" height="100"/></td>';
                                    echo '<td> <img src="data:image/'.$myslider->post_mime_type.';base64,'.$myslider->post_mine_base64.'" width="100" height="100"/></td>';
                                    echo '<td>' .$myslider->slider_caption.'</td>';
                                    echo '<td>' .$myslider->slider_caption.'</td>';
                                    echo '<td>' .$myslider->slider_status.'</td>';
                                    //echo '<td>' .$myslider->updated_at.'</td>';

                                    @endphp



                                    <td>{{ \Carbon\Carbon::parse($myslider->updated_at)->diffForHumans() }}</td>

                                    <td width="11%">

                                        <form class="content" method="POST" action="{{ route('slider.destroy', [$myslider->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            {{--
                                            <a href="{{ route('menus.edit', $myslider->id) }}">
                                                <i class="fas fa-edit  fa-lg" title="Edit"></i>
                                            </a>
                                            --}}
                                            <button type="submit" title="delete" style="border: none; background-color:transparent;">
                                                <i class="fas fa-trash fa-lg text-danger" title="Delete"></i>
                                            </button>

                                        </form>

                                    </td>
                                </tr>
                            @php
                            }
                            @endphp

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Sub-menu</th>
                                <th>Linked posts</th>
                                <th>Linked image</th>
                                <th>Caption</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Published</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>




                    </div>


                </div>
                <!-- /.card -->


            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

@endsection
