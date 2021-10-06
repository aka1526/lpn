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

$(document).ready(function() {

    try {
        $('.select2').select2({
            placeholder: 'Choose one',
            searchInputPlaceholder: 'Search'
        });
        $('.select2-no-search').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Choose one'
        });
    } catch (e) {

    }

});

$(document).on('click', '.btn-save2', function() {

    //$('.btn-save').on('click', function() {
    //e.preventDefault();
    var form = $('#frm');
    var url = "/pageadmin/course/add";
    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(),
        success: function(data) {
            $('#modalcourse').modal('hide');

            Swal.fire({
                title: 'Save Success.',
                text: "",
                icon: 'success',
                showCancelButton: false,
                timer: 1200,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then(() => {
                //location.reload();
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

$(document).on('click', '.btn-edit', function() {
    var uid = $(this).data('uid');
    var url = "/pageadmin/course/get";
    // $("#modalcourse").attr('action', url);
    // $("#btn-save").removeClass('btn-save').addClass('btn-update');
    var effect = $(this).attr('data-effect');

    $.ajax({
        type: "get",
        url: url,
        data: { uid: uid, "_token": $('meta[name=_token]').attr('content') },
        success: function(data) {

            if (data.success) {
                var course = data.data;
                $("#course_uid").val(course.course_uid);
                $("#course_index").val(course.course_index);
                $("#course_name").val(course.course_name);
                $("#course_description").val(course.course_description);
                $("#course_status").val(course.course_status);
                $("#course_icon").val(course.course_icon);

                $('#modalcourse').modal('show');
            }
        }
    });

});



//$('.btn-update').on('click', function() {
$(document).on('click', '.btn-update2', function() {
    var uid = $(this).data('uid');
    var url = "/pageadmin/course/update";
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
                    location.reload();
                });

            }

        }
    });

});




$('.btn-disable').on('click', function() {
    var uid = $(this).data('uid');
    var status = $(this).data('status');
    var url = "/pageadmin/members/prosonal/status";

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


$('.btn-close').on('click', function() {
    location.reload();
});

$('.btn-delete').on('click', function() {

    var uid = $(this).data('uid');
    var url = "/pageadmin/members/prosonal/delete";
    var mtext = 'Yes, Delete it!';

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to Delete this!",
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





$(document).on('click', '.btn-search', function() {
    var search = $('#search').val();
    location.href = "/pageadmin/halloffame?search=" + search; //redirection

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

$(document).on('click', '#print_card', function() {

    //$("#print_card").on("click", function(e) {
    var img = $(this).data('img');
    if (img != '') {
        var win = window.open('', '', 'left=300,top=200,width=700,height=400,toolbar=0,scrollbars=0,status  =0');
        win.document.write('<img src="' + img + '" onload="window.print();window.close()" />');
        win.focus();
    } else {

        alert('No Image');
    }

});