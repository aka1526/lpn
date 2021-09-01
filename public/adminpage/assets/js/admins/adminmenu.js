$(function() {
    'use strict'
    // showing modal with effect
    $('.modal-effect').on('click', function(e) {
        e.preventDefault();
        var effect = $(this).attr('data-effect');
        $('#modalmenu').addClass(effect);
    });
    // hide modal with effect
    $('#modalmenu').on('hidden.bs.modal', function(e) {
        $(this).removeClass(function(index, className) {
            return (className.match(/(^|\s)effect-\S+/g) || []).join(' ');
        });
    });

});

$(document).ready(function() {

});


$('.btn-new').on('click', function() {
    var url = "/pageadmin/menu/store";
    var data = $("#frmmenu").serialize();
    $("#frmmenu").attr('action', url);
    $("#frmmenu").attr('method', 'POST');
    $("#menu_status").val('Y');
});

$('.btn-save').on('click', function() {

    var uid = $(this).data('uid');
    var url = "/pageadmin/menu/store";
    var data = $("#frmmenu").serialize();
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function(data) {
            $('#modalmenu').modal('hide');

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

$('.btn-edit').on('click', function(e) {

    var uid = $(this).data('uid');
    var url = "/pageadmin/menu/" + uid + "/get";
    $('#btn-save').addClass('d-none');
    $('#btn-update').removeClass('d-none');
    $.ajax({
        type: "get",
        url: url,
        data: {
            uid: uid,
            "_token": $('meta[name=_token]').attr('content')
        },
        success: function(data) {
            //console.log(data);
            if (data.success) {
                var user = data.data;

                $("#frmmenu").attr('action', "/pageadmin/menu/update");
                $("#menu_uid").val(user.menu_uid);
                $("#menu_name").val(user.menu_name);
                $("#menu_name_th").val(user.menu_name_th);
                $("#menu_route").val(user.menu_route);
                $("#menu_url").val(user.menu_url);
                $("#menu_icon").val(user.menu_icon);
                $("#menu_class").val(user.menu_class);
                $("#menu_index").val(user.menu_index);
                $("#menu_main").val(user.menu_main);
                $("#menu_status").val(user.menu_status);

                $('#modalmenu').modal('show');
            }
        }
    });

});

$(".btn-update").click(function(e) {

    var url = "/pageadmin/menu/update";
    var data = $("#frmmenu").serialize();
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function(data) {
            $('#modalmenu').modal('hide');

            Swal.fire({
                title: 'Update Success.',
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
// $(".btn-edit").click(function() {

//     var uid = $(this).data('uid');
//     var url = "/pageadmin/menu/" + uid;


//     $.ajax({
//         type: 'GET',
//         url: url,
//         data: { uid: uid, "_token": $('meta[name=_token]').attr('content') },

//         success: function(data) {
//             $('#modalmenu').modal('hide');
//             if (data.success) {
//                 Swal.fire({
//                     title: 'Save Success.',
//                     text: "",
//                     icon: 'success',
//                     showCancelButton: false,
//                     timer: 1200,
//                     confirmButtonColor: '#3085d6',
//                     cancelButtonColor: '#d33',
//                 }).then(() => {
//                     location.reload();
//                 });

//             }

//         }
//     });

// });