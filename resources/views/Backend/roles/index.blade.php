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
                            <h1 class="card-title">Roles Table</h1>
                        </div>
                        <div class="card-body">
                            <table id="roleDatatable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>

                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $roledetails as $data )

                                    <tr>
                                        <td>{{$data->name}}</td>
                                        <td>{{$data->description}}</td>
                                        <td>{{$data->created_at}}</td>
                                        <td>{{$data->updated_at}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
@section('page_level_script')
    @include('Backend.roles._rolejs')
    <script>
        $( document ).ready(function( $ ) {
            let table = $('#roleDatatable').DataTable({
                "serverSide": true,
                "ajax": {
                    "url": '{{route('roles.index')}}',
                    "dataType":"json",
                    "type":"GET",
                    "data":{"_token":CSRF_TOKEN},
                    "tryCount" : 0,
                    "retryLimit" : 2,
                    error: function(xhr, ajaxOptions, thrownError) {
                        if (xhr.status === 500) {
                            this.tryCount++;
                            if (this.tryCount <= this.retryLimit) {
                                //try again
                                $.ajax(this);
                                return;
                            }
                        }
                        let obj = JSON.parse(xhr.responseText);
                        if(obj.message){
                            alert(obj.message);
                            // toastError(obj.message)
                        }
                    }
                },
                "columns":[
                    {"data":"name"},
                    {"data":"description"},

                    {"data":"created_at"},
                    {"data":"action","searchable":false,"orderable":false}
                ],
                "rowId": 'id',
                "order": [[ 0, "asc" ]],
                // "lengthMenu": [[100, 200, 500, -1], [ 100, 200, 500, 'All']],
                "lengthMenu": [[25, 50, 100, 500], [ 25, 50, 100, 500]],
                "pageLength": 25,
                "deferRender": true,
                fixedHeader: true,
                // "pagingType": "simple",
                // "searchable": false,
                // "dom": '<"top">rt<" bottom.d-md-flex.justify-content-between"lip><"clear">',
                "language": {
                    "emptyTable": " "
                }

            $('.table-search').on( 'keyup', function () {
                table.search( this.value ).draw();
            } );

        });

        function toggleRoleStatus(roleId){
            let btn = $('tr#'+roleId+' button.item-status');
            $.ajax({
                "url": BASE_URL+'/Backend/roles/'+roleId+'/toggle-status',
                "dataType":"json",
                "type":"POST",
                "data":{"_token":CSRF_TOKEN},
                beforeSend:function(){
                    // removeRowFromTable(table,id);
                    // $form.addClass("sp-loading");
                },
                success:function(resp){
                    btn.removeClass('btn-success btn-danger').addClass(resp.class.btn_class);
                    btn.html(resp.class.btn_text);
                    toastr.success(resp.message)
                },
                error: function(xhr){
                    let obj = JSON.parse(xhr.responseText);
                    // showRowFromTable(table,id);
                    toastr.error(obj.message);
                    // $form.removeClass("sp-loading");
                }
            });
        }
    </script>
@endsection
