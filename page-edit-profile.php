<?php
/*
Template Name: edit-profile Page Template
*/

get_header(); ?>

<?php get_template_part('partials/nav/nav', 'nav') ?>

<?php
// ************************** نمیتوانستم یک تمپلیت جدید بسازم به مشکلات اینتکسی میخورد برای همین کد های html همینجا قرار داده شد  **************************
// ************************** نمیتوانستم یک تمپلیت جدید بسازم به مشکلات اینتکسی میخورد برای همین کد های html همینجا قرار داده شد  ************************** 
?>

<div class="dashboard">
    <div class="container">
        <div class="row mt-5 dashboard-row d-flex align-items-stretch">

            <?php get_template_part('partials/dashboard/right-side-dashboard', 'right-side-dashboard') ?>

            <!-- سمت چپ -->
            <div class="col-md-9 equal-height left-side">
                <div class="container">
                    <div class="row">
                        <div class="col-12 user-profile mt-3">

                            <?php
                            // بررسی وجود پارامتر خطا در URL
                            if (isset($_GET['error-pass']) && $_GET['error-pass'] === 'wrong_password') {
                                echo '<div class="alert alert-danger">پسورد اشتباه است</div>';
                            }
                            ?>

                            <form id="user-update-form" method="post">
                                <div class="d-flex justify-content-between item">
                                    <div class="col-5 ">
                                        <div class=""><label for="phone">شماره تلفن</label></div>
                                        <div>
                                            <input type="text" id="phone" name="phone"
                                                value="<?php echo esc_attr(get_user_meta($current_user->ID, 'phone', true)); ?>"
                                                readonly disabled />
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div><label for="email">ایمیل</label></div>
                                        <div>
                                            <input type="email" id="email" name="email"
                                                value="<?php echo esc_attr($current_user->user_email); ?>" readonly
                                                disabled />
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div><label for="nickname">اسم:</label></div>
                                    <input type="text" id="nickname" name="nickname"
                                        value="<?php echo esc_attr($current_user->nickname); ?>" required />
                                </div>

                                <div class="item">
                                    <div><label for="old_password">پسورد قبلی</label></div>
                                    <input type="password" id="old_password" name="old_password" />
                                </div>

                                <div class="item">
                                    <div><label for="new_password">پسورد جدید</label></div>
                                    <input type="password" id="new_password" name="new_password" />
                                </div>

                                <div class="item">
                                    <div>
                                        <label for="bio">درباره من (حداکثر 400 حرف)</label>
                                    </div>
                                    <textarea name="bio" maxlength="400" class="form-control"
                                        id="exampleFormControlTextarea1 bio" rows="3">
                               <?php echo esc_textarea(get_user_meta($current_user->ID, 'bio', true)); ?>
                                     </textarea>
                                </div>

                                <div class="item">
                                    <button type="submit" name="update_profile">
                                        ذخیره تغییرات
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- سمت راست -->
        </div>
    </div>
</div>



<?php get_footer(); ?>