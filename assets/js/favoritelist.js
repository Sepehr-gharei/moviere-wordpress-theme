// تابع نمایش alert کاستومی
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

// مثال استفاده از تابع

// مثال استفاده از تابع
// فرض کنید response.data حاوی پیامی است که می‌خواهید نمایش دهید
jQuery(document).ready(function ($) {
  // دکمه افزودن/حذف از علاقه مندی
  $(document).on("click", ".favorite-btn", function (e) {
    e.preventDefault();

    // بررسی لاگین بودن کاربر
    if (ajax_object.is_logged_in === "0") {
      alert("برای این عملیات باید وارد شوید");
      return;
    }

    var button = $(this);
    var post_id = button.data("post-id");

    $.ajax({
      url: ajax_object.ajax_url,
      type: "POST",
      data: {
        action: "update_favorite",
        post_id: post_id,
      },
      success: function (response) {
        if (response.success) {
          button.html(
            response.data === "به علاقه مندی اضافه شد"
              ? '<i class="fa-solid fa-heart-circle-minus"></i>'
              : '<i class="fa-solid fa-heart-circle-plus"></i>'
          );
        }
        if (response.data === "به علاقه مندی اضافه شد") {
          showCustomAlert(response.data);
        } else {
          showCustomAlertRed(response.data);
        }
      },
    });
  });

  // دکمه حذف از علاقه مندی در صفحه کاربری
  $(document).on("click", ".remove-from-favorite", function (e) {
    e.preventDefault();

    // بررسی لاگین بودن کاربر
    if (ajax_object.is_logged_in === "0") {
      showCustomAlertRed("برای این عملیات باید وارد شوید");

      return;
    }

    var button = $(this);
    var post_id = button.data("post-id");

    $.ajax({
      url: ajax_object.ajax_url,
      type: "POST",
      data: {
        action: "remove_from_favorite",
        post_id: post_id,
      },
      success: function (response) {
        if (response.success) {
          button.closest("li").remove();
        }
        showCustomAlertRed(response.data);
      },
    });
  });
});
