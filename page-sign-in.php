<?php
/*
Template Name: Sign In Page
*/

get_header(); // دریافت هدر قالب
// بررسی ارسال فرم

?>
<?php get_template_part('partials/nav/nav', 'nav') ?>

<div class="header-slider archive-header-slider">
  <!-- list Items -->
  <div class="list">
<?php get_template_part('partials/sign-in/sign-in', 'sign-in') ?>
    

    
   
  </div>
</div>

<?php
get_footer(); // دریافت فوتر قالب
?>