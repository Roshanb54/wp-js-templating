<?php
//Ajax Code To Run For Old Way of Loading Posts
add_action('wp_ajax_digthis_get_posts', 'digthis_get_posts');
add_action('wp_ajax_nopriv_digthis_get_posts', 'digthis_get_posts');
function digthis_get_posts(){
	$paged = $_GET['page'];

	$args =  array(
				'post_type' => 'post',
				'paged' => $paged
			 );
	$data = array();
	$myposts = new WP_Query($args);
	if( $myposts->have_posts() ){
			while( $myposts->have_posts() ): $myposts->the_post();
				$title   = array( 'rendered' => get_the_title() );
				//$author  = array( 'rendered' => get_the_author() );
				$content = array( 'rendered' => get_the_content() );
				$data[]  = array( 'title' => $title, 'content' => $content );
			endwhile;
		wp_reset_postdata();
		wp_send_json($data );
	}else {
		wp_send_json_error();
	}

}