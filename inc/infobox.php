<?php 
	/*
		The infobox content. You can override the output by redeclaring the function in your theme's functions.php like so:

			function slidr_custom_content( $link, $title, $excerpt, $a ) {
				echo "Your custom output here.";
			}		
	*/
	function slidr_infobox( $link = null, $title = null, $excerpt = null, $a = null ) {
		if ( ! function_exists( 'slidr_custom_content' ) ) {
			$html5		= current_theme_supports( 'html5', 'gallery' );
			$captiontag = $html5 && $a['thumb'] === 'yes' ? 'figcaption' : 'dd';
			return '<'.$captiontag.' class="slidr-item-info">
						<div class="slidr-info-hover">
							<h2>
								<a href="' . $link . '" rel="bookmark">' . $title . '</a>
							</h2>' . $excerpt . 
						'</div>
					</'.$captiontag.'>';
		} else {
			ob_start();
				slidr_custom_content( $link, $title, $excerpt, $a );
			return ob_get_clean();
		}
	}

 ?>