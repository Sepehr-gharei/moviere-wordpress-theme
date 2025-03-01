<!-- ============================  start download link ============================   -->

<?php
if (is_singular('post')) {
    global $post;
    $categories = get_the_category($post->ID);
    $in_series_category = false;

    foreach ($categories as $category) {
        if ($category->slug == 'series') {
            $in_series_category = true;
            break;
        }
    }

    if (!$in_series_category) {
        $quality_data = get_post_meta($post->ID, '_quality_data', true);
        if (!empty($quality_data)) {

            echo '<div class="accordion-item accordion-download-link">';
            echo '<h2 class="accordion-header" id="headingOne">';
            echo '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">';
            echo 'لینک دانلود';
            echo '</button>';
            echo '</h2>';
            echo '<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#mainAccordion">';
            echo '<div class="accordion-body">';
            echo '<div class="accordion" id="qualityAccordion">';

            foreach ($quality_data as $index => $quality) {
                ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingQuality<?php echo $index; ?>">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseQuality<?php echo $index; ?>" aria-expanded="false"
                            aria-controls="collapseQuality<?php echo $index; ?>">
                            <div class="quality"> کیفیت: <?php echo esc_html($quality['name']); ?></div>
                            <?php echo isset($quality['subtitle']) && $quality['subtitle'] ? '<div class="subtitle">زیرنویس</div>' : ''; ?>
                        </button>

                    </h2>
                    <div id="collapseQuality<?php echo $index; ?>" class="accordion-collapse collapse"
                        aria-labelledby="headingQuality<?php echo $index; ?>" data-bs-parent="#qualityAccordion">
                        <div class="accordion-body">
                            <?php
                            if (!empty($quality['episodes'])) {
                                foreach ($quality['episodes'] as $ep_index => $episode) {
                                    ?>
                                    <div class="episode-container">
                                        <a href="<?php echo $episode['link'] ?>">قسمت <?php echo $ep_index + 1 ?></a>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            }

            echo '</div>'; // End of qualityAccordion
            echo '</div>'; // End of accordion-body
            echo '</div>'; // End of collapseOne
            echo '</div>'; // End of accordion-item

        }
    }
}

?>





































<?php
if (is_singular('post')) {
    global $post;
    $categories = get_the_category($post->ID);
    $in_series_category = false;

    foreach ($categories as $category) {
        if ($category->slug == 'series') {
            $in_series_category = true;
            break;
        }
    }

    if ($in_series_category) {
        $season_data = get_post_meta($post->ID, '_season_data', true);
        if (!empty($season_data)) {
            echo '<div class="accordion-item accordion-download-link">';
            echo '<h2 class="accordion-header" id="headingOne">';
            echo '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">';
            echo 'لینک دانلود';
            echo '</button>';
            echo '</h2>';
            echo '<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#mainAccordion">';
            echo '<div class="accordion-body">';
            echo '<div class="accordion" id="seasonAccordion">';

            foreach ($season_data as $season_index => $season) {
                ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSeason<?php echo $season_index; ?>">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseSeason<?php echo $season_index; ?>" aria-expanded="false"
                            aria-controls="collapseSeason<?php echo $season_index; ?>">
                            فصل <?php echo $season_index + 1; ?>
                        </button>
                    </h2>
                    <div id="collapseSeason<?php echo $season_index; ?>" class="accordion-collapse collapse"
                        aria-labelledby="headingSeason<?php echo $season_index; ?>" data-bs-parent="#seasonAccordion">
                        <div class="accordion-body">
                            <div class="accordion" id="qualityAccordion<?php echo $season_index; ?>">
                                <?php
                                if (!empty($season['qualities'])) {
                                    foreach ($season['qualities'] as $quality_index => $quality) {
                                        ?>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header"
                                                id="headingQuality<?php echo $season_index; ?>_<?php echo $quality_index; ?>">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseQuality<?php echo $season_index; ?>_<?php echo $quality_index; ?>"
                                                    aria-expanded="false"
                                                    aria-controls="collapseQuality<?php echo $season_index; ?>_<?php echo $quality_index; ?>">
                                                    <div class="quality"> کیفیت: <?php echo esc_html($quality['name']); ?></div>
                                                    <?php echo isset($quality['subtitle']) && $quality['subtitle'] ? '<div class="subtitle">زیرنویس</div>' : ''; ?>
                                                </button>

                                            </h2>
                                            <div id="collapseQuality<?php echo $season_index; ?>_<?php echo $quality_index; ?>"
                                                class="accordion-collapse collapse"
                                                aria-labelledby="headingQuality<?php echo $season_index; ?>_<?php echo $quality_index; ?>"
                                                data-bs-parent="#qualityAccordion<?php echo $season_index; ?>">
                                                <div class="accordion-body">
                                                    <?php
                                                    if (!empty($quality['episodes'])) {
                                                        echo '<ul>';
                                                        foreach ($quality['episodes'] as $ep_index => $episode) {
                                                            ?>
                                                            <div class="episode-container">
                                                                <a href="<?php echo $episode['link'] ?>">قسمت <?php echo $ep_index + 1 ?></a>
                                                            </div>
                                                            <?php
                                                        }
                                                        echo '</ul>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }

            echo '</div>'; // End of seasonAccordion
            echo '</div>'; // End of accordion-body
            echo '</div>'; // End of collapseOne
            echo '</div>'; // End of accordion-item
        }
    }
}
?>

<!-- ============================  end download link ============================   -->