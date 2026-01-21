$(function(){
    var uRL = $('.site-url').val();

    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    var preloader = `<div class="preloader">
    <div class="loader">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>`;

    function show_formAjax_error(data) {
        if (data.status == 422) {
            $('.error').remove();
            $.each(data.responseJSON.errors, function (i, error) {
                var el = $(document).find('[name="' + i + '"]');
                el.after($('<span class="error">' + error[0] + '</span>'));
            });
        }
    }

    $('#saveContact').validate({
        rules: {
            name:{ required: true },
            email:{ required: true },
            message:{ required: true },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/contact',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Your Message Submitted Successfully.'
                        });
                        setTimeout(function () {
                            $('.preloader').remove();
                            $('form').trigger('reset');
                        }, 1000)
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });


    // ========================================
    // script for User Login
    // ========================================

    $('#userLogin').validate({
        rules: {
            email: { required: true },
            password: { required: true }
        },
        messages: {
            email: { required: "Email is required" },
            password: { required: "Password is required" }
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/login',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Logged In Successfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/user/my-profile'; }, 1000);
                    }else{
                        $('.preloader').remove();
                        Toast.fire({
                            icon: 'warning',
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
    // script for User SignUp module
    // ========================================

    $('#user-signup').validate({
        rules: {
            username: { required: true },
            designation: { required: true },
            phone: { required: true },
            country: { required: true },
            email: { required: true },
            password: { required: true },
            con_password: { required: true,equalTo:'#password' },
        },
        messages: {
            username: { required: "Your Name is required" },
            designation: { required: "Your Designation is required" },
            phone: { required: "Phone Number is required" },
            country: { required: "Country Name is required" },
            email: { required: "Email Address is required" },
            password: { required: "Password is required" },
        },
        submitHandler: function (form) {
            $('.message').empty();
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL+'/signup',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Profile Created Successfully. Login with your email and password.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/login'; }, 3000);
                    }
                },
                error: function (error) {
                    $('.preloader').remove();
                    show_formAjax_error(error);
                }
            });
        }
    });


    // ========================================
    // script for User Forgot Password
    // ========================================

    $('#user-forgotPassword').validate({
        rules: {
            email: { required: true },
        },
        messages: {
            email: { required: "Email is required" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('form').append(preloader);
            $('.message').html('');
            $.ajax({
                url: uRL + '/forgot-password',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Please check you email for reset your password.'
                        });
                        $('.message').html('<div class="alert alert-success">Please check you email for reset your password.</div>');
                        $('.preloader').remove();
                        $('form').trigger('reset');
                    }else{
                        $('.preloader').remove();
                        Toast.fire({
                            icon: 'warning',
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



    $('#user-resetPassword').validate({
        rules: { 
            password: { required: true } ,
            confirm_password: { required: true,equalTo: '#password' }
        },
        messages: { 
            password: { required: "password is required" },
            confirm_password: { required: "Confirm password is required" },
        },
        submitHandler: function (form) {
            $('.message').empty();
            var formdata = new FormData(form);
            $.ajax({
                url: uRL+'/update-password',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        $('.message').append('<div class="alert alert-success">Password Updated Successfully.</div>');
                        setTimeout(function(){ window.location.href = uRL + '/login'; }, 3000);
                    } else {
                       $('.message').append('<div class="alert alert-danger">'+dataResult+'</div>');
                    }
                },
                error: function(data){
                    show_formAjax_error(data)
                }
            });
        }
    });

    
})