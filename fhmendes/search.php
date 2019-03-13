<?php get_header(); ?>

	<section class="banner -archive">
		<div class="container">
			<h2><?php
    printf( '<span>Resultados de busca para "<strong>' . ( (isset($_GET['s'])) ? $_GET['s'] : '' ) . '</strong>"</span>' );
?></h2>
		</div>
	</section>
	<div class="columns">
		<div class="container">
			<div class="content">
				<ul class="feed -archive">
				    <?php if ( have_posts () ) :
				        while (have_posts()) : the_post();  
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
							<div>
								<?php get_template_part('template-parts/zoom-thumb'); ?>
								<h2><?php echo get_the_title(); ?></h2>
								<?php if(get_the_excerpt()) : ?>
									<p><?php echo get_the_excerpt(); ?></p>
								<?php endif; ?>
								<a <?php echo ($target) ? "target=".$target : ''; ?> class="leia-mais" href="<?php echo $url; ?>">Leia Mais <i>&#9654;</i></a>
							</div>
						</li> 
				    <?php endwhile; 
					endif; ?>
				</ul>
            <?php 
                if( intval($wp_query->max_num_pages) > 1) :
                    echo '<ul class="pagination">';
                    echo '<li><a '.( (!get_query_var('paged') || get_query_var('paged') == 1) ? 'hidden' : '' ).' class="prev" href="'.home_url( $wp->request.'/?s='.get_query_var('s').'&paged='.( (get_query_var('paged')) ? (intval(get_query_var('paged')) - 1) : '' ) ).'">➔</a></li>';
                        for ($i = 1; $i <= intval($wp_query->max_num_pages); $i++) {
                            echo '<li '.( ($i === get_query_var('paged')) ? 'class="active"' : '' ).'><a  href="'.home_url( $wp->request.'/?s='.get_query_var('s').'&paged='.$i ).'">'.$i.'</a></li>';
                        }
                        echo '<li '.( (get_query_var('paged') == intval($wp_query->max_num_pages)) ? 'hidden' : '' ).'><a class="next" href="'.home_url( $wp->request.'/?s='.get_query_var('s').'&paged='.( (get_query_var('paged')) ? (intval(get_query_var('paged')) + 1) : '2' ) ).'">➔</a></li>';
                    echo '</ul>'; 
                endif; 
            ?>					
			</div>
		</div>
	</div>
<?php get_footer(); ?>