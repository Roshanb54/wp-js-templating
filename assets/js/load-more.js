jQuery( function($) {
	/*Load Posts on Page Load*/
	var page = 1;
	//load post on initial page load
	digthisLoadPosts(1);	

	$('.load-more').on('click', function(e){
		e.preventDefault();
		page = $(this).data('page');
		paged = page + 1;
		digthisLoadPosts(paged);
		$(this).data('page', paged);
	})

	function digthisLoadPosts(paged){
			$.ajax({
			type : "GET",
			url  : digthis.ajaxUrl,
			data : { action : 'digthis_get_posts', paged:paged },
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
	}

})
