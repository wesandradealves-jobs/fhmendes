<?php get_header(); ?>
	<?php
		get_template_part('template-parts/banner'.((str_replace('.php', '', basename( get_page_template() )) != page) ? '-title' : '')); 
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