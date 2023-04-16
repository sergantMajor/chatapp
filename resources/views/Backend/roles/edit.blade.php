@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <div class="content pt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6 d-flex align-items-center">
                                        <h1 class="card-title">Edit Product</h1>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a href="#" onclick="history.go(-1)" class="btn btn-secondary">Back</a>
                                    </div>
                                </div>                            </div>
                            <div class="card-body">
                                <form action="{{route('products.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @include('dashboard.products._form',['btnTxt' => 'Update'])
                                </form>
                            </div>
                        </div><!-- /.card -->
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection
