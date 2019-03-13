<?php /* Template Name: Archive */
    get_header(); 
    $str = explode('/', $_SERVER['REQUEST_URI']);
    if($str[1] == 'publicacoes'){
        $str = 'publicacao';
    }
?> 
<?php get_template_part('template-parts/banner'); ?>
<div class="columns">
    <div class="container">
        <div class="content">
            <!---->
            <?php if(get_field('resumo')) : ?>
            <div class='resumo'><?php echo get_field('resumo'); ?></div>
            <?php endif; ?>
            <!---->
            <ul class="feed -archive <?php echo '-'.$post->post_name; ?>">
                <?php 
                    $tax_query = array('relation' => 'AND');
                    $tax_query[] = array(array(
                        'taxonomy' => 'category',
                        'field'=> 'slug',
                        'terms'=> $str,
                        'operator'=> 'IN'
                    ));                      
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $get_posts = new WP_Query( array(
                        'tax_query' => $tax_query,
                        'paged' =>  $paged,
                        'posts_per_page' => 9,  
                        'order' => ASC,
                    ) );
                    while ($get_posts->have_posts()) : $get_posts->the_post();
                ?>
                    <li>
                        <div>
                            <?php get_template_part('template-parts/zoom-thumb'); ?>
                            <h2><?php echo get_the_title(); ?></h2>
                            <?php
                                // $pdf = wp_get_attachment_url( get_post_meta($post->ID, 'arquivo_pdf', true) );
                                $obj = get_field_object('arquivo_pdf', $post->ID);
                                
                                foreach($obj as $key=>$value){
                                    if($key == 'value') : 
                                        $pdf = $value;
                                    endif;
                                }                                

                                if(get_the_category()[0]->slug != 'videos') : 
                                    if($pdf) : 
                                        $url = $pdf;
                                        $target = '_blank';
									elseif(get_field('custom_url')) :
										$url = get_field('custom_url');     
										$target = '_blank';
                                    else :
                                        $url = get_the_permalink();
                                    endif;
                                else : 
                                    if(get_field('video_externo_url')) : 
                                        $url = get_field('video_externo_url');
                                    else : 
                                        $url = get_field('video_upload');
                                    endif;
                                endif;
                            ?>									
                            <?php if(get_the_excerpt()) : ?>
                                <p><?php echo get_the_excerpt(); ?></p>
                            <?php endif; ?>
                            <a <?php echo ($target) ? "target=".$target : ''; ?> class="leia-mais <?php echo (get_the_category()[0]->slug == 'videos') ? 'video' : ''; ?>" href="<?php echo $url; ?>"><?php if(get_the_category()[0]->slug != 'videos') : ?> Leia Mais <?php else : ?> Assista <?php endif; ?> <i>&#9654;</i></a>
                        </div>
                    </li> 
                <?php endwhile; ?>
            </ul>
            <?php 
                if( intval($get_posts->max_num_pages) > 1) :
                    echo '<ul class="pagination">';
                    echo '<li><a '.( (!get_query_var('paged')) ? 'hidden' : '' ).' class="prev" href="'.home_url( $wp->request.'/?paged='.( (get_query_var('paged')) ? (intval(get_query_var('paged')) - 1) : '' ) ).'">➔</a></li>';
                        for ($i = 1; $i <= intval($get_posts->max_num_pages); $i++) {
                            echo '<li '.( ($i === get_query_var('paged')) ? 'class="active"' : '' ).'><a  href="'.home_url( $wp->request.'/?paged='.$i ).'">'.$i.'</a></li>';
                        }
                        echo '<li '.( (get_query_var('paged') == intval($get_posts->max_num_pages)) ? 'hidden' : '' ).'><a class="next" href="'.home_url( $wp->request.'/?paged='.( (get_query_var('paged')) ? (intval(get_query_var('paged')) + 1) : '2' ) ).'">➔</a></li>';
                    echo '</ul>'; 
                endif; 
            ?>               
        </div>
    </div>
</div>
<?php get_footer(); ?>