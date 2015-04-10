<?php 

	/*
		Sets the shortcode's default values.
	*/
	$height_def 		= slidr('height') !== '150' ? filter_var(slidr('height'), FILTER_SANITIZE_NUMBER_INT) : 150;
	$number_def 		= slidr('number') !== '10' ? filter_var(slidr('number'), FILTER_SANITIZE_NUMBER_INT) : 10;
	$category_def 		= slidr('category') !== '' ? slidr('category') : false;
	$gallery_def 		= slidr('gallery') !== 'no' ? slidr('gallery') : false;
	$gallery_link_def 	= slidr('gallery_link');
	$type_def 			= slidr('type') !== 'post' || slidr('type') !== '' ? slidr('type') : 'post';
	$orderby_def 		= slidr('orderby') !== 'date' || slidr('orderby') !== '' ? slidr('orderby') : 'date';
	$img_size_def		= slidr('img_size') !== 'thumbnail' || slidr('img_size') !== '' ? slidr('img_size') : 'thumbnail';
	$order_def 			= slidr('order');
	$thumb_def 			= slidr('thumb');
	$info_box_def 		= slidr('info_box');
	$excerpt_def 		= slidr('excerpt');
	$img_link_def 		= slidr('img_link');
	$nav_cycle_def 		= slidr('nav_cycle') != 0 ? 'yes' : false;
	$nav_buttons_def 	= slidr('nav_buttons') == 0 ? 'hide' : false;

	/* 
		Shortcode attributes. Use it like this:
		[slidr attribute="value"]
	*/
	$a = shortcode_atts( array(
		'type' 			=> $type_def, 					// [slidr type="page"]
		'height' 		=> $height_def,					// [slidr height="200"]
		'number' 		=> $number_def, 				// [slidr number=5]
		'category' 		=> $category_def, 				// [slidr category="2"]
		'parent' 		=> false, 						// [slidr parent="2"]
		'gallery'		=> $gallery_def,				// [slidr gallery="1,2,3"]
		'gallery_link' 	=> $gallery_link_def,			// [slidr gallery_link="attachment"]
		'sticky' 		=> get_option('sticky_posts'), 	// [slidr sticky="yes"]
		'orderby' 		=> $orderby_def,				// [slidr orderby="date"]
		'order' 		=> $order_def, 					// [slidr order="DESC"]
		'size' 			=> $img_size_def, 				// [slidr size="medium"]
		'thumb'			=> $thumb_def, 					// [slidr thumb="no"]
		'info_box'		=> $info_box_def,				// [slidr info_box="no"]
		'excerpt' 		=> $excerpt_def, 				// [slidr excerpt="no"]
		'img_link'		=> $img_link_def,				// [slidr img_link="no"]
		'cycle' 		=> $nav_cycle_def,				// [slidr cycle="yes"]
		'nav' 			=> $nav_buttons_def,			// [slidr nav="hide"]
		'class'			=> '',	 						// [slidr class="myclass"]
	), $atts );

 ?>