jQuery(document).ready(function($) {
    // Upload image
    $('#upload_second_thumbnail').click(function(e) {
        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'انتخاب تصویر دوم',
            button: { text: 'استفاده از این تصویر' },
            multiple: false
        }).on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#_second_thumbnail_id').val(attachment.id);
            $('#second_thumbnail_preview').html('<img src="' + attachment.url + '" style="max-width:100%;"/>');
            $('#remove_second_thumbnail').show();
        }).open();
    });

    // Remove image
    $('#remove_second_thumbnail').click(function(e) {
        e.preventDefault();
        $('#_second_thumbnail_id').val('');
        $('#second_thumbnail_preview').html('');
        $(this).hide();
    });
});