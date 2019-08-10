<script>
    $('.delete-item').on('click',function(event) {

        event.preventDefault();
        event.stopPropagation();

        var id = $(this).attr('aria-id');
        var tr = $(this).parent().parent().parent().parent()

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

                fetch('/panel/{{ $type }}/' + id, {
                    method: 'post',
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        _method: 'delete'
                    })
                })
                .then(function(response) {

                    tr.fadeOut(400, function() {

                        tr.remove()
                    })
                })
            }
        });
        
        return false;
    });
</script>