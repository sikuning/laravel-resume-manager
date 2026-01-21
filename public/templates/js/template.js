$(function(){
    // site  base url
    var uRL = $('.site-url').val();
    // show ajax from error
    function show_formAjax_error(data) {
        if (data.status == 422) {
            $('.error').remove();
            $.each(data.responseJSON.errors, function (i, error) {
                var el = $(document).find('[name="' + i + '"]');
                el.after($('<span class="error">' + error[0] + '</span>'));
            });
        }
    }
    // show portfolio project modal box
    $('.project-box').click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
                url: uRL+'/user/show-project/'+id,
                type: 'GET',
                success: function (dataResult) {
                    console.log(dataResult);
                    $('#projectModal .modal-body').html(dataResult);
                    $('#projectModal').modal('show');
                }
            });
    });

    

    // save contact us message
    $('#saveContactMessage').validate({
        rules: { 
            name: { required: true } ,
            email: { required: true } ,
            message: { required: true },
        },
        submitHandler: function (form) {
            $('.message').html('');
            var formdata = new FormData(form);
            $.ajax({
                url: uRL+'/user/saveContact-message',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        $('.message').append('<div class="alert alert-success">Message Submitted Successfully.</div>');
                        setTimeout(function(){ 
                            $('form').trigger('reset');
                            $('.message').html('');
                        }, 1500);
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
});