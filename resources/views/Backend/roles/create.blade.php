@extends('Backend.Starter')
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <div class="content pt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h1 class="card-title">Add Role</h1>
                            </div>
                            <div class="card-body">
                                <form action="{{route('roles.store')}}" method="POST" enctype="multipart/form-data">
                                    @include('Backend.roles._form',['btnTxt' => 'Save'])
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
