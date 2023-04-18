<script>
    function deleteRole(id,redirect = false)
    {
        let table = 'roleDatatable';
        let action = BASE_URL+"/dashboard/roles/"+id;
        $.ajax({
            "url": action,
            "dataType":"json",
            "type":"DELETE",
            "data":{"_token":CSRF_TOKEN},
            beforeSend:function(){
                removeRowFromTable(table,id);
            },
            success:function(resp){
                if(redirect){
                    alertifySuccessAndRedirect(resp.message, "{{route('roles.index')}}");
                }else{
                    alertifySuccess(resp.message);
                }
            },
            error: function(xhr){
                let obj = JSON.parse(xhr.responseText);
                showRowFromTable(table,id);
                alertifyError(obj.message);
            }
        });
        $('#globalConfirmDelete').attr('action', action).submit();
    }
</script>
