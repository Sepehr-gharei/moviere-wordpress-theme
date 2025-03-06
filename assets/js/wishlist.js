jQuery(document).ready(function($) {
    console.log(wishlist_ajax); // باید URL AJAX را نمایش دهد
    
    $('.wishlist-btn').on('click', function(e) {
        e.preventDefault();
        
        const post_id = $(this).data('post-id');
        const button = $(this);
        
        $.ajax({
            url: wishlist_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'toggle_wishlist',
                post_id: post_id
            },
            success: function(response) {
                if (response.success) {
                    alert(response.data);
                    button.text(response.data === 'افزوده شد' ? 'حذف از لیست' : 'افزودن به لیست');
                }
            }
        });
    });
});