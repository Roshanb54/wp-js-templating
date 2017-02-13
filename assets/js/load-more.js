jQuery( function($) {
	/*Load Posts on Page Load*/
	// var restfull_url = 'http://202.166.207.19/c/digamber/jstemplating/wp-json/wp/v2/posts/?per_page=10';
	// var ajax_url = "<?php echo admin_url('admin-ajax.php' ); ?>"
	//console.log(  )
	
	$.ajax({
		type : "GET",
		url  : digthis.ajaxUrl,
		data : { action : 'digthis_get_posts' },
		beforesend: function(){

		},
		success: function( response ){
			var post_template = wp.template( 'multiple-posts' );
			$('.digthis-posts-wrapper').append( post_template(response) );
		},
    	error: function(MLHttpRequest, textStatus, errorThrown){  
			console.log(errorThrown);  
		} 
	});
})