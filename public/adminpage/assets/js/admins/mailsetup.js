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

    // Datepicker

    try {
        $('#news_datetime').datetimepicker({
            format: 'yyyy-mm-dd hh:ii',
            autoclose: true
        });
    } catch (e) {

    }

});

$(document).on('click', '.btn-search', function() {
    var search = $('#search').val();
    location.href = "/pageadmin/mailsetup?search=" + search; //redirection

});

$(document).on('click', '.btn-mail', function(e) {
    e.preventDefault();
    var uid = $(this).data('uid');
    var url = "/pageadmin/mailsetup/mailtest";
    $.ajax({
        type: "get",
        url: url,
        data: { uid: uid, "_token": $('meta[name=_token]').attr('content') },
        success: function(data) {
            Swal.fire({
                title: 'Send Mail Test Success.',
                text: "",
                icon: 'success',
                showCancelButton: false,
                timer: 1200,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
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


$('.btn-disable').on('click', function() {


    var uid = $(this).data('uid');
    var status = $(this).data('status');
    var url = "/pageadmin/mailsetup/status";

    if (status == 'Y') {
        var mtext = 'Yes, Enable it!';
    } else {

        var mtext = 'Yes, Disable it!';

    }


    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to Disable this!",
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
    var url = "/pageadmin/mailsetup/delete";
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
    });


});

$('.sendmail-subscribe').on('click', function(e) {
    e.preventDefault();
    var emailtest = $("#emailtest").val();
    if (emailtest == '') {
        Swal.fire({
            title: 'Please input E-mail!!',
            icon: 'warning',
            showCancelButton: false,
            timer: 1200,
        }).then((result) => {
            $("#emailtest").focus();
        });
    }



    var uid = $(this).data('uid');
    var mailto = $("#emailtest").val();
    var mail_subject = $("#mail_subject").val();
    var msg_subscribe = $("#msg_subscribe").val();

    var url = "/pageadmin/mailsubscribe/test";
    $.ajax({
        type: "post",
        url: url,
        data: {
            uid: uid,
            mailto: mailto,
            mail_subject: mail_subject,
            msg_subscribe: msg_subscribe,
            "_token": $('meta[name=_token]').attr('content')
        },
        success: function(data) {
            Swal.fire({
                title: 'Send Mail Test Success.',
                text: "",
                icon: 'success',
                showCancelButton: false,
                timer: 1200,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
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



$('.btn-status-subscribe').on('click', function(e) {

    e.preventDefault();
    var uid = $(this).data('uid');
    var status = $(this).data('status');
    var url = "/pageadmin/mailsubscribe/status";

    if (status == 'Y') {
        var mtext = 'Yes, Enable it!';
    } else {

        var mtext = 'Yes, Disable it!';

    }


    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to Disable this!",
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

$('.btn-delete-subscribe').on('click', function() {

    var uid = $(this).data('uid');
    var url = "/pageadmin/mailsubscribe/delete";
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
    });


});