$(function() {
    'use strict'
    // showing modal with effect
    $('.modal-effect').on('click', function(e) {
        e.preventDefault();

        var effect = $(this).attr('data-effect');
        $('#modalcourse').addClass(effect);
    });
    // hide modal with effect
    $('#modalcourse').on('hidden.bs.modal', function(e) {
        $(this).removeClass(function(index, className) {
            return (className.match(/(^|\s)effect-\S+/g) || []).join(' ');
        });
    });

});

$(document).ready(function() {

});


$(document).on('click', '.btn-save', function() {

    //$('.btn-save').on('click', function() {
    //e.preventDefault();
    var form = $('#frm');
    var url = "/pageadmin/course/items/new";
    var _details = CKEDITOR.instances.course_details.getData();

    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize() + "&course_details=" + _details,
        success: function(data) {

            Swal.fire({
                title: 'Save Success.',
                text: "",
                icon: 'success',
                showCancelButton: false,
                timer: 1200,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then(() => {
                var course = data.data;
                location.href = "/pageadmin/course/items/" + course.courseuid;
            });

        },
        error: function(xhr, status, error) {
            var errMsg = '';
            $("#errors").append(errMsg);
            $.each(xhr.responseJSON.errors, function(key, item) {
                errMsg += '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Error! </strong>' + item + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

            });

            $("#errors").append(errMsg);
        }

    });
});



$('.btn-update').on('click', function() {
    var url = "/pageadmin/course/items/update";
    var data = $("#frm").serialize();

    $.ajax({
        type: "post",
        url: url,
        data: data,
        success: function(data) {
            $('#modalcourse').modal('hide');
            if (data.success) {
                Swal.fire({
                    title: 'Save Success.',
                    text: "",
                    icon: 'success',
                    showCancelButton: false,
                    timer: 1200,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                }).then(() => {
                    var course = data.data;

                    location.href = "/pageadmin/course/items/" + course.courseuid;

                });

            }

        }
    });

});




$('.btn-disable').on('click', function() {
    var uid = $(this).data('uid');
    var status = $(this).data('status');
    var url = "/pageadmin/course/items/status";
    if (status == 'Y') {
        var mtext = 'Yes, Enable it!';
    } else {
        var mtext = 'Yes, Disable it!';
    }


    Swal.fire({
        title: 'Are you sure?',
        // text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: mtext
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "post",
                url: url,
                data: { uid: uid, status: status, "_token": $('meta[name=_token]').attr('content') },
                success: function(data) {

                    if (data.success) {

                        Swal.fire({
                            title: 'Update Status Success.',
                            text: "",
                            icon: 'success',
                            showCancelButton: false,
                            timer: 1200,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                        }).then(() => {
                            location.reload();
                        });
                    }
                }

            });
        }
    })

});


$('.btn-delete').on('click', function() {
    var uid = $(this).data('uid');
    var url = "/pageadmin/course/items/delete";
    var mtext = 'Yes, Delete it!';

    Swal.fire({
        title: 'Are you sure?',
        // text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: mtext
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "post",
                url: url,
                data: { uid: uid, "_token": $('meta[name=_token]').attr('content') },
                success: function(data) {

                    if (data.success) {

                        Swal.fire({
                            title: 'Delete  Success.',
                            text: "",
                            icon: 'success',
                            showCancelButton: false,
                            timer: 1200,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                        }).then(() => {
                            location.reload();
                        });
                    }
                }

            });
        }
    })

});

$('.bt-close').on('click', function() {
    window.history.back();

});