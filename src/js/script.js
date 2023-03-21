$(document).ready(function() {

    const form = {
        login: {
            input: $("#login"),
            label: $("label[for=login]"),
        },
        password: {
            input: $("#password"),
            label: $("label[for=password]"),
            view: $(".passwordView"),
        }
    }

    // ---- -------- -- --- -------- --- -------- ----
    // This Function Is For Changing The Password Type
    // ---- -------- -- --- -------- --- -------- ----

    function passwordType() {

        form.password.input.keyup(() => {

            if(form.password.input.val() == 0) {
                form.password.view.css("display", "none");
            } else {
                form.password.view.css("display", "block");
            }

        })

        form.password.view.click(() => {

            if(form.password.view.hasClass("fa-eye-slash")) {
                form.password.view.removeClass("fa-eye-slash");
                form.password.view.addClass("fa-eye");
                form.password.view.css("right", "21.5px");
                form.password.input.attr("type", "text");
            } else if(form.password.view.hasClass("fa-eye")) {
                form.password.view.removeClass("fa-eye");
                form.password.view.addClass("fa-eye-slash");
                form.password.view.css("right", "20px");
                form.password.input.attr("type", "password");
            }
    
        })

    }

    passwordType();

})