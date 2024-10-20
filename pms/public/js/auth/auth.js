

function signIn(){
    let userName = $('#username').val();
    let password = $('#password').val();
    let token = $("meta[title='token']").attr('content');
    let url = '/signin/submit';

    $('.username-error-container').find('span').text('')
    $('.password-error-container').find('span').text('')
    $('#username').removeClass('is-invalid');
    $('#password').removeClass('is-invalid');

    $.ajax({
        url : url,
        method : 'POST',
        data : {
            username : userName,
            password : password
        },
        headers : {
            'X-CSRF-TOKEN' : token
        },
        success : function(response) {
            let userType = response.data.userType;
            let message = response.message;

            Swal.fire({
                title : message,
                text : '',
                icon : 'success'
            });

            if(userType && userType == 'Admin')
            {
                window.location = '/admin/dashboard';
                return;
            }

            window.location = '/dashboard';
            return;
        },
        error : function(error){

            let status = error.status ?? null;
            let errors = error.responseJSON.errors ?? [];
            let message = error.responseJSON.message ?? '';
            if(status == 422){
                if(errors.username){
                    $("#username").addClass('is-invalid');
                    $('.username-error-container').find('span').text(errors.username);
                }

                if(errors.password){
                    $("#password").addClass('is-invalid');
                    $('.password-error-container').find('span').text(errors.password);
                }
            }
            if(status == 404){
                $("#username").addClass('is-invalid');
                $('.username-error-container').find('span').text(message);
            }

            if(status == 401){
                $("#password").addClass('is-invalid');
                $('.password-error-container').find('span').text(message);
            }

            if(status == 500){
                Swal.fire({
                    title : 'Server Error',
                    text: message,
                    icon : 'error'
                });
            }
        }
    });
}


