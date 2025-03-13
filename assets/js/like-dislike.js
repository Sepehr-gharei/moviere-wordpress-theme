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
jQuery(document).ready(function($) {
    $('.like-button, .dislike-button').on('click', function(e) {
        e.preventDefault();

        var button = $(this);
        var commentId = button.data('comment-id');
        var action = button.hasClass('like-button') ? 'like' : 'dislike';

        $.ajax({
            url: like_dislike_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'like_dislike',
                security: like_dislike_ajax.nonce,
                comment_id: commentId,
                action_type: action
            },
            success: function(response) {
                if (response.success) {
                    button.text((action === 'like' ? '👍 ' : '👎 ') + response.data.count);
                } else {
                
                    showCustomAlertRed(response.data);
                }
            },
            error: function() {
   
                showCustomAlertRed('خطایی رخ داد. لطفاً دوباره تلاش کنید.');
            }
        });
    });
});