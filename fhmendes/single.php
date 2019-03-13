<?php get_header(); ?>
	<?php 
		if(get_post_type() != 'procedimentos' && (get_the_category()[0]->slug && get_the_category()[0]->slug != 'apresentacoes-em-congressos' && get_the_category()[0]->slug != 'livros-editados')) :
			get_template_part('template-parts/banner'); 
		endif;
	?>	
	<div class="columns">
		<div class="container">
			<?php 
				require dirname(__FILE__)."/class/_post-content.class.php";
				if(get_sidebar('blog')) : 
					get_sidebar('blog');
				endif;
			?>					
		</div>
	</div>	
<?php get_footer(); ?>