<script>
    function deleteRole(id,redirect = false)
    {
        let table = 'roleDatatable';
        let action = BASE_URL+"/Backend/roles/"+id;
        $.ajax({
            "url": action,
            "dataType":"json",
            "type":"DELETE",
            "data":{"_token":CSRF_TOKEN},
            beforeSend:function(){
                removeRowFromTable(table,id);
                // $form.addClass("sp-loading");
            },
            success:function(resp){
                toastr.success(resp.message)
                if(redirect){
                    window.href.location = "{{route('roles.index')}}"
                }
            },
            error: function(xhr){
                let obj = JSON.parse(xhr.responseText);
                showRowFromTable(table,id);
                toastr.error(obj.message);
                // $form.removeClass("sp-loading");
            }
        });
        // $('#globalConfirmDelete').attr('action', action).submit();
    }
</script>
