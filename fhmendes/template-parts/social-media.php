								<?php if ( get_theme_mod('telegram') || get_theme_mod('git') || get_theme_mod('facebook') || get_theme_mod('linkedin') || get_theme_mod('instagram') || get_theme_mod('twitter') || get_theme_mod('pinterest') || get_theme_mod('rss') ) : ?>
									<ul class="social-networks">
											<?php if ( get_theme_mod('facebook') ) : ?>
											<li>
													<a href="<?php echo get_theme_mod('facebook');  ?>" title="Facebook" target="_blank"><i class="fa fa-facebook-f"></i></a>
											</li>
											<?php endif; ?>
											<?php if ( get_theme_mod('twitter') ) : ?>
											<li>
													<a href="<?php echo get_theme_mod('twitter');  ?>" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a>
											</li>
											<?php endif; ?>
											<?php if ( get_theme_mod('googleplus') ) : ?>
											<li>
													<a href="<?php echo get_theme_mod('googleplus');  ?>" title="Google Plus" target="_blank"><i class="fa fa-google-plus"></i></a>
											</li>
											<?php endif; ?>        
											<?php if ( get_theme_mod('instagram') ) : ?>
											<li>
													<a href="<?php echo get_theme_mod('instagram');  ?>" title="Instagram" target="_blank"><i class="fa fa-instagram"></i></a>
											</li>
											<?php endif; ?>
									</ul>
							 <?php endif; ?>	