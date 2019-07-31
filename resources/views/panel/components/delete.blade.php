<script>
    $('.delete-item').on('click',function(event) {

        event.preventDefault();
        event.stopPropagation();

        var id = $(this).attr('aria-id');
        var form = $(this).parent();

        swal({   
            title: "مطمین هستید ؟",   
            text: "برای پاک کردن داده مورد نظر مطمین هستید ؟",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#f83f37",   
            confirmButtonText: "بله",   
            cancelButtonText: "خیر", 
        }, function(isConfirm){   
            if (isConfirm) {
                form.submit();
            }
        });
        
        return false;
    });
</script>