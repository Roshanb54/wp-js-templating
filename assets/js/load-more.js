// use $ to represent jQuery
$ = jQuery;
/**
 * [digthisLoadPosts description]
 * @param  {[int]} paged [page number to pull]
 */
function digthisLoadPosts(url, paged){
			$.ajax({
			type : "GET",
			url  : url,
			data : { action : 'digthis_get_posts', page:paged },
			beforesend: function(){
			},
			success: function( response ){
				if( response.success == false || response == '' || response == undefined ){
					$( '.load-more' ).remove();
					alert('no more posts to load');
				}
				else{
					var post_template = wp.template( 'multiple-posts' );
					$('.digthis-posts-wrapper').append( post_template(response) );
					$('.load-more').attr('disabled', false);
				}

			},
	    	error: function(MLHttpRequest, textStatus, errorThrown){  
				console.log(errorThrown);  
			} 
		});
}

jQuery( function($) {
	var url = digthis.ajaxUrl;
	//var url = digthis.restUrl;
	/*Load Posts on Page Load*/
	var page = 1;
	//load post on initial page load
	digthisLoadPosts(url, page);	

	$('.load-more').on('click', function(e){
		e.preventDefault();
		$(this).attr('disabled', true);
		page = $(this).data('page');
		//increase post count by 1
		paged = page + 1;
		digthisLoadPosts(url, paged);
		$(this).data('page', paged);
	});

})