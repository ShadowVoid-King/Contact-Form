/* global $, alert, console */

$(function () {
	"use strict";

	// setting Error Status
	var userError = true,
		emailError = true,
		msgError = true;

	$(".username").blur(function () {
		if ($(this).val().length < 4) {
            $(this).css("border", "1px solid #F00").parent().find(".custom-alert").fadeIn(200)
                .end().find(".asterisx").fadeIn(100);
			userError = true;
		} else {
			$(this).css("border", "1px solid #080");
            $(this).css("border", "1px solid #080").parent().find(".custom-alert").fadeOut(200)
                .end().find(".asterisx").fadeOut(100);

			userError = false;
		}
	});

	$(".email").blur(function () {
		if ($(this).val() === "") {
			$(this).css("border", "1px solid #F00").parent().find(".custom-alert").fadeIn(200)
                .end().find(".asterisx").fadeIn(100);
			emailError = true;
		} else {
			$(this).css("border", "1px solid #080");
			$(this).css("border", "1px solid #080").parent().find(".custom-alert").fadeOut(200)
                .end().find(".asterisx").fadeOut(100);
			emailError = false;
		}
	});
	$(".message").blur(function () {
		if ($(this).val().length < 10) {
			$(this).css("border", "1px solid #F00").parent().find(".custom-alert").fadeIn(200)
                .end().find(".asterisx").fadeIn(100);
			msgError = true;
		} else {
            $(this).css("border", "1px solid #080").parent().find(".custom-alert").fadeOut(200)
                .end().find(".asterisx").fadeOut(100);
			msgError = false;
		}
	});
	// Submit Form Validation
	$(".contact-form").submit(function (e) {
		// e for Event
		if (userError === true || emailError === true || msgError === true) {
            e.preventDefault();
            // to prevent submit to send data to server ||
            /* 
            !If Use 1 or 0 Than Use True or False will Not Working , Than You Should Use addEventListener
            *Because you use in condition if === so will check data type also it's take me 30 min to know  :D
            document.addEventListener("click", function (e) {
                // ...
            }, true); 
               */
			$(".username , .email , .message").blur(); // to blur all inputs
		}
	});
});
