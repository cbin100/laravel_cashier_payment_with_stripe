@section('title', 'New Menu')
@extends('view_admin.layout')

@section('content_admin')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">New menu</h1>
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

                    <form method="POST" action="{{ route('menus.store') }}" enctype="multipart/form-data">
                        @csrf





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
                                        <label for="post_status">Status</label>
                                        <select id="post_status" name="post_status" class="form-control form-control-lg select2 @error('post_status') is-invalid @enderror"
                                                style="width: 100%;">

                                            <option value="publish" selected="selected">Publish</option>
                                            <option value="inherit">Inherit</option>
                                            <option value="trash">Trush</option>
                                            <option value="private">Private</option>
                                        </select>
                                        @error('post_status')
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
                                        <label for="post_position">Position</label>
                                        <select id="post_position" name="post_position" class="form-control form-control-lg select2 @error('post_position') is-invalid @enderror">

                                            <option value="top-left">Top Left</option>
                                            <option value="top-right">Top Right</option>

                                            <option value="nav-left">Navbar Left</option>
                                            <option value="nav-right" selected="selected">Navbar Right</option>

                                            <option value="left">Left</option>
                                            <option value="right">Right</option>

                                            <option value="middle-left">Middle Left</option>
                                            <option value="middle-right">Middle Right</option>

                                            <option value="bottom-left">Bottom Left</option>
                                            <option value="bottom-right">Bottom Right</option>

                                            <option value="foot-left">Footer Left</option>
                                            <option value="foot-right">Footer Right</option>

                                        </select>
                                        @error('post_status')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="post_parent_category">Parent menu</label>
                                    <select id="post_parent_category" name="post_parent_category" class="form-control form-control-lg @error('post_position') is-invalid @enderror" style="width: 100%;">
                                        <option value="0" selected="selected">None</option>
                                        @php
                                            $posts_category = DB::table('posts')
                                                        ->where('post_type', 'menu')
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
                                    @error('post_parent_category')
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
                                    <label for="rank_menu">Rank </label>
                                    <input type="number" id="rank_menu" name="rank_menu" min="0" max="100" value="0"
                                           class="form-control form-control-lg @error('rank_menu') is-invalid @enderror"
                                           placeholder="Type the tittle">
                                    @error('rank_menu')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="" for="external_link">External link | Phone No | Email | Opening hours | Caption | Description </label>
                                    <input name="external_link" id="external_link" type="text" class="form-control form-control-lg @error('external_link') is-invalid @enderror"/>
                                    <span class="text-danger" id="image-input-error"></span>
                                    @error('external_link')
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
                                        <h5><strong> Linked posts </strong></h5>
                                        @php
                                            $posts_category = DB::table('posts')
                                                        ->where('post_type', 'article')
                                                        ->orWhere('post_type', 'page')
                                                        ->orWhere('post_type', 'category')
                                                        //->select('posts.*', 'users.name')
                                                        ->get();
                                                foreach ($posts_category as $post_category) {
                                                    //echo $post_category;

                                        @endphp

                                        <div class="icheck-primary d-inline">
                                            <label for="checked_category">
                                                <input type="checkbox" id="checked_category" name="checked_category[]"
                                                       value="{{ $post_category->id }}">

                                                {{ $post_category->post_title }} ({{$post_category->post_type}})
                                            </label>
                                        </div>

                                        @php
                                            }
                                        @endphp
                                    </div>

                            </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5><strong> Linked product's category (Ecommerce)</strong></h5>

                                        @foreach (\App\Models\ProductCategory::all() as $productCategory)

                                            <div class="icheck-primary d-inline">
                                                <label class="custom-control-label-pelo" for="checked_product">
                                                <input type="checkbox" name="checked_product[]" class="custom-control-input-pelo"
                                                       id="checked_product" value="{{ $productCategory->id }}">
                                                    {{ $productCategory->title }}
                                                </label>
                                            </div>
                                        @endforeach



                                    </div>





                                </div>
                        </div>

                   </div>


                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save the menu</button>
                        </div>
                    </form>
                        <div class="card-body">
                            <h3> Menu list</h3>

                            <table id="example1" class="table table-bordered table-striped" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Sub-menu</th>
                                    <th>Linked posts</th>
                                    <th>Position</th>
                                    <th>Rank</th>
                                    <th>Status</th>
                                    <th>Published</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $post->post_title }}</td>
                                        <td>{{ $post->name }}</td>
                                        <td>
                                        @php
                                        $postparent = DB::table('posts')
                                                        ->where('post_parent', $post->id)
                                                        ->select('post_title')
                                                        ->get();

                                                    foreach ($postparent as $pospar) {
                                                            echo $pospar->post_title;
                                                             //echo $postparent->post_title;
                                                    }

                                        @endphp
                                        </td>

                                        <td>
                                            @php
                                                //*
                                                    $post_category = DB::table('posts')
                                                                        ->join('postmetas', 'posts.id', '=', 'postmetas.post_parent_id')
                                                                        ->select('posts.*')
                                                                        //->distinct()
                                                                        ->where('postmetas.post_id', '=', $post->id)
                                                                        ->get();
                                                   // echo '<td>'.$post_category->id.'</td>'
                                                //*/

                                            @endphp
                                            @foreach ($post_category as $post_cat)
                                                {{ $post_cat->post_title }}<br/>
                                            @endforeach
                                        </td>
                                        <td>{{ $post->post_name }}</td>
                                        <td>{{ $post->menu_order }}</td>
                                        <td>{{ $post->post_status }}</td>


                                        <td>{{ \Carbon\Carbon::parse($post->updated_at)->diffForHumans() }}</td>

                                        <td width="11%">

                                            <form class="content" method="POST" action="{{ route('posts.destroy', [$post->id]) }}">
                                                @csrf
                                                @method('DELETE')

                                                <a href="{{ route('menus.edit', $post->id) }}">
                                                    <i class="fas fa-edit  fa-lg" title="Edit"></i>
                                                </a>

                                                <button type="submit" title="delete" style="border: none; background-color:transparent;">
                                                    <i class="fas fa-trash fa-lg text-danger" title="Delete"></i>
                                                </button>

                                            </form>

                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Sub-menu</th>
                                    <th>Linked posts</th>
                                    <th>Position</th>
                                    <th>Rank</th>
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
