$(function() {
    'use strict'
    // showing modal with effect
    $('.modal-effect').on('click', function(e) {
        e.preventDefault();

        var effect = $(this).attr('data-effect');
        $('#formModal').addClass(effect);
    });
    // hide modal with effect
    $('#formModal').on('hidden.bs.modal', function(e) {
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

$(document).ready(function() {

});




$('.btn-edit').on('click', function(e) {
    var uid = $(this).data('uid');
    var url = "/pageadmin/news/catalog/edit/";
    var effect = $(this).attr('data-effect');
    e.preventDefault();
    $.ajax({
        type: "get",
        url: url,
        data: { uid: uid, "_token": $('meta[name=_token]').attr('content') },
        success: function(data) {
            //console.log(data.data);
            if (data.success) {
                var res = data;
                $("#formdata").html(res.data);
                // $("#course_index").val(course.course_index);
                // $("#course_name").val(course.course_name);
                // $("#course_description").val(course.course_description);
                // $("#course_status").val(course.course_status);
                // $("#course_icon").val(course.course_icon);

                $('#formModal').modal('show');
            }
        }
    });
});



$('.btn-new').on('click', function(e) {
    var uid = $(this).data('uid');
    var url = "/pageadmin/news/catalog/new";
    var effect = $(this).attr('data-effect');
    e.preventDefault();
    $.ajax({
        type: "get",
        url: url,
        data: { uid: uid, "_token": $('meta[name=_token]').attr('content') },
        success: function(data) {
            //console.log(data.data);
            if (data.success) {
                var res = data;
                $("#formdata").html(res.data);
                // $("#course_index").val(course.course_index);
                // $("#course_name").val(course.course_name);
                // $("#course_description").val(course.course_description);
                // $("#course_status").val(course.course_status);
                // $("#course_icon").val(course.course_icon);

                $('#formModal').modal('show');
            }
        }
    });
});


$('.btn-disable').on('click', function() {


    var uid = $(this).data('uid');
    var status = $(this).data('status');
    var url = "/pageadmin/news/catalog/updatestatus";

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

$(document).on('click', '.btn-close', function() {

    location.reload();
});
$('.btn-delete').on('click', function() {

    var uid = $(this).data('uid');
    var url = "/pageadmin/news/catalog/delete";
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



$(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
});

// We can watch for our custom `fileselect` event like this
$(document).ready(function() {
    $(':file').on('fileselect', function(event, numFiles, label) {

        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;

        if (input.length) {
            input.val(log);
        } else {
            if (log) alert(log);
        }

    });
});