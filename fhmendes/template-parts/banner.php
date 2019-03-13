<section style="background-image:url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID), full); ?>)" class="banner <?php if(!get_field('banner_galeria')) : ?> not-gallery <?php endif; ?>">
    <div class="container">
        <div class="content">
            <h2><?php echo get_the_title(); ?></h2>
            <?php get_template_part( 'template-parts/breadcrumbs' ); ?>
        </div>
    </div>
    <?php if(get_field('banner_galeria')) : ?>
        <div class="banner-slider owl-carousel owl-theme">
            <?php 
                $images = get_field('banner_galeria');
                foreach ($images as $key => $value) {
                    $image = (isset($value['url'])) ? $value['url'] : '';
                    ?>
                        <div class="item"><img src="<?php echo $image; ?>"/></div>
                    <?php 
                }
            ?>
        </div>
    <?php else : ?>
        <img width="100%" src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID), full); ?>" />
    <?php endif; ?>
</section>