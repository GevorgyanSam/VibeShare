"use strict";$(document).ready(function(){var s={login:{input:$("#login"),label:$("label[for=login]")},password:{input:$("#password"),label:$("label[for=password]"),view:$(".passwordView")}};s.password.input.keyup(function(){0==s.password.input.val()?s.password.view.css("display","none"):s.password.view.css("display","block")}),s.password.view.click(function(){s.password.view.hasClass("fa-eye-slash")?(s.password.view.removeClass("fa-eye-slash"),s.password.view.addClass("fa-eye"),s.password.view.css("right","21.5px"),s.password.input.attr("type","text")):s.password.view.hasClass("fa-eye")&&(s.password.view.removeClass("fa-eye"),s.password.view.addClass("fa-eye-slash"),s.password.view.css("right","20px"),s.password.input.attr("type","password"))})});