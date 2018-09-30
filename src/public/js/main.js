$(document).ready(function() {

    // Ask for popup confirmation before deleting data
    $('.del').on('click', function() {

        var formId = $(this).data('id');

        swal({
            title: "Are you sure?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },

        function(isConfirm){
            if(isConfirm) {

               $(`#${formId}`).submit();

            }  
        });
    });

});

