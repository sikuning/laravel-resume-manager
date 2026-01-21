$(function () {
    var uRL = $('.demo').val();
    //alert(uRL);
 
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
 
    $('.modal').on('hidden.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });

    $('.change-logo').click(function () {
        $('.change-com-img').click();
    });
 
    // delete data common function
    function destroy_data(name, url) {
        var el = name;
        var id = el.attr('data-id');
        var dltUrl = url + id;
        if (confirm('Are you Sure Want to Delete This')) {
            $.ajax({
                url: dltUrl,
                type: "DELETE",
                cache: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        el.parent().parent('tr').remove();
                    } else {
                        Toast.fire({
                            icon: 'danger',
                            title: dataResult
                        })
                    }
                }
            });
        }
    }
 
    function show_formAjax_error(data) {
        if (data.status == 422) {
            $('.error').remove();
            $.each(data.responseJSON.errors, function (i, error) {
                var el = $(document).find('[name="' + i + '"]');
                el.after($('<span class="error">' + error[0] + '</span>'));
            });
        }
    }
 
    // ========================================
    // script for Admin Login
    // ========================================

    $('#adminLogin').validate({
        rules: {
            username: { required: true },
            password: { required: true }
        },
        messages: {
            username: { required: "Username is required" },
            password: { required: "Pasword is required" }
        },
        submitHandler: function (form) {
            var url = $('.url').val();
            var formdata = new FormData(form);
            $.ajax({
                url: uRL,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Logged In Succesfully.'
                        })
                        setTimeout(function(){
                            window.location.href = url+'/admin/dashboard';
                        }, 500);
                    } else {
                        $.each(dataResult, function (i, error) {
                            var el = $(document).find('[name="' + i + '"]').css('border-color','red');
                            Toast.fire({
                                icon: 'error',
                                title: error
                            })
                        });
                    }
                }
            });
        }
    });
    
    // ========================================
    // script for Admin Logout
    // ========================================

    $('.admin-logout').click(function () {
        $.ajax({
            url: uRL + '/admin/logout',
            type: "GET",
            cache: false,
            success: function (dataResult) {
               // console.log(dataResult);
                if (dataResult == '1') {
                    setTimeout(function () {
                        window.location.href = uRL + '/admin';
                    }, 500);
                    Toast.fire({
                        icon: 'success',
                        title: 'Logged Out Succesfully.'
                    })
                }
            }
        });
    });
 
     // ========================================
    // script for Service module
    // ========================================

    $('#addService').validate({
        rules: {
            title:{ required: true },
              des:{ required: true },
        },
        messages: {
            title: { required: "Please Enter Service Title Name" }, 
            des: { required: "Please Enter Service Description" }, 
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/services',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Added Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/services'; }, 1000)
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $('#updateService').validate({
        rules: {
            title:{ required: true },
            des:{ required: true },
            status: { required: true },
        },
        messages: {
            title: { required: "Please Enter Service Title Name" }, 
            des: { required: "Please Enter Service Description" }, 
            status: { required: "Please Enter Status" },
        },
        submitHandler: function (form) {
            var id = $('.url').val();
            var formdata = new FormData(form);
            $.ajax({
                url: id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/services'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on("click", ".delete-service", function () {
        destroy_data($(this), 'services/')
    });

    // ========================================
    // script for Blog Category module
    // ========================================

    $('#addCategory').validate({
        rules: { title: { required: true }, },
        messages: { title: { required: "Please Enter Blog Category Name" }, },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/category',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        $('#modal-default').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: 'Added Succesfully.'
                        });
                        setTimeout(function () { window.location.reload(); }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on('click', '.editCategory', function () {
        var id = $(this).attr('data-id');
        var dltUrl = 'category/' + id + '/edit';
        $.ajax({
            url: dltUrl,
            type: "GET",
            cache: false,
            success: function (dataResult) {
                $('#modal-info input[name=id]').val(dataResult[0].id);
                $('#modal-info input[name=title]').val(dataResult[0].title);
                $('#modal-info input[name=slug]').val(dataResult[0].slug);
                $('#modal-info input[name=status]').val(dataResult[0].status);
                $("#modal-info select[name=status] option").each(function () {
                    if ($(this).val() == dataResult[0].status) {
                        $(this).attr('selected', true);
                    }
                });
                $('#modal-info .u-url').val($('#modal-info .u-url').val() + '/' + dataResult[0].id);
                $('#modal-info').modal('show');

            }
        });
    });

    $("#editCategory").validate({
        rules: {
            title: { required: true },
            slug: { required: true },
        },
        messages: {
            title: { required: "Please Enter Blog Category Name" },
            slug: { required: "Please Enter Blog Category Slug" },
        },
        submitHandler: function (form) {
            var id = $('#modal-info input[name=id]').val();
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/category' + '/' + id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        $('#modal-info').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.reload(); }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on("click", ".delete-category", function () {
        destroy_data($(this), 'category/')
    });

    // ========================================
    // script for Blog module
    // ========================================
    
    $('#addBlog').validate({
        rules: {
            title: { required: true },
            short_des: { required: true },
            category: { required: true },
            tags: { required: true },
        },
        messages: {
            title: { required: "Please Enter Blog Title Name" },
            short_des: { required: "Please Enter Short Description" },
            category: { required: "Please Enter Blog Category Name" },
            tags: { required: "Please Enter Blog Tags Name" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/blogs',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Added Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/blogs'; }, 1000)
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $('#updateBlog').validate({
        rules: {
            title: { required: true },
            description: { required: true },
            category: { required: true },
            tags: { required: true },
            status: { required: true },
        },
        messages: {
            title: { required: "Please Enter Blog Title Name" },
            description: { required: "Please Enter Blog Description" },
            category: { required: "Please Enter Blog Category Name" },
            tags: { required: "Please Enter Blog Tags Name" },
            status: { required: "Please Enter Blog Status" }, 
        },
        submitHandler: function (form) {
            var id = $('.url').val();
            var formdata = new FormData(form);
            $.ajax({
                url: id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/blogs'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on("click", ".delete-blog", function () {
        destroy_data($(this), 'blogs/')
    });


    // ========================================
    // script for Page module
    // ========================================

    $('#addPage').validate({
        rules: { title: { required: true }, },
        messages: { title: { required: "Please Enter Page Title Name" }, },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/pages',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Added Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/pages'; }, 1000)
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $('#EditPage').validate({
        rules: { title: { required: true }, },
        messages: { title: { required: "Please Enter Page Title Name" }, },
        submitHandler: function (form) {
            var id = $('.url').val();
            var formdata = new FormData(form);
            $.ajax({
                url: id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/pages'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on("click", ".delete-page", function (){
        destroy_data($(this), 'pages/')
    });

    $(document).on('click','.show-in-header',function(){
        var id = $(this).attr('id');
        if($('#'+id).is(':checked')){
           var status = 1;
        }else{
            var status = 0;
        }
        id = id.replace('head','');
        $.ajax({
            url: uRL + '/admin/page_showIn_header', 
            type: 'POST',
            data: {id:id,status:status},
            success: function (dataResult) {
            }

        });
    })

    $(document).on('click','.show-in-footer',function(){
        var id = $(this).attr('id');
        if($('#'+id).is(':checked')){
           var status = 1;
        }else{
            var status = 0;
        }
        id = id.replace('foot','');
        $.ajax({
            url: uRL + '/admin/page_showIn_footer',
            type: 'POST',
            data: {id:id,status:status},
            success: function (dataResult) {
            }
        });
    })
    
    // ========================================
    // script for General Setting module
    // ========================================

    $('#updateGeneralSetting').validate({
        rules: {
            com_name: { required: true },
            com_email: { required: true },
            address: { required: true },
            phone: { required: true },
            description: { required: true },
            map: { required: true },
            discount: { required: true },
            f_address: { required: true },
        },
        messages: {
            com_name: { required: "Company Name is Required" },
            com_email: { required: "Company Email is Required" },
            address: { required: "Company Address is Required" },
            phone: { required: "Company Phone is Required" },
            description: { required: "Company Description is Required" },
            map: { required: "Company Map is Required" },
            discount: { required: "Company Booking Amount Discount is Required" },
            f_address: { required: "Company Footer Address is Required" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/general-settings',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.',
                        });
                        setTimeout(function () { 
                           // $('.loader-container').remove();
                            window.location.href = uRL + '/admin/general-settings'; }, 1000);
                    }else if (dataResult == '0') {
                        Toast.fire({
                            icon: 'info',
                            title: 'Already Updated.',
                        });
                    }
                },
                error: function (error) {
                    $('.loader-container').remove();
                    show_formAjax_error(error);
                }
            });
        }
    });

    // ========================================
    // script for Admin  module
    // ========================================

    $('#updateProfileSetting').validate({
        rules: {
            admin_name: { required: true },
            email: { required: true },
            username: { required: true },
        },
        messages: {
            admin_name: { required: "Please Enter Your Username" },
            email: { required: "Please Enter Email Address" },
            username: { required: "Please Enter Email Address" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/profile-settings',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/profile-settings'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

     

    // ========================================
    // script for Social Links  module
    // ========================================

    $('#updateSocialSetting').validate({
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/social-settings',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/social-settings'; }, 1000);
                    }else if (dataResult == '0') {
                        Toast.fire({
                            icon: 'info',
                            title: 'Already Updated.'
                        });
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    // ========================================
    // script for Banner Settings
    // ========================================

    $('#updateBannerSetting').validate({
        rules: {
            title: { required: true },
            sub_title: { required: true },
        },
        messages: {
            title: { required: "Title is Required" },
            sub_title: { required: "Sub Title is Required" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/banner-settings',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/banner-settings'; }, 1000);
                    }else if (dataResult == '0') {
                        Toast.fire({
                            icon: 'info',
                            title: 'Already Updated.'
                        });
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    // ========================================
    // script for Change Password
    // ========================================

    $('#updatePassword').validate({
        rules: {
            password: { required: true },
            new: { required: true },
            new_confirm: { required: true,equalTo: '#password' },
        },
        submitHandler: function (form) {
            var id = $('.url').val();
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/change-password',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/profile-settings'; }, 1000);
                    }else{
                        Toast.fire({
                            icon: 'error',
                            title: dataResult
                        });
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

     // ========================================
    // script for Page module
    // ========================================
    $('#addPage').validate({
           rules: { title: { required: true }, },
        messages: { title: { required: "Please Enter Page Title Name" }, },
        submitHandler: function (form) {
            var url = $('.url').val();
            var formdata = new FormData(form);
            $.ajax({
                url: url,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                   // console.log(dataResult);
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Page Added Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/pages'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $('#updatePage').validate({
        rules: {
            page_title: { required: true },
        },
        messages: {
            page_title: { required: "Please Enter Page Title Name" },
        },

        submitHandler: function (form) {
            var id = $('.url').val();
            var formdata = new FormData(form);
            $.ajax({
                url: id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Page Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/pages'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on("click", ".delete-page", function (){
        destroy_data($(this), 'pages/')
    });

    $(document).on('click','.show-in-header',function(){
        var id = $(this).attr('id');
        if($('#'+id).is(':checked')){
           var status = 1;
        }else{
            var status = 0;
        }
        id = id.replace('head','');
        $.ajax({
            url: uRL + '/admin/page_showIn_header',
            type: 'POST',
            data: {id:id,status:status},
            success: function (dataResult) {
            }
        });
    })

    $(document).on('click','.show-in-footer',function(){
        var id = $(this).attr('id');
        if($('#'+id).is(':checked')){
           var status = 1;
        }else{
            var status = 0;
        }
        id = id.replace('foot','');
        $.ajax({
            url: uRL + '/admin/page_showIn_footer',
            type: 'POST',
            data: {id:id,status:status},
            success: function (dataResult) {
            }
        });
    })

    $(document).on('click', '.viewContact', function () {
        $('#modal-info').modal('show');
        var id = $(this).attr('data-id');
        $.ajax({
            url: uRL + '/admin/contact/'  + id,
            type: 'POST',
            success: function (dataResult) {
                console.log(dataResult);
                $('#modal-info .table').html(dataResult);
            },
        });
    });

    $(document).on('click','.changeUserStatus',function(){
        var id = $(this).attr('data-id');
        var status = $(this).attr('data-status');
        $.ajax({
            url: uRL + '/admin/change-user-status',
            type: 'POST',
            data: {id:id,status:status},
            success: function (dataResult) {
                if (dataResult == '1') {
                    Toast.fire({
                        icon: 'success',
                        title: 'Status Changes Successfully.'
                    });
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000)
                }
            },
            error: function (error) {
                show_formAjax_error(error);
            }
        });
    });
});