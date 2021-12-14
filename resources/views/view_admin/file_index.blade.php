@section('title', 'Images')
@extends('view_admin.layout')

@section('content_admin')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Images</h1>
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
        <div class="content">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div><a href="{{ route('files.create') }}"> New images</a></div>
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
                            <!-- ./card-header -->
                            {{--
                            <div class="card-body">

                                <table id="example1" class="table table-bordered table-striped" >
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Category</th>
                                        <th>Tags</th>
                                        <th>Status</th>
                                        <th>Comment Status</th>
                                        <th>Comments</th>
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
                                            <td>{{ $post->post_type }}</td>
                                            <td>{{ $post->post_tag }}</td>
                                            <td>{{ $post->post_status }}</td>
                                            <td>{{ $post->comment_status }}</td>
                                            <td> {{ $post->post_comment_count }} </td>
                                            <td>{{ \Carbon\Carbon::parse($post->updated_at)->diffForHumans() }}</td>

                                            <td width="11%">

                                                <form class="content" method="POST" action="{{ route('posts.destroy', [$post->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('posts.show', $post->id) }}">
                                                        <i class="fas fa-eye text-success  fa-lg" title="Show"></i>
                                                    </a>

                                                    <a href="{{ route('posts.edit', $post->id) }}">
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
                                        <th>Category</th>
                                        <th>Tags</th>
                                        <th>Status</th>
                                        <th>Comment Status</th>
                                        <th>Comments</th>
                                        <th>Published</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>

                            </div>
                            --}}

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->


                <div class="col-12">
                    <div class="card card-primary">

                        <div class="card-header">
                            <h4 class="card-title">Ekko Lightbox {{--  {{ asset('storage/pelouploads/'.$posts->post_name) }} --}}</h4>
                        </div>
                        <!--  -->

                        <div class="card-body">
                            <div class="row">
                                @foreach($posts as $post)
                                  {{-- {{ asset('storage/app/public/pelouploads/'.$post->guid) }} --}}

                                <div class="col-sm-2">
                                    {{--<a href="{{ asset('storage/app/public/'.$post->guid) }}" data-toggle="lightbox"
                                    data-title="{{ $post->post_title }}" data-gallery="gallery">
                                    <img src="{{ url('storage/app/public/'.$post->guid) }}" class="img-fluid mb-2"
                                         alt="{{ $post->post_title }}"/>
                                    </a>--}}
                                    <a href="{{ 'data:image/'.$post->post_mime_type.';base64,'.$post->post_mine_base64.'' }}" data-toggle="lightbox" data-title="{{ $post->post_title }}" data-gallery="gallery">
                                        <img src="{{ 'data:image/'.$post->post_mime_type.';base64,'.$post->post_mine_base64.'' }}" class="img-fluid mb-2" alt="{{ $post->post_title }}"/>
                                    </a>
                                </div>
                                @endforeach


                                    {{--
                                      <div class="col-sm-2">
                                    <a href="https://via.placeholder.com/1200/000000.png?text=2" data-toggle="lightbox" data-title="sample 2 - black" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/000000?text=2" class="img-fluid mb-2" alt="black sample"/>
                                    </a>
                                </div>
                                     --}}

                            </div>
                        </div>
                    </div>
                </div>




            </div><!-- /.container-fluid -->



        </div>
        <!-- /.content -->
    </div>
    <!-- Content Wrapper. Contains page content -->


@endsection

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>




