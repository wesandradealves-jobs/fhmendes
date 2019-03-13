<!DOCTYPE html>
<html <?php language_attributes(); $lang = explode("lang=",get_language_attributes()); ?>>
  <head>
    <title><?php echo (is_single() ? get_bloginfo('title')." - ".get_the_title() : get_bloginfo('title')); ?></title>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-language" content="<?php echo str_replace('"','',$lang[1]); ?>" />
    <meta name="language" content="<?php echo str_replace('"','',$lang[1]); ?>" />
    <meta property="og:locale" content="<?php echo str_replace('"','',$lang[1]); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo (is_single() ? get_bloginfo('title')." - ".get_the_title() : get_bloginfo('title')); ?>" />
    <meta property="og:description" content="<?php echo get_bloginfo('description'); ?>" />
    <meta property="og:url" content="<?php echo site_url(); ?>" />
    <meta property="og:site_name" content="<?php echo get_bloginfo('title'); ?>" />
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/screenshot.png" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="true">
    <?php wp_meta(); ?>
    <link rel="canonical" href="<?php echo site_url(); ?>" />
    <?php wp_head(); ?>
  </head>
  <body   
  <?php
    if (is_front_page()) {
      echo 'class="pg-home"';
    } else if(is_archive()){
      echo 'class="pg-archive pg-interna"';
    } else if(is_category()){
      echo 'class="pg-category pg-interna"';
    } else if(is_search()){
      echo 'class="pg-search pg-interna"';
    } else if(is_single()){
      echo 'class="pg-single pg-interna"';
    } else if(is_404()){
      echo 'class="pg-404 pg-interna"';
    } else {
      echo 'class="pg-interna pg-'.str_replace(' ','-',strToLower(get_the_title())).' page_id_'.$post->ID.'"';
    }
    ?>>  
    <div id="wrap">
    <nav class="mobile-navigation">
				<div>
						<button onclick="_mobileNavigation(this)" type="button" class="tcon tcon-menu--xcross" aria-label="toggle menu">
								<span class="tcon-menu__lines" aria-hidden="true"></span>
								<span class="tcon-visuallyhidden">toggle menu</span>
						</button> 				
						<ul class="menu">
							<?php wp_nav_menu( array( 'container' => false, 'menu' => 'navigation', 'items_wrap' => '%3$s', 'container_class'=>'mobile-navigation' ) ); ?>
						</ul>
						<div>
								<?php if ( get_theme_mod('telefone') || get_theme_mod('email') ) : ?>
									<?php if(get_theme_mod('telefone')) : ?><p><a href="tel: <?php echo get_theme_mod('telefone');  ?>"><?php echo get_theme_mod('telefone');  ?></a></p><?php endif; ?>
									<?php if(get_theme_mod('email')) : ?><p><a href="mailto: <?php echo get_theme_mod('email');  ?>"><?php echo get_theme_mod('email');  ?></a></p><?php endif; ?>
								<?php endif; ?>
                <?php get_template_part( 'template-parts/social-media' ); ?>														
						</div>
				</div>
			</nav>
      <header class="header">
      	<div class="container">
      		<h1 class="logo">
						<a class="logo-anchor" href="<?php echo site_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) )." - ".get_bloginfo('description'); ?>">
								<?php if(get_theme_mod('logo')) : ?>
										<img height="20" src="<?php echo get_theme_mod('logo'); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) )." - ".get_bloginfo('description'); ?>">
								<?php else : ?>
										<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>
								<?php endif; ?>
						</a> 
      		</h1>
      		<nav class="navigation">
            <div class="contact">
              <?php get_template_part( 'template-parts/social-media' ); ?>  
              <?php if(get_theme_mod('telefone')) : ?>
                <p><span><?php echo get_theme_mod('telefone'); ?></span></p>
              <?php endif; ?>
            </div>
      			<ul>
							<?php wp_nav_menu( array( 'container' => false, 'menu' => 'navigation', 'items_wrap' => '%3$s', 'container_class'=>'navigation-default' ) ); ?>
      			</ul>
      		</nav>
      	</div>
      </header>
      <main class="main">