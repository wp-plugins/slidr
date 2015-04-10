<?php 
	/* 
		Function to get the content for each item. 
		To be used inside plugin's shortcode.php like so: 

		echo item_content( $link, $content, $a ); 

	*/
	function item_content( $link = null, $content = null, $a = null ) {
		ob_start();
		if( $a['img_link'] 	!== 'no' ) {
			echo '<a href="' . $link . '" rel="bookmark">';
			echo $content;
			echo '</a>';
		} else {
			echo $content;
		}
		return ob_get_clean();
	}
 ?>