$(document).ready(function() {

    const form = {
        password: {
            input: $("#password"),
            icon: $("#password + i"),
        },
        cpassword: {
            input: $("#cpassword"),
            icon: $("#cpassword + i"),
        }
    }

    // ---- -------- -- --- -------- --- -------- ----
    // This Function Is For Changing The Password Type
    // ---- -------- -- --- -------- --- -------- ----

    function passwordType(input, icon) {

        input.keyup(() => {

            if(input.val() == 0) {
                icon.css("display", "none");
            } else {
                icon.css("display", "block");
            }

        })

        icon.click(() => {

            if(icon.hasClass("fa-eye-slash")) {
                icon.removeClass("fa-eye-slash");
                icon.addClass("fa-eye");
                icon.css("right", "16px");
                input.attr("type", "text");
            } else if(icon.hasClass("fa-eye")) {
                icon.removeClass("fa-eye");
                icon.addClass("fa-eye-slash");
                icon.css("right", "15px");
                input.attr("type", "password");
            }

        })

    }

    passwordType(form.password.input, form.password.icon);
    passwordType(form.cpassword.input, form.cpassword.icon);

})