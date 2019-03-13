			<aside class="sidebar -blog">
				<div>
					<form role="search" method="get" id="searchform" class="search-bar" action="<?php echo site_url('?s='.$_GET['s']); ?>">
						<div>
							<span>
								<input placeholder="digite uma palavra" type="text" value="" name="s" id="s" />
							</span>
							<span>
								<button class="fa fa-search"></button>
							</span>
						</div>
					</form>
				</div>
				<?php 
    				$tax_query[] =  array(
    					'taxonomy' => 'category',
    					'field'=> 'slug',
    					'terms'=> 'apresentacoes-em-congressos',
    					'operator'=> 'IN'
    				);				
				   	$latest = new WP_Query( array(
				        'post_type'              => array( 'post' ),
				        'posts_per_page' => 4,  
				        'post__not_in' => array( get_the_id() ),
				        'tax_query' => $tax_query,
				        'order' => ASC,
				    ) );             
				    if ( $latest->have_posts() ) : 
				?>
				<div>
					<h4>Apresentações em Congresso</h4>
					<ul class="artigos-recentes">
		                <?php 
		                    while ( $latest->have_posts() ) : ++$i; 
		                      $latest->the_post();
		                                $pdf = wp_get_attachment_url( get_post_meta($post->ID, 'arquivo_pdf', true) );
										if($pdf) : 
											$url = $pdf;
										elseif(get_field('custom_url')) :
										    $url = get_field('custom_url');
										else :
											$url = get_the_permalink();
										endif;		                      
		                      echo '<li>
								<div style="background-image:url('.wp_get_attachment_url(get_post_thumbnail_id($post->ID), full).')"></div>
								<div>
									<a href="'.$url.'">'.get_the_title().'</a>
									<span>
										<small></small>
									</span>
								</div>
							</li> ';
		                    endwhile;
		                ?>
																		
					</ul>
				</div>
				<?php endif; 
				wp_reset_postdata();  ?>
				<div>
					<h4>Categorias</h4>
					<ul class="categorias">
						<?php 
							$variable = wp_list_categories( array(
								'taxonomy'            => 'category',
							    'echo' => true,
							    'show_count' => true,
							    'hide_empty' => true,
							    'title_li' => ''
							) );
							 
							$variable = preg_replace( '~\((\d+)\)(?=\s*+<)~', '$1', $variable );
							echo $variable;
						?>		
					</ul>
				</div>						
			</aside>	