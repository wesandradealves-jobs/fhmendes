<?php 
	function get_breadcrumb() {
		if(get_post_type()) :
			$post_type = get_post_type();
		else : 
			$post_type = get_queried_object()->post_type;
		endif;

	    $breadcrumbs = '<div class="breadcrumbs">';
	    $breadcrumbs .= '<a href="'.home_url().'" rel="nofollow">Home</a>';
	    if($post_type && is_single() && get_post_type() != 'post') :
			$breadcrumbs .= '&nbsp;&nbsp;&#187;&nbsp;&nbsp; '.$post_type;
	    elseif(get_the_category()[0]->name) :
	    	$breadcrumbs .= '&nbsp;&nbsp;&#187;&nbsp;&nbsp; '.get_the_category()[0]->name;
	    endif;
	    $breadcrumbs .= (is_page() || is_single()) ? '&nbsp;&nbsp;&#187;&nbsp;&nbsp; '.get_the_title() : ''; 
	    $breadcrumbs .= '</div>';
	    echo $breadcrumbs;
}
?>