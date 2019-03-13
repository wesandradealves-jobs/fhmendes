<?php if ( have_posts () ) : while (have_posts()) : the_post(); ?>
<div class="content">
	<?php if((get_post_type() != 'page' && (get_the_category()[0]->slug && get_the_category()[0]->slug != 'apresentacoes-em-congressos' && get_the_category()[0]->slug != 'livros-editados')) || get_post_type() == 'procedimentos') : ?>
		<div class="post-thumbnail <?php echo get_post_type(); ?>" style="background-image:url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID), full); ?>)">
			<!--<?php get_template_part('template-parts/date'); ?>					-->
		</div>
	<?php endif; ?>
	<div class="post-content">
		<?php 
		    $video = get_field('video_procedimento'); 
		    if($video) :
		        ?>
		        <a href="<?php echo $video; ?>" class="video btn btn-2 play-content-video">Assista ao Vídeo</a>
		        <?php 
		    endif;
		    
			the_content();

			if(get_field('galeria')) :
				echo '<div class="galeria owl-carousel owl-theme">';
				$galeria = get_field('galeria');
				foreach ($galeria as $key => $imagem) :
					echo '<a class="item" style="background-image:url('.$imagem['url'].')" data-lightbox="galeria" href="'.$imagem['url'].'" title="'.$imagem['title'].'"></a>';
				endforeach;
				echo '</div>';
			endif;
		?>
	</div>
	<?php if(get_post_type() != 'page') : 
            echo '
            <ul class="single-navigation">';
                if(get_previous_post()->ID) :
                    echo '
                    <li>
                        <i class="fa fa-angle-left"></i>
                        <a class="prev" href="'.esc_url( get_permalink( get_previous_post()->ID ) ).'" title="Post Anterior"><small>Anterior</small>'.esc_attr( get_previous_post()->post_title ).'</a>
                    </li>';
                endif; 
                if(get_next_post()->ID) :
                    echo '
                    <li>
                        <a class="next" href="'.esc_url( get_permalink( get_next_post()->ID ) ).'" title="Próximo Post"><small>Próximo</small>'.esc_attr( get_next_post()->post_title ).'</a>
                        <i class="fa fa-angle-right"></i>
                    </li>';
                endif; 
            echo '</ul>';
            
                    $tax_query = array('relation' => 'AND');
                    $tax_query[] =  array(
                        'taxonomy' => 'category',
                        'field'=> 'slug',
                        'terms'=> "'".get_the_category()[0]->slug."'",
                        'operator'=> 'IN'
                    );               

		   	$related = new WP_Query( array(
		        'post_type'              => array( "'".get_post_type()."'" ),
		        'tax_query' => $tax_query,
		        'posts_per_page' => 4,  
		        'post__not_in' => array( get_the_id() ),
		        'order' => ASC,
		    ) );             
		    if ( $related->have_posts() ) : 
	?>
	<div>
		<h5 class="inner-session-title"><span>Artigos Relacionados</span></h5>
		<ul class="artigos-recentes -relacionados">
			<?php while ( $related->have_posts() ) : $related->the_post(); ?>
			<li>
				<div style="background-image:url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID), full); ?>)"></div>
				<div>
					<a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
					<span>
						<small><?php //echo get_the_date(); ?></small>
					</span>
				</div>
			</li>			
			<?php endwhile; ?>																				
		</ul>
	</div>
	<?php endif; 
	wp_reset_postdata(); ?>		
	<?php endif; ?>					
</div>
<?php endwhile;
endif; ?>