<?php /* Template Name: Blog */
    get_header(); 
    $str = explode('/', $_SERVER['REQUEST_URI']);
?> 
<?php get_template_part('template-parts/banner'); ?>
<div class="columns">
    <div class="container">
        <div class="content">
            <ul class="feed -simple-feed">
                <?php 
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $str = ($str[1] == 'procedimentos') ? $str[1] : 'post';
                    
                    $get_posts = new WP_Query( array(
                        'post_type' => array( $str ),
                        'paged' =>  $paged,
                        'posts_per_page' => -1,  
                        'order' => ASC,
                    ) );                    
                    while ($get_posts->have_posts()) : $get_posts->the_post();
                                       $obj = get_field_object('arquivo_pdf', $post->ID);
                                        
                                        foreach($obj as $key=>$value){
                                            if($key == 'value') : 
                                                $pdf = $value;
                                            endif;
                                        }      
                                        
										if($pdf) : 
											$url = $pdf;
											$target = '_blank';
										elseif(get_field('custom_url')) :
										    $url = get_field('custom_url');
										    $target = '_blank';
										else :
											$url = get_the_permalink();
										endif;                    
                        ?>
                        <li>
                            <?php 
                                get_template_part('template-parts/zoom-thumb'); 
                            ?>
                            <div>
                                <h6 class="title">
                                    <a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                                    <?php if($post_type != 'procedimentos') : ?>
                                    <ul class="tags">
                                    <?php
                                    $posttags = get_the_tags();
                                    if ($posttags) : ?>
                                            <?php 
                                      foreach($posttags as $tag) {
                                        echo '<li><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></li>';
                                      }
                                      ?>
                                      <?php
                                    endif;
                                    ?>  
                                    <li class="author">
                                        Por: <?php the_author(); ?>                                        
                                    </li>
                                    </ul>      
                                    <?php endif; ?>                          
                                </h6>
                                <?php if(get_the_excerpt()) : ?>
                                <p class="description"><?php echo get_the_excerpt(); ?></p>
                                <?php endif; ?>
                                <a <?php echo ($target) ? "target=".$target : ''; ?> class="leia-mais" href="<?php echo $url; ?>">Leia Mais <i>&#9654;</i></a>
                            </div>
                        </li>  
                <?php
                    endwhile;
                    wp_reset_postdata();
                ?>
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
        <?php 
            if(get_sidebar('blog')) : 
                get_sidebar('blog');
            endif;
        ?>  					
    </div>
</div>
<?php 
    if($post_type == 'procedimentos') :
        echo "<style> .date{ display: none; } </style>";
    endif;
?>
<?php get_footer(); ?>