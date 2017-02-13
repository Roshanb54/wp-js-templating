<?php
function digthis_show_posts( $atts ) {
	// $atts = shortcode_atts( array(
	// 	'default' => 'values'
	// ), $atts );
	wp_enqueue_script( 'digthis-load-more-js' );
	ob_start();
	?>
	<style type="text/css">
		.post{
			clear: both;
		}
		.load-more{
			margin-top: 10px;
		}
	</style>
		<div class="digthis-posts-wrapper">

		</div>
		<div class="digthis-btn-wrapper" style="width:100%; clear:both;">
			<input type="button" class="load-more" value="load more" data-page="1">
		</div>
		<script type="text/html" id="tmpl-multiple-posts">
		<#  _.each( data, function(data){ #>
			<article class="post" >
				<header class="entry-header">
					<h1 class="entry-title">{{ data.title }}</h1>
					<span class="entry-author">{{ data.author }}</span>
				</header>
				<div class="entry-content">
					{{{ data.content }}}
				</div>
			</article>
		<# }); #>
		</script>
	<?php
	return ob_get_clean();
}
add_shortcode( 'digthis_show_posts','digthis_show_posts' );
