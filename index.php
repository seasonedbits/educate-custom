<?php
/**
 * The main index template file
 * */
get_header();
?>
<?php global $educate_options; ?>
<section>
    <!--removed breadcrumb-->

    <!-- carousel copied from front-page template -->
    <div id="educatecarousel" class="carousel slide educate-slider" data-interval="3000" data-ride="carousel">
        <!-- Carousel indicators -->

        <!-- Carousel items -->
        <div class="carousel-inner">
            <?php
            $educate_slider_count = 0;
            for ($educate_loop = 0; $educate_loop < 5; $educate_loop++):
                ?>
                <?php
                if (!empty($educate_options['slider-img-' . $educate_loop])) {
                    $educate_slider_count++;
                    if ($educate_slider_count == 1)
                        $educate_class = ' active';
                    else
                        $educate_class = '';
                    $educate_image = getimagesize($educate_options['slider-img-' . $educate_loop]);
                    ?>
                    <div class="item<?php echo $educate_class; ?>">
                        <span class="mask-overlay"></span><img src="<?php echo esc_url($educate_options['slider-img-' . $educate_loop]); ?>"  width="<?php echo $educate_image[0]; ?>" height="<?php echo $educate_image[1]; ?>" alt="<?php echo $educate_loop; ?>">
                        <?php if ((!empty($educate_options['slider-title-' . $educate_loop])) || (!empty($educate_options['slidercontent-' . $educate_loop]))): ?>
                            <div class="carousel-caption">
                                <h3>
                                    <?php if ((!empty($educate_options['slider-title-' . $educate_loop]))) echo esc_attr($educate_options['slider-title-' . $educate_loop]); ?>
                                </h3>
                                <p>
                                    <?php if ((!empty($educate_options['slidercontent-' . $educate_loop]))) echo esc_attr($educate_options['slidercontent-' . $educate_loop]); ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php } ?>
            <?php endfor; ?>
        </div>
        <!-- Carousel nav -->
        <?php if ($educate_slider_count > 1) { ?>
            <a class="carousel-control left" href="#educatecarousel" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left carousel-control-left"></span> </a> <a class="carousel-control right" href="#educatecarousel" data-slide="next"> <span class="glyphicon glyphicon-chevron-right carousel-control-right"></span> </a>
        <?php } ?>
    </div>
    <!--carousel end-->

    <!-- about-us copied from front-page template -->
    <?php if (!empty($educate_options['about-title']) || !empty($educate_options['about-sub-title']) || !empty($educate_options['about-detail'])) { ?>
        <!--about-us start-->
        <div class="educate-container container">
            <div class="about-us">
                <div class="title-box">
                    <?php
                    if (!empty($educate_options['about-title'])) {
                        echo '<h2 class="content-heading"> <span> ' . esc_attr($educate_options['about-title']) . ' </span> </h2>';
                    }
                    if (!empty($educate_options['about-sub-title'])) {
                        echo '<p class="sub-content">' . esc_attr($educate_options['about-sub-title']) . '</p>';
                    }
                    if (!empty($educate_options['about-detail'])) {
                        echo '<p class="aboutus-detail">' . esc_attr($educate_options['about-detail']) . '</p>';
                    };
                    ?>
                </div>
            </div>
        </div>
    <?php }
    ?>
    <div class="educate-container container">
        <div class="about-us-content" id="about-slider">
            <?php
            for ($educate_j = 1; $educate_j <= 5; $educate_j++):
                if (!empty($educate_options['about-icon-' . $educate_j]) && !empty($educate_options['abouttitle-' . $educate_j]) && !empty($educate_options['aboutdesc-' . $educate_j])):
                    echo '<div class="owl-item">'
                    . '<div class="about-us-box item">'
                    . '<div class="col-md-9 col-xs-8 about-info">'
                    . '<h2>' . esc_attr($educate_options['abouttitle-' . $educate_j]) . '</h2>'
                    . '<p>' . $educate_options['aboutdesc-' . $educate_j] . '</p>'
                    . '</div>'
                    . '<div class="col-md-3 col-xs-4 about-info-icon">'
                    . '<span class="fa ' . esc_attr($educate_options['about-icon-' . $educate_j]) . '"></span>'
                    . '</div></div></div>';
                endif;
            endfor;
            ?>
        </div>
    </div>
    <!--about-us end-->

    <?php get_template_part('content', get_post_format());
    ?>
</section>
<?php get_footer(); ?>
