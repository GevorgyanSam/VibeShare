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

    // ---- -------- -- --- --------- ------------ ----
    // This Function Is For Resending Verification Code
    // ---- -------- -- --- --------- ------------ ----

    function resendCode() {

        let awaitParent = $(".await");
        let timer = $(".await span");
        let resendParent = $(".resend button");
        let Minutes = 1;
        let Seconds = 59;
        let editState = false;
        let endState = false;

        setInterval(() => {
            if(editState) {
                Minutes = 0;
                Seconds = 59;
                editState = false;
            }
            if(endState) {
                awaitParent.css("display", "none");
                resendParent.css("display", "block");
                endState = false;
            }
            if(Minutes == "0" && Seconds == "00") {
                endState = true;
            }
            if(Minutes == 1 && Seconds == "00") {
                editState = true;
            }
            if(Seconds < 10) {
                Seconds = "0" + Seconds;
            }
            timer.text("0" + Minutes + ":" + Seconds);
            Seconds--;
        }, 1000);

    }

    resendCode();

})