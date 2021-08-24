$(function() {
    'use strict'
    // showing modal with effect
    $('.modal-effect').on('click', function(e) {
        e.preventDefault();
        var effect = $(this).attr('data-effect');
        $('#modaluser').addClass(effect);
    });
    // hide modal with effect
    $('#modaluser').on('hidden.bs.modal', function(e) {
        $(this).removeClass(function(index, className) {
            return (className.match(/(^|\s)effect-\S+/g) || []).join(' ');
        });
    });

});

$(document).ready(function() {

});

$('.btn-save').on('click', function() {
    //e.preventDefault();
    var form = $('#frmuser');
    var url = form.attr('action');

    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(),
        success: function(data) {
            $('#modaluser').modal('hide');

            Swal.fire({
                title: 'Save Success.',
                text: "",
                icon: 'success',
                showCancelButton: false,
                timer: 1200,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then(() => {
                location.reload();
            });

        },
        error: function(xhr, status, error) {
            var errMsg = '';
            $.each(xhr.responseJSON.errors, function(key, item) {
                errMsg += '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Error! </strong>' + item + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

            });

            $("#errors").append(errMsg);
        }

    });
});

$('#msg').on('click', function() {
    Swal.fire(
        'The Internet?',
        'That thing is still around?',
        'question'
    )
});

$('.close').on('click', function() {
    location.reload();
});