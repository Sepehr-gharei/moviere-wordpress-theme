<?php
function enqueue_custom_admin_styles()
{
    echo "
    <style>
        /* استایل کلی برای بخش .faq-admin-menu */
        .faq-admin-menu {
            background: #e6e6e6;
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
    echo "
    <style>
        /* استایل کلی برای کلاس subscribe-container-admin-menu */
        .subscribe-container-admin-menu {
            background: #e6e6e6;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 20px auto;
        }

        /* استایل برای عنوان‌ها */
        .subscribe-container-admin-menu h1 {
            color: #23282d;
            font-size: 24px;
            margin-bottom: 20px;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
        }

        /* استایل برای فرم‌ها */
        .subscribe-container-admin-menu form {
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        /* استایل برای لیبل‌ها */
        .subscribe-container-admin-menu label {
            display: block;
            margin: 10px 0px;
            font-weight: bold;
            color: #23282d;
            text-align: right;
        }
        .subscribe-container-admin-menu .input-price{
             height: 43px;
            width: 100%;
        }

        /* استایل برای فیلدهای ورودی */
        .subscribe-container-admin-menu input[type='text'] {
            width: 100%;
            padding: 8px;
            border: 1px solid #868686;
            border-radius: 3px;
            font-size: 14px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        .subscribe-container-admin-menu input[type='text']:focus {
            border-color: #0073aa;
            outline: none;
            box-shadow: 0 0 3px rgba(0, 115, 170, 0.3);
        }

        /* استایل برای چک‌باکس‌ها */
        .subscribe-container-admin-menu input[type='checkbox'] {
            margin-right: 10px;
        }

        /* استایل برای دکمه‌ها */
        .subscribe-container-admin-menu .button {
            background: #0073aa;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s ease;
        }

        .subscribe-container-admin-menu .button:hover {
            background: #005177;
        }

        /* استایل برای جداول (اگر در آینده اضافه شوند) */
        .subscribe-container-admin-menu table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .subscribe-container-admin-menu table th,
        .subscribe-container-admin-menu table td {
            padding: 10px;
            border: 1px solid #868686;
            text-align: left;
        }

        .subscribe-container-admin-menu table th {
            background: #f1f1f1;
            font-weight: bold;
            text-align: center;
        }
    </style>
    ";
}
add_action('admin_head', 'enqueue_custom_admin_styles');

// بارگذاری jQuery در پنل ادمین
function enqueue_custom_admin_scripts()
{
    wp_enqueue_script('jquery');
}
add_action('admin_enqueue_scripts', 'enqueue_custom_admin_scripts');