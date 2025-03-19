function showCustomAlert(message) {
  const alertBox = document.getElementById("customAlert");
  const alertMessage = document.getElementById("alertMessage");

  // تنظیم پیام
  alertMessage.textContent = message;

  // نمایش alert
  alertBox.classList.remove("hidden");

  // پنهان کردن alert پس از 3 ثانیه
  setTimeout(() => {
    alertBox.classList.add("hidden");
  }, 3000); // 3000 میلی‌ثانیه = 3 ثانیه
}
// تابع نمایش alert کاستومی قرمز
function showCustomAlertRed(message) {
  const alertBox = document.getElementById("customAlertRed");
  const alertMessage = document.getElementById("alertMessageRed");

  // تنظیم پیام
  alertMessage.textContent = message;

  // نمایش alert
  alertBox.classList.remove("hidden");

  // پنهان کردن alert پس از 3 ثانیه
  setTimeout(() => {
    alertBox.classList.add("hidden");
  }, 3000); // 3000 میلی‌ثانیه = 3 ثانیه
}

jQuery(document).ready(function ($) {
  $("body").on("click", "#send_code", function (e) {
    e.preventDefault();
    let el = $(this);
    let phone = $(".phone").val();
    $.ajax({
      type: "POST",
      url: ajax_object.ajax_url,
      dataType: "JSON",
      data: {
        action: "wp_mr_auth_send_verification_code",
        phone: phone,
        _nonce: ajax_object._nonce,
      },
      beforeSend: function () {
        $("#send_code").html('<i class="fas fa-spinner fa-spin"></i>');
      },
      success: function (response) {
        $("#user-phone-number").hide();
        $("#varification-code").css("display", "flex");
        el.attr("id", "verify_button_code");
        el.text("تایید کد");
        if (response.success) {
          showCustomAlert(response.success);
        }
      },
      error: function (error) {
        if (error.responseJSON.error) {
          showCustomAlertRed(error.responseJSON.message);
        }
      },
      complete: function(){
        $("#send_code").html('ارسال کد تایید');
      }
    });
  });
  $("body").on("click", "#verify_button_code", function (e) {
    e.preventDefault();
    let el = $(this);
    let verification_code = $(".verification_code").val();

    // بررسی مقدار کد تایید
    if (!verification_code || verification_code.trim() === "") {
      showCustomAlertRed("کد تایید را وارد کنید.");

      return;
    }

    $.ajax({
      type: "POST",
      url: ajax_object.ajax_url,
      dataType: "JSON",
      data: {
        action: "wp_mr_auth_verify_verification_code",
        verification_code: verification_code,
        _nonce: ajax_object._nonce,
      },
      success: function (response) {
        $("#get_user_phone").html(
          '<div class="register_form" id="register_form"> <div  class="input-item"> <label for="name">نام کاربری</label> <input type="text" name="name" id="name"> </div> <div  class="input-item"> <label for="email">ایمیل</label> <input type="text" name="email" id="email"> </div> <div  class="input-item"> <label for="password">رمز عبور</label> <input type="password" name="password" id="password"> </div> <div class="button"> <a  href="" class="" id="register_user">ثبت نام</a> </div> </div>'
        );
        if (response.success) {
          showCustomAlert(response.success);
        }
      },
      error: function (error) {
        if (error.responseJSON && error.responseJSON.error) {
          showCustomAlertRed(error.responseJSON.message);
        }
      },
    });
  });
  $("body").on("click", "#register_user", function (e) {
    e.preventDefault();
    let el = $(this);
    let user_name = $("#name").val();
    let user_email = $("#email").val();
    let user_password = $("#password").val();
    $.ajax({
      type: "POST",
      url: ajax_object.ajax_url,
      dataType: "JSON",
      data: {
        action: "wp_mr_register_user",
        user_name: user_name,
        user_email: user_email,
        user_password: user_password,
        _nonce: ajax_object._nonce,
      },
      success: function (response) {
        if (response.success) {
          showCustomAlert(response.success);
        }
        window.location.href = "/";
      },
      error: function (error) {
        if (error.responseJSON && error.responseJSON.error) {
          showCustomAlertRed(error.responseJSON.message);
        }
      },
    });
  });
});
