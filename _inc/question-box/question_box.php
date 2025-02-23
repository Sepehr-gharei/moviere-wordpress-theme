<?php
function add_faq_section_to_admin() {
    add_menu_page(
        'سوالات متداول', // عنوان صفحه
        'سوالات متداول', // عنوان منو
        'manage_options', // قابلیت دسترسی
        'faq-settings', // اسلاگ صفحه
        'faq_settings_page', // تابع نمایش صفحه
        'dashicons-editor-help', // آیکون
        6 // موقعیت منو
    );
}
add_action('admin_menu', 'add_faq_section_to_admin');

function faq_settings_page() {
    ?>
    <div class="wrap">
        <div class="container">
            <div class="faq-admin-menu">
                <h1>مدیریت سوالات متداول</h1>
                <form method="post" action="options.php" id="faq-form">
                    <?php
                    settings_fields('faq_settings_group');
                    do_settings_sections('faq-settings');
                    submit_button();
                    ?>
                    <button type="button" id="add-faq-container" class="button">افزودن کانتینر جدید</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        jQuery(document).ready(function($) {
            let containerCount = <?php echo count(get_option('faq_settings', array())); ?>;

            // اگر تعداد کانتینرها کمتر از ۳ باشد، به ۳ افزایش می‌دهیم
            if (containerCount < 3) {
                containerCount = 3;
            }

            // افزودن کانتینر جدید
            $('#add-faq-container').on('click', function() {
                containerCount++;
                const newContainer = `
                    <div class="faq-container" data-container-id="${containerCount}">
                        <h3>کانتینر ${containerCount}</h3>
                        <button type="button" class="remove-faq-container button">حذف</button>
                        <label for="faq_settings[question_${containerCount}]">سوال ${containerCount}:</label>
                        <input id="faq_settings[question_${containerCount}]" name="faq_settings[question_${containerCount}]" size="40" type="text" value="" />
                        <br><br>
                        <label for="faq_settings[answer_${containerCount}]">جواب ${containerCount}:</label>
                        <input id="faq_settings[answer_${containerCount}]" name="faq_settings[answer_${containerCount}]" size="40" type="text" value="" />
                    </div>
                `;
                $('#faq-form').append(newContainer);
            });

            // حذف کانتینر
            $(document).on('click', '.remove-faq-container', function() {
                if (confirm('آیا مطمئن هستید که می‌خواهید این کانتینر را حذف کنید؟')) {
                    $(this).closest('.faq-container').remove();
                }
            });
        });
    </script>
    <?php
}

function faq_settings_init() {
    register_setting('faq_settings_group', 'faq_settings', 'faq_settings_validate');

    add_settings_section(
        'faq_main_section',
        'سوالات متداول',
        'faq_section_text',
        'faq-settings'
    );

    // نمایش ۳ کانتینر پیش‌فرض
    for ($i = 1; $i <= 3; $i++) {
        add_settings_field(
            "faq_container_{$i}",
            "کانتینر ",
            function() use ($i) {
                faq_container_input($i);
            },
            'faq-settings',
            'faq_main_section'
        );
    }

    // نمایش کانتینرهای اضافی اگر وجود داشته باشند
    $options = get_option('faq_settings', array());
    if (!empty($options)) {
        foreach ($options as $key => $value) {
            if (strpos($key, 'question_') === 0) {
                $containerNumber = str_replace('question_', '', $key);
                if ($containerNumber > 3) {
                    add_settings_field(
                        "faq_container_{$containerNumber}",
                        "کانتینر ",
                        function() use ($containerNumber, $options) {
                            faq_container_input($containerNumber, $options);
                        },
                        'faq-settings',
                        'faq_main_section'
                    );
                }
            }
        }
    }
}
add_action('admin_init', 'faq_settings_init');

function faq_section_text() {
    echo '<p>سوالات و جواب‌های متداول خود را وارد کنید.</p>';
}

function faq_container_input($containerNumber, $options = array()) {
    // اگر $options مقداردهی نشده باشد، از get_option استفاده می‌کنیم
    if (empty($options)) {
        $options = get_option('faq_settings', array());
    }

    // مقداردهی پیش‌فرض برای سوال و جواب
    $question = isset($options["question_{$containerNumber}"]) ? $options["question_{$containerNumber}"] : '';
    $answer = isset($options["answer_{$containerNumber}"]) ? $options["answer_{$containerNumber}"] : '';

    // نمایش کانتینر
    echo "<div class='faq-container' data-container-id='{$containerNumber}'>";
    echo "<h3>کانتینر </h3>";
    
    // فقط برای کانتینرهای بالاتر از ۳ دکمه حذف نمایش داده می‌شود
    if ($containerNumber > 3) {
        echo "<button type='button' class='remove-faq-container button'>حذف</button>";
    }

    echo "<label for='faq_settings[question_{$containerNumber}]'>سوال :</label>";
    echo "<input id='faq_settings[question_{$containerNumber}]' name='faq_settings[question_{$containerNumber}]' size='40' type='text' value='{$question}' />";
    echo "<br><br>";
    echo "<label for='faq_settings[answer_{$containerNumber}]'>جواب :</label>";
    echo "<input id='faq_settings[answer_{$containerNumber}]' name='faq_settings[answer_{$containerNumber}]' size='40' type='text' value='{$answer}' />";
    echo "</div>";
}

function faq_settings_validate($input) {
    $newinput = array();
    foreach ($input as $key => $value) {
        if (strpos($key, 'question_') === 0 || strpos($key, 'answer_') === 0) {
            $newinput[$key] = sanitize_text_field($value);
        }
    }
    return $newinput;
}

// اضافه کردن استایل‌های CSS به پنل ادمین
function enqueue_custom_admin_styles() {
    echo "
    <style>
        /* استایل کلی برای بخش .faq-admin-menu */
        .faq-admin-menu {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 20px auto;
        }

        /* استایل برای هر کانتینر داخل .faq-admin-menu */
        .faq-admin-menu .faq-container {
            background: #fff;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #222222;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        /* استایل برای عنوان کانتینر */
        .faq-admin-menu .faq-container h3 {
            margin-top: 0;
            color: #23282d;
            font-size: 18px;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
        }

        /* استایل برای دکمه‌ها */
        .faq-admin-menu .button {
            background: #0073aa;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s ease;
        }

        .faq-admin-menu .button:hover {
            background: #005177;
        }

        /* استایل برای دکمه حذف */
        .faq-admin-menu .remove-faq-container {
            background: #dc3232;
            margin-bottom: 10px;
        }

        .faq-admin-menu .remove-faq-container:hover {
            background: #a00;
        }

        /* استایل برای لیبل‌ها */
        .faq-admin-menu label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #23282d;
        }

        /* استایل برای فیلدهای ورودی */
        .faq-admin-menu input[type='text'] {
            width: 100%;
            padding: 8px;
            border: 1px solid #222222;
            border-radius: 3px;
            font-size: 14px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        .faq-admin-menu input[type='text']:focus {
            border-color: #0073aa;
            outline: none;
            box-shadow: 0 0 3px rgba(0, 115, 170, 0.3);
        }

        .faq-admin-menu #add-faq-container {
            margin-top: 20px;
            background: #46b450;
        }

        .faq-admin-menu #add-faq-container:hover {
            background: #38923f;
        }
    </style>
    ";
}
add_action('admin_head', 'enqueue_custom_admin_styles');

// بارگذاری jQuery در پنل ادمین
function enqueue_custom_admin_scripts() {
    wp_enqueue_script('jquery');
}
add_action('admin_enqueue_scripts', 'enqueue_custom_admin_scripts');