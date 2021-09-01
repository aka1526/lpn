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

$('.btn-edit').on('click', function() {
    var uid = $(this).data('uid');
    var url = "/pageadmin/getuser";

    $.ajax({
        type: "get",
        url: url,
        data: { uid: uid, "_token": $('meta[name=_token]').attr('content') },
        success: function(data) {

            if (data.success) {
                var user = data.data;
                $("#_uid").val(user.uid);
                $("#_name").val(user.name);
                $("#_email").val(user.email);

                $('#modalusershow').modal('show');
            }
        }
    });

});



$('.btn-update').on('click', function() {
    var uid = $(this).data('uid');
    var url = "/pageadmin/user/update";
    var data = $("#frmusershow").serialize();
    $("#frmusershow").attr('action', url);

    $.ajax({
        type: "post",
        url: url,
        data: data,
        success: function(data) {
            $('#modalusershow').modal('hide');
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
                    location.reload();
                });

            }

        }
    });

});

$('.btn-pwd').on('click', function() {
    var uid = $(this).data('uid');
    var url = "/pageadmin/getuser";

    $.ajax({
        type: "get",
        url: url,
        data: { uid: uid, "_token": $('meta[name=_token]').attr('content') },
        success: function(data) {

            if (data.success) {
                var user = data.data;
                $("#pwd_uid").val(user.uid);
                $("#pwd_name").val(user.name);
                $('#modaluserpwd').modal('show');
            }
        }
    });

});

$('.btn-editpwd').on('click', function() {
    var uid = $(this).data('uid');
    var url = "/pageadmin/user/updatepwd";
    var data = $("#frmuserpwd").serialize();
    $("#frmuserpwd").attr('action', url);

    $.ajax({
        type: "post",
        url: url,
        data: data,
        success: function(data) {

            if (data.success) {

                $('#modaluserpwd').modal('hide');
                Swal.fire({
                    title: 'Password Cahange Success.',
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
        },
        error: function(xhr, status, error) {
            var errMsg = '';
            $.each(xhr.responseJSON.errors, function(key, item) {
                errMsg += '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Error! </strong>' + item + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

            });

            $("#pwderrors").append(errMsg);
        }
    });

});



$('.btn-disable').on('click', function() {
    var uid = $(this).data('uid');
    var status = $(this).data('status');
    var url = "/pageadmin/user/updatestatus";
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
    var url = "/pageadmin/user/delete";
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