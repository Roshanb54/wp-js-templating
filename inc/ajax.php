<?php
//Ajax Code To Run For Old Way of Loading Posts
add_action('wp_ajax_digthis_get_posts', 'digthis_get_posts');
add_action('wp_ajax_nopriv_digthis_get_posts', 'digthis_get_posts');
function digthis_get_posts(){
	$paged = $_GET['paged'];

	$args =  array(
				'post_type' => 'post',
				'posts_per_page' => 10,
				'paged' => $paged
			 );
	$data = array();
	$myposts = new WP_Query($args);
		while( $myposts->have_posts() ): $myposts->the_post();
			$title   = get_the_title();
			$author  = get_the_author();
			$content = get_the_content();
			$data[]  = array( 'title' => $title, 'author' => $author , 'content' => $content );
		endwhile;
	wp_reset_postdata();
	wp_send_json($data );
}