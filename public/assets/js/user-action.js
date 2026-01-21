$(function () {
    var uRL = $('.site-url').val();
//    alert(uRL);

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
    // script for User Logout
    // ========================================

    $('.user-logout').click(function () {
        $.ajax({
            url: uRL + '/user/logout',
            type: "GET",
            cache: false,
            success: function (dataResult) {
                if (dataResult == '1') {
                    setTimeout(function () {
                        window.location.href = uRL;
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
                url: uRL + '/user/services',
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
                        setTimeout(function () { window.location.href = uRL + '/user/services'; }, 1000)
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
                        setTimeout(function () { window.location.href = uRL + '/user/services'; }, 1000);
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
    // script for Skill module
    // ========================================

    $('#addSkill').validate({
        rules: { 
            title: { required: true }, 
            percent: { required: true }, 
        },
        messages: { title: { required: "Please Enter Skill Name" }, },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/user/skill',
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

    $(document).on('click', '.editSkill', function () {
        var id = $(this).attr('data-id');
        var dltUrl = 'skill/' + id + '/edit';
        $.ajax({
            url: dltUrl,
            type: "GET",
            cache: false,
            success: function (dataResult) {
                $('#modal-info input[name=id]').val(dataResult[0].id);
                $('#modal-info input[name=title]').val(dataResult[0].title);
                $('#modal-info input[name=percent]').val(dataResult[0].percent);
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

    $("#editSkill").validate({
        rules: {
            title: { required: true },
            percent: { required: true },
        }, 
        messages: { title: { required: "Please Enter Skill Name" }, },
        submitHandler: function (form) {
            var id = $('#modal-info input[name=id]').val();
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/user/skill' + '/' + id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
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

    $(document).on("click", ".deleteSkill", function () {
        destroy_data($(this), 'skill/')
    });

     // ========================================
    // script for Experience module
    // ========================================
    $('#addExperience').validate({
        rules: { 
            title: { required: true }, 
            company: { required: true }, 
            from_year: { required: true }, 
        },
        messages: { 
            title: { required: "Desigation is required" }, 
            company: { required: "Company Name is required" }, 
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/user/experience',
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
                        setTimeout(function () { window.location.href = uRL + '/user/experience'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $('#updateExperience').validate({
        rules: {
            title: { required: true }, 
            company: { required: true }, 
            from_year: { required: true }, 
            status: { required: true },
        },
        messages: {
            title: { required: "Designation is required" }, 
            company: { required: "Company Name is required" }, 
            status: { required: "Select Status" },
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
                        setTimeout(function () { window.location.href = uRL + '/user/experience'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on("click", ".delete-experience", function () {
        destroy_data($(this), 'experience/')
    });

    // ========================================
    // script for Testimonial module
    // ========================================

    $('#addTestimonial').validate({
        rules: {
            client_name:{ required: true },
            des:{ required: true },
        },
        messages: {
            client_name: { required: "Client Name is required" }, 
            des: { required: "Feedback is required" }, 
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/user/testimonial',
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
                        setTimeout(function () { window.location.href = uRL + '/user/testimonial'; }, 1000)
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $('#updateTestimonial').validate({
        rules: {
            title:{ required: true },
            des:{ required: true },
            status: { required: true },
        },
        messages: {
            title: { required: "Please Enter Testimonial Title Name" }, 
            des: { required: "Please Enter Testimonial Feedback" }, 
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
                        setTimeout(function () { window.location.href = uRL + '/user/testimonial'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on("click", ".delete-testimonial", function () {
        destroy_data($(this), 'testimonial/')
    });

    // ========================================
    // script for Category module
    // ========================================

    $('#addCategory').validate({
        rules: { title: { required: true }, },
        messages: { title: { required: "Please Enter Category Name" }, },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/user/category',
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
                //console.log(dataResult);
                $('#modal-info input[name=id]').val(dataResult[0].id);
                $('#modal-info input[name=title]').val(dataResult[0].title);
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
        rules: { title: { required: true }, },
        messages: { title: { required: "Please Enter Category Name" }, },
        submitHandler: function (form) {
            var id = $('#modal-info input[name=id]').val();
           // alert(id);
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/user/category' + '/' + id,
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
    // script for Portfolio module
    // ========================================

    $('#addPortfolio').validate({
        rules: {
            title:{ required: true },
            link:{ required: true },
            category:{ required: true },
        },
        messages: {
            title: { required: "Please Enter Portfolio Title" }, 
            link: { required: "Please Enter Project Link" }, 
            category: { required: "Please Select Portfolio Category" }, 
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/user/portfolio',
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
                        setTimeout(function () { window.location.href = uRL + '/user/portfolio'; }, 1000)
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $('#updatePortfolio').validate({
        rules: {
            title:{ required: true },
            link:{ required: true },
            category:{ required: true },
            status: { required: true },
        },
        messages: {
            title: { required: "Please Enter Portfolio Title" }, 
            link: { required: "Please Enter Project Link" }, 
            category: { required: "Please Select Portfolio Category" }, 
            status: { required: "Please Select Status" },
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
                        setTimeout(function () { window.location.href = uRL + '/user/portfolio'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on("click", ".delete-portfolio", function () {
        destroy_data($(this), 'portfolio/')
    });


    // ========================================
    // script for User Profile  module
    // ========================================
    $('.user-link').keyup(function(){
        var val = $(this).val();
        $.ajax({
            url: uRL + '/user/check-user-slug',
            type: 'POST',
            data: {slug:val},
            success: function (dataResult) {
                if (dataResult == '1') {
                    $('button[type=submit]').attr('disabled',true);
                    $('.exist').html('<span class="text-danger">Already Exists. Try Another.</span>');
                }else{
                    $('button[type=submit]').attr('disabled',false);
                    $('.exist').html('<span class="text-success">Available!!.</span>');
                }
            },
        });
    });



    $('#updateUserProfile').validate({
        rules: {
            username: { required: true },
            designation: { required: true },
            email: { required: true },
            phone: { required: true },
            country: { required: true },
        },
        messages: {
            username: { required: "Please Enter Your Username" },
            designation: { required: "Please Enter Username Designation" },
            email: { required: "Please Enter Username Email" },
            phone: { required: "Please Enter Username Phone Number" },
            country: { required: "Please Enter User Country Name" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/user/edit-profile',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                   console.log(dataResult);
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/user/my-profile'; }, 1000);
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
    
    $('#updateUserPassword').validate({
        rules: {
            password: { required: true },
            new: { required: true },
            new_confirm: { required: true,equalTo: '#password' },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/user/change-password',
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
                        setTimeout(function () { window.location.href = uRL + '/user/my-profile'; }, 1000);
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
    // script for Preferences module
    // ========================================

    $(document).on('click','.show-in-status',function(){
        var id = $(this).attr('id');
        if($('#'+id).is(':checked')){
           var status = 1;
        }else{
            var status = 0;
        }
        id = id.replace('p','');
        $.ajax({
            url: uRL + '/user/page_showIn_status', 
            type: 'POST',
            data: {id:id,status:status},
            success: function (dataResult) {
            }

        });
    })

     // ========================================
    // script for Social Setting
    // ========================================

    $('#addUserSocial').validate({
        rules: {
            title: {required: true},
            url: {required: true},
            icon: {required: true},
            status: {required: true}
        },
        messages: {
           title: {required: "Please Enter Social Setting Name"},
            url: {required: "Please Enter Social Setting url Name"},
            icon: {required: "Please Enter Social Setting Icon"},
            status: {required: "Please Enter Social Setting Status"},
        },
        submitHandler: function(form){
            var formdata = new FormData(form);
            $.ajax({
                url: uRL+'/user/social-settings',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function(dataResult){
                    console.log(dataResult);
                    if(dataResult == '1'){
                        Toast.fire({
                            icon: 'success',
                            title: 'Added Successfully.'
                        });
                        setTimeout(function(){ window.location.href = uRL+'/user/social-settings';}, 1000);
                    }
                },
                error: function(error){
                    show_formAjax_error(error);
                }
            });
        }
    });

    $('#updateUsersocial').validate({
        rules: {
            title: {required: true},
            url: {required: true},
            icon: {required: true},
            status: {required: true}
        },
        messages: {
            title: {required: "Please Enter Social Setting Name"},
            url: {required: "Please Enter Social Setting url Name"},
            icon: {required: "Please Enter Social Setting Icon"},
            status: {required: "Please Enter Social Setting Status"},
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
                        setTimeout(function () { window.location.href = uRL + '/user/social-settings'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on("click", ".delete-userSocial", function() {
        destroy_data($(this),'social-settings/')
    });

    $(document).on('click', '.select-layout', function () {
        var layout = '';
        $('.select-layout').each(function(i){
            if($(this).prop('checked') == true){
                layout = $(this).val();
            }
        });
        // alert(layout);
        $.ajax({
            url: uRL + '/user/layouts',
            type: 'POST',
            data: {layout:layout},
            success: function (dataResult) {
                // console.log(dataResult);
                if(dataResult == '1'){
                    Toast.fire({
                        icon: 'success',
                        title: 'Updated Succesfully.'
                    });
                }else{
                    Toast.fire({
                        icon: 'warning',
                        title: dataResult
                    });
                }
            },
        });
    });

    


    $('.save-preference-order').on('click',function(){
        var list = [];
        $('.preference-list li').each(function(i){
            list[i] = $(this).attr('data-id');
        });
        $.ajax({
            url: uRL+'/user/update-preferenceOrder',
            type: 'POST',
            data: {list:list},
            success: function (dataResult) {
                console.log(dataResult);
                if (dataResult == '1') {
                    Toast.fire({
                        icon: 'success',
                        title: 'Updated Succesfully.'
                    });
                }
            }
        });
    });


    $(document).on('click', '.viewContact', function () {
        $('#modal-info').modal('show');
        var id = $(this).attr('data-id');
        $.ajax({
            url: uRL + '/user/contact/'  + id,
            type: 'POST',
            success: function (dataResult) {
                console.log(dataResult);
                $('#modal-info .table').html(dataResult);
            },
        });
    });


    $('#updateHeroSection').validate({
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/user/hero-section',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                   console.log(dataResult);
                    if (dataResult == '1') {
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

});