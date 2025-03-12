<!-- ============================ start question box   ============================ -->
<div class="container mt-0">
  <div class="row">
    <div class="fag-accordion">
      <div class="header mb-4 mt-5 question-box-header">
        <h2>
          <img src="<?php echo get_stylesheet_directory_uri() . '/assets/image/question-mark-svgrepo-com.svg' ?>"
            alt="" />
          <span>سوالات شما</span>
        </h2>
      </div>
      <div class="accordion" id="accordionExample">
        
        <?php
        // دریافت داده‌های سوالات متداول از دیتابیس
        $faq_settings = get_option('faq_settings', array());

        // اگر داده‌ای وجود داشت، آن‌ها را نمایش دهید
        if (!empty($faq_settings)) {


          foreach ($faq_settings as $key => $value) {
            // فقط سوالات و جواب‌ها را نمایش دهید
            if (strpos($key, 'question_') === 0) {
              $containerNumber = str_replace('question_', '', $key);
              $question = $value;
              $answer = isset($faq_settings["answer_{$containerNumber}"]) ? $faq_settings["answer_{$containerNumber}"] : '';

             
              ?>
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading<?php echo $containerNumber ?>">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse<?php echo $containerNumber ?>" aria-expanded="false" aria-controls="collapse<?php echo $containerNumber ?>">
                    <?php echo $question ?>
                  </button>
                </h2>
                <div id="collapse<?php echo $containerNumber ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $containerNumber ?>"
                  data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <p><?php echo $answer ?></p>
                  </div>
                </div>
              </div>
              <?php
            }
          }


        } else {
          echo '<p>هیچ سوال متداولی وجود ندارد.</p>';
        }
        ?>
       
      </div>
    </div>
  </div>
</div>

<!-- ============================ end question box  ============================ -->