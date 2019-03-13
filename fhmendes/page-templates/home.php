<?php /* Template Name: Home */
    get_header(); 
    global $post;
    $banners = new WP_Query( array(
        'post_type'              => array( 'banners' ),
        'posts_per_page' => 3,  
        'order' => DESC,
    ) );
    $pags = new WP_Query( array(
        'post_type'              => array( 'page' ),
        'posts_per_page' => -1,  
        'order' => DESC,
    ) );
    $procedimentos = new WP_Query( array(
        'post_type'              => array( 'procedimentos' ),
        'posts_per_page' => 6,  
        'order' => ASC,
    ) );     
?>
<?php if ( $banners->have_posts() ) : ?>
    <section class="webdoor">
        <div class="owl-wrapper">
            <div class="owl-carousel owl-theme">
                <?php 
                    $i = -1;
                    while ( $banners->have_posts() ) : ++$i; 
                      $banners->the_post();
                      echo '<div data-hash="'.$i.'" class="item">';
                            // echo '.( (get_field('custom_url')) ? '<a href="'.get_field('custom_url').'"></a>' : '' ).'
                            echo '<a href="'.( (get_field('custom_url')) ? get_field('custom_url') : '' ).'"><img src="'.wp_get_attachment_url(get_post_thumbnail_id($post->ID), full).'" width="100%" /></a>';
                      echo '</div>';
                    endwhile;
                ?>
            </div>                  
        </div>
        <div class="container">
            <div class="owl-thumbs">
                <?php 
                    $i = -1;
                    while ( $banners->have_posts() ) : ++$i; 
                      $banners->the_post();
                        echo '
                        <a '.( ($i == 0) ? 'class="-active"' : '' ).' href="#'.$i.'">
                            <span style="background-image:url('.wp_get_attachment_url(get_post_thumbnail_id($post->ID), full).')"></span>  
                        </a> ';
                    endwhile;
                ?>
            </div>  
        </div>
    </section>
<?php endif; 
wp_reset_postdata();
wp_reset_query(); ?> 
<?php if ( $pags->have_posts() ) : ?>
<section class="dr-flavio">
    <div class="container">
        <?php 
            $avatar = get_field('imagem_fh_mendes');
            while ( $pags->have_posts() ) : 
                $pags->the_post();
                if($post->post_name == 'dr-flavio-mendes') :
                    echo ($avatar) ? '<div style="background-image: url('.$avatar.')"></div>' : '';
                    echo '
                        <div>
                            <h2>Perfil Profissional - '.get_the_title().'</h2>
                            <p>'.( (get_the_excerpt()) ? get_the_excerpt() : '' ).'</p>
                            <a href="'.get_the_permalink().'" class="btn btn-1" title="Saiba Mais">Saiba Mais</a>
                        </div>';
                endif;
            endwhile;
        ?>
    </div>
</section>
<?php endif; 
wp_reset_postdata();
wp_reset_query(); ?> 
<?php if ( $procedimentos->have_posts() ) :  ?>
<section class="procedimentos">
    <div class="container">
    <h3><span>Procedimentos</span></h3>
        <ul class="procedimento">
            <?php 
                while ( $procedimentos->have_posts() ) : 
                  $procedimentos->the_post();
                    echo '<li onclick="document.location='."'".get_the_permalink()."'".';return false;">
                    <div style="background-image: url('.wp_get_attachment_url(get_post_thumbnail_id($post->ID), full).')">
                                <h4><span>'.get_the_title().'</span></h4>
                    </div>
            </li>';
                endwhile;
            ?>
        </ul>
    </div>
</section>
<?php endif; 
wp_reset_postdata();
wp_reset_query();
?>
<?php get_footer(); ?>