function readURL(input, imgControlName) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(imgControlName).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
// license image
$("#license").change(function () {
    $(".lic_preview").show();
    var imgControlName = "#d_license_img";
    readURL(this, imgControlName);
    $('.preview_lic_img').addClass('it');
    $('.btn-rmv1').addClass('rmv');
});

$("#remove_lic_btn").click(function (e) {
    e.preventDefault();
    $("#license").val("");
    $("#d_license_img").attr("src", "");
    $('.preview_lic_img').removeClass('it');
    $('.btn-rmv1').removeClass('rmv');
    $(".lic_preview").hide();
});

// Insurance Card

$("#insurance").change(function () {
    $(".ins_preview").show();
    var imgControlName = "#d_insurance_img";
    readURL(this, imgControlName);
    $('.preview_insurance_img').addClass('it');
    $('.btn-rmv2').addClass('rmv');
});

$("#insurance_btn").click(function (e) {
    e.preventDefault();
    $("#insurance").val("");
    $("#d_insurance_img").attr("src", "");
    $('.preview_insurance_img').removeClass('it');
    $('.btn-rmv2').removeClass('rmv');
    $(".ins_preview").hide();
});


// Front Credit Card

$("#front_card").change(function () {
    $(".frontcard_preview").show();
    var imgControlName = "#fcard_img";
    readURL(this, imgControlName);
    $('.preview_fcard_img').addClass('it');
    $('.btn-rmv3').addClass('rmv');
});

$("#frontcard_btn").click(function (e) {
    e.preventDefault();
    $("#front_card").val("");
    $("#fcard_img").attr("src", "");
    $('.preview_fcard_img').removeClass('it');
    $('.btn-rmv3').removeClass('rmv');
    $(".frontcard_preview").hide();
});

// Back Credit Card

$("#back_card").change(function () {
    $(".backcard_preview").show();
    var imgControlName = "#bcard_img";
    readURL(this, imgControlName);
    $('.preview_bcard_img').addClass('it');
    $('.btn-rmv4').addClass('rmv');
});

$("#backcard_btn").click(function (e) {
    e.preventDefault();
    $("#back_card").val("");
    $("#bcard_img").attr("src", "");
    $('.preview_bcard_img').removeClass('it');
    $('.btn-rmv4').removeClass('rmv');
    $(".backcard_preview").hide();
});

// Form Validation 

// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if ($("#d_email").val() != $("#confirm_email").val()) {
                    $('.email_match').html('Email do not match.').show();
                    $('#confirm_email').addClass('email_error');
					$('.lostErrorMsg').show();
                    event.preventDefault();
                    event.stopPropagation();
                }
                else if (!form.checkValidity()) {
                    $('.lostErrorMsg').show();
					event.preventDefault();
                    event.stopPropagation();
                }
                else {
					$('.lostErrorMsg').hide();
                    $('#divLoading').show();
                }
                form.classList.add('was-validated');
            }, false)
        })
})()

// Check the email is matched or not 

$("#confirm_email").blur(function () {
    if ($("#d_email").val() != $("#confirm_email").val()) {
        $('.email_match').html('Email do not match.').show();
        $('#confirm_email').removeClass('success_email');
        $('#confirm_email').addClass('email_error');
    } else {
        $('.email_match').hide();
        $('#confirm_email').removeClass('email_error');
        $('#confirm_email').addClass('success_email');
    }
});
