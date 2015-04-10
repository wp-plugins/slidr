<?php

	function slidr_shortcode( $atts ) {

		ob_start();

		include dirname(__FILE__) . '/attributes.php'; // Set the defaults and shortcode attributes
		include dirname(__FILE__) . '/markup.php'; // Main variables and HTML markup
		include_once dirname(__FILE__) . '/item_content.php'; // Get the content of each item

		if( $a['gallery'] !== false ) { // If we want to display specific images
			$gallery = $a['gallery'] !== 'yes' ? explode( ',', $a['gallery'] ) : 'inherit';
			$args = array(
				'post_type' 		=> 'attachment',
				'posts_per_page' 	=> $a['number'],
				'post_parent' 		=> $gallery == 'inherit' ? get_the_ID() : false,
				'post__in' 			=> is_array( $gallery ) ? $gallery : false,
				'orderby' 			=> $gallery == 'inherit' ? 'date' : 'post__in',
			); 
			$attachments = get_posts($args);
			if ( $attachments ) :
				echo $open_slidr;
				foreach ($attachments as $attachment) :
					$media_url 	= wp_get_attachment_image_src( $attachment->ID );
					$img_link 	= $a['gallery_link'] === 'attachment' ? get_attachment_link( $attachment->ID ) : $media_url[0];
					$title 		= apply_filters('the_title', $attachment->post_title);
					$excerpt	= $a['excerpt'] === 'yes' ? '<p>' . $attachment->post_excerpt . '</p>' : ''; 
					$content 	= wp_get_attachment_image( $attachment->ID, $size );
					$info_box 	= $a['info_box'] === 'yes' ? slidr_infobox( $img_link, $title, $excerpt, $a ) : '';
					echo $o_slidr_item;
					if($a['thumb'] === 'yes') {
						echo item_content( $img_link, $content, $a ) .
							$c_icontag;
					}
					echo $info_box . 
						$c_slidr_item;
				endforeach;
				echo $close_slidr;
			endif;
		} else { // Else we get a custom query
			$sticky = ($a['sticky'] === 'yes') ? get_option( 'sticky_posts' ) : '';
			$args	= array(
				'post_type' 		=> $a['type'],
				'posts_per_page' 	=> $a['number'],
				'post_parent' 		=> $a['parent'],
				'post__in'          => $sticky,
				'category__in' 		=> $a['category'],
				'orderby' 			=> $a['orderby'], 
				'order'				=> $a['order'],
			);
			$slidr_items = new WP_Query( $args );

			if ( $slidr_items->have_posts() ) :
				echo $open_slidr;
					while ( $slidr_items->have_posts() ) :
						$slidr_items->the_post();

						$slidr_excerpt	= $a['excerpt'] 	=== 'yes' ? '<p>' . get_the_excerpt() . '</p>' : ''; 
						$info_box 		= $a['info_box'] 	=== 'yes' ? slidr_infobox( get_the_permalink(), get_the_title(), $slidr_excerpt, $a ) : '';

						echo $o_slidr_item;
							if ( has_post_thumbnail() ) :
								if($a['thumb'] === 'yes') {
									$item_image = get_the_post_thumbnail( get_the_ID(), $size );
									echo item_content(get_the_permalink(), $item_image, $a );	
								}
							endif;
						echo $c_icontag .
								$info_box . 
							$c_slidr_item;
					endwhile;
				echo $close_slidr;
			endif;
		}

		return ob_get_clean();
		
		wp_reset_postdata();	
	}
	add_shortcode( 'slidr', 'slidr_shortcode' );
?>