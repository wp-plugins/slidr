<?php 

	/* 
		Main variables.
	*/
	$size 			= $a['size'];
	$default_style 	= slidr('style') 		=== 'default' 	? ' default' : ''; 
	$cycle		 	= $a['cycle']		 	=== 'yes' 		? ' slidr-cycle' : ''; 
	$nav_prev 		= slidr('nav_prev') 	!== '&#8249;' 	? slidr('nav_prev') : '&#8249;'; 
	$nav_next 		= slidr('nav_next') 	!== '&#8250;'	? slidr('nav_next') : '&#8250;'; 
	$ie_fix 		= $a['info_box'] 		=== 'yes'		? '" aria-haspopup="true' : ''; 
	$thumb 			= $a['thumb'] 			=== 'yes' 		? $ie_fix : ' no-thumb';
	$nav_hidden 	= $a['nav'] 			=== 'hide'		? ' slidr-nav-hidden' : '';

	/*
		Custom size per Carousel.
	*/
	$height = filter_var($a['height'], FILTER_SANITIZE_NUMBER_INT);
	if( slidr('height') !== $height ) {
		$container_height 	= $height + 40;
		$item_max_height 	= slidr('style') === 'default' ? $height - 10 : $height;
		$nav_position 		= $height / 2 - 25;

		$car_style = ' style="height:' . $height . 'px;"';
		$con_style = ' style="height:' . $container_height . 'px;"';
		$nav_style = ' style="top:' . $nav_position . 'px;"';

		if( $a['thumb'] !== 'yes' ) {
			$item_style 	= 'style="width:'.$height.'px; height:'.$height.'px;"';
			$img_max_height = '';
		} else {
			$item_style 	= ' style="max-height:' . $item_max_height . 'px;"';
			$img_max_height =  ' style="height:' . $item_max_height . 'px;"';
		}
	} else {
		$car_style 		= '';
		$con_style 		= '';
		$nav_style 		= '';
		$item_style 	= '';
		$img_max_height = '';
	}

	/*
		The HTML Markup.
	*/
	$html5		= current_theme_supports( 'html5', 'gallery' );
	$itemtag 	= $html5 && $a['thumb'] === 'yes' ? 'figure' 	: 'dl';
	$icontag 	= $html5 && $a['thumb'] === 'yes' ? 'div' 		: 'dt';

	$open_slidr 	= '<div class="slidr-container ' . $a['class'] . $default_style . $cycle . '"' . $car_style . '>
						<span class="slidr-nav-prev slidr-nav' . $nav_hidden . '"' . $nav_style . '>
							' . $nav_prev . '
						</span>
						<div class="slidr-items-container"' . $con_style . '>
								<div class="slidr-items">';
	$o_slidr_item 	= '<'.$itemtag.' class="slidr-item' . $thumb . '"' . $item_style . '>
						<'.$icontag. $img_max_height . '>';
	$c_icontag 		= '</'.$icontag.'>';
	$c_slidr_item 	= '</'.$itemtag.'>';
	$close_slidr 	= '</div>
						</div>
						<span class="slidr-nav-next slidr-nav' . $nav_hidden . '"' . $nav_style . '>
							' . $nav_next . '
						</span>
					</div>';
 ?>