import { path, danger, success } from './modules.js'
$(function() {    
    $('#signUpAction').on('click', function(e) {
        e.preventDefault()

        let email = $('#email').val()
        let fullname = $('#fullname').val()
        let password = $('#password').val()

        $.post(path + 'source/actions/Auth/register.php', {
            process: 'authRegister', email, fullname, password
        })
        .then(function(response) {
            let data = JSON.parse(response)

            if (data.auth) {
                success('You have successfully registered')
                setTimeout(() => { location.href = path + 'login' }, 2000)
            } else if (!data.auth && data.message) {
                danger(`${data.message}`)
            }
        })
        .catch(() => {
            setTimeout(() => { location.href = path + 'broken' }, 1500)
        })
    })
})