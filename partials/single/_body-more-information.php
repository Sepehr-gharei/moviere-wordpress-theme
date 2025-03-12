<!-- ============================  start more information ============================   -->
<div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
            aria-expanded="false" aria-controls="collapseTwo">
            اطلاعات بیشتر
        </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
        data-bs-parent="#accordionExample">
        <div class="accordion-body p-0">
            <div class="accordion" id="accordionExampleTwo">
                <div class="container more-information py-3 px-5">
                    <div class="row">
                        <div class="col-12">
                            <div class="header d-flex justify-content-center">
                                <img src="<?php echo get_template_directory_uri() . '/assets/image/doucument-icon.svg' ?>"
                                    alt="" />
                                <p>توضیحات</p>
                            </div>
                            <div class="body">
                                <div class="description">
                                    <p>
                                        <?php the_content() ?>
                                    </p>

                                </div>
                                <ul>
                                    <li class="col-4">
                                        <i class="fa-regular fa-clock"></i>
                                        <p>مدت زمان :</p>
                                        <span><?php movie_data('Runtime'); ?></span>

                                    </li>
                                    <li class="col-4">
                                        <i class="fa-regular fa-calendar-days"></i>
                                        <p>سال انتشار :</p>
                                        <span><?php movie_data('Year');

                                        ?>
                                        </span>
                                    </li>
                                    <li class="col-4">
                                        <i class="fa-solid fa-language"></i>
                                        <p>زبان :</p>
                                        <span><?php movie_data('Language'); ?></span>
                                    </li>



                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================  end more information ============================   -->