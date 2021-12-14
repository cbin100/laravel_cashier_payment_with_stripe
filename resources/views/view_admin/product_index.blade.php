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
                        <h1 class="m-0">Products</h1>
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
                            <div class="card-body">



                                <table id="example1" class="table table-bordered table-striped" >
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Currency</th>
                                        <th>Status</th>
                                        <th>VAT Rate (%)</th>
                                        <th>Priority</th>
                                        <th>Published</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>
                                                @php
                                                    //*
                                                        $post_category = DB::table('product_categories')
                                                                            ->join('product_metas', 'product_categories.id', '=', 'product_metas.product_parent_id')
                                                                            ->select('product_categories.*')
                                                                            //->distinct()
                                                                            ->where('product_metas.product_id', '=', $product->id)
                                                                            ->get();
                                                       // echo '<td>'.$post_category->id.'</td>'
                                                    //*/

                                                @endphp
                                                @foreach ($post_category as $post_cat)
                                                    {{ $post_cat->title }}<br/>
                                                @endforeach
                                            </td>
                                            <td>{{ $product->product_price }}</td>
                                            <td>{{ $product->product_currency }}</td>
                                            <td>{{ $product->product_status }}</td>
                                            <td>{{ $product->product_vat_rate }}</td>
                                            <td> {{ $product->to_ping }} </td>
                                            <td>{{ \Carbon\Carbon::parse($product->updated_at)->diffForHumans() }}</td>

                                            <td width="11%">

                                                <form class="content" method="POST" action="{{ route('productDestroy', [$product->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('productShow', $product->id) }}">
                                                        <i class="fas fa-eye text-success  fa-lg" title="Show"></i>
                                                    </a>

                                                    <a href="{{ route('productEdit', $product->id) }}">
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
                                        <th>Price</th>
                                        <th>Currency</th>
                                        <th>Status</th>
                                        <th>VAT Rate (%)</th>
                                        <th>Priority</th>
                                        <th>Published</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->

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
