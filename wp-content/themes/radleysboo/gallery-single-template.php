<?php get_header(); ?>
	<div class="spacer"></div>
	
	<div id="wrap">
		<div class="container site-content">
			<?php 
			global $post, $wp_query;
			$args = array(
				'post_type'					=> 'gallery',
				'post_status'				=> 'publish',
				'name'							=> $wp_query->query_vars['name'],
				'posts_per_page'		=> 1
			);	
			$second_query = new WP_Query( $args ); 
			$gllr_options = get_option( 'gllr_options' );
			if ($second_query->have_posts()) : while ($second_query->have_posts()) : $second_query->the_post(); ?>
				<header class="entry-header">
					<h2 class="entry-title"><?php the_title(); ?></h2>
				</header>
				<div class="gallery_box_single entry-content">
					<?php the_content(); 
					$posts = get_posts(array(
						"showposts"			=> -1,
						"what_to_show"	=> "posts",
						"post_status"		=> "inherit",
						"post_type"			=> "attachment",
						"orderby"				=> $gllr_options['order_by'],
						"order"					=> $gllr_options['order'],
						"post_mime_type"=> "image/jpeg,image/gif,image/jpg,image/png",
						"post_parent"		=> $post->ID
					));
					if( count( $posts ) > 0 ) {
						$count_image_block = 0; ?>
						<div class="gallery clearfix">

						<?php if (empty($post->post_password) || (isset($_COOKIE['wp-postpass_' . COOKIEHASH])and wp_check_password($post->post_password, $_COOKIE['wp-postpass_' . COOKIEHASH]))):?>
							<?php foreach( $posts as $attachment ) { 
								$key = "gllr_image_text";
								$link_key = "gllr_link_url";
								$image_attributes = wp_get_attachment_image_src( $attachment->ID, 'photo-thumb' );
								$image_attributes_large = wp_get_attachment_image_src( $attachment->ID, 'large' );
								$image_attributes_full = wp_get_attachment_image_src( $attachment->ID, 'full' );
								$image_attributes_medium = wp_get_attachment_image_src($attachment->ID, 'medium');
								if( 1 == $gllr_options['border_images'] ){
									$gllr_border = 'border-width: '.$gllr_options['border_images_width'].'px; border-color:'.$gllr_options['border_images_color'].'';
									$gllr_border_images = $gllr_options['border_images_width'] * 2;
								}
								else{
									$gllr_border = '';
									$gllr_border_images = 0;
								}
								if( $count_image_block % $gllr_options['custom_image_row_count'] == 0 ) { ?>
								<div class="gllr_image_row">
								<?php } ?>
									<?php if( ( $url_for_link = get_post_meta( $attachment->ID, $link_key, true ) ) != "" ) { ?>
									<div class="item">
										<a href="<?php echo $url_for_link; ?>" title="<?php echo get_post_meta( $attachment->ID, $key, true ); ?>" target="_blank">
											<img style="<?php echo $gllr_border; ?>" alt="<?php echo $post->post_title; ?>" title="<?php echo $post->post_title; ?>" src="<?php echo str_replace ('-160x120','',$image_attributes_large[0]); ?>" />
										</a>
										<?php $attachment_page = get_attachment_link($attachment->ID);?>
										<a href="<?php echo $attachment_page; ?>">Comment</a>
									</div>
									<?php } else { ?>
									<div class="item">
										<a rel="gallery_fancybox" href="<?php echo $image_attributes_large[0]; ?>" title="<?php echo get_post_meta( $attachment->ID, $key, true ); ?>" >
											<img style="<?php echo $gllr_border; ?>" alt="<?php echo $post->post_title; ?>" title="<?php echo $post->post_title; ?>" src="<?php echo str_replace ('-160x120','',$image_attributes_large[0]); ?>" />
										</a>
										<?php $attachment_page = get_attachment_link($attachment->ID);?>
										<a href="<?php echo $attachment_page; ?>">Comment</a>
									</div>
									<?php } ?>											

								<?php if($count_image_block%$gllr_options['custom_image_row_count'] == $gllr_options['custom_image_row_count']-1 ) { ?>
								</div>
								<?php } 
								$count_image_block++; 
							} 
						endif;
							if($count_image_block > 0 && $count_image_block%$gllr_options['custom_image_row_count'] != 0) { ?>
								</div>
							<?php } ?>
							</div>
						<?php } ?>
					</div>
					<div class="clear"></div>
				<?php endwhile; else: ?>
				<div class="gallery_box_single">
					<p class="not_found"><?php _e('Sorry, nothing found.', 'gallery'); ?></p>
				</div>
				<?php endif; ?>
				<?php if ( 1 == $gllr_options['return_link'] ) {
					if( 'gallery_template_url' == $gllr_options["return_link_page"] ){
						global $wpdb;
						$parent = $wpdb->get_var( "SELECT $wpdb->posts.ID FROM $wpdb->posts, $wpdb->postmeta WHERE meta_key = '_wp_page_template' AND meta_value = 'gallery-template.php' AND (post_status = 'publish' OR post_status = 'private') AND $wpdb->posts.ID = $wpdb->postmeta.post_id" );	?>
						<div class="return_link"><a href="<?php echo ( !empty( $parent ) ? get_permalink( $parent ) : '' ); ?>"><?php echo $gllr_options['return_link_text']; ?></a></div>
					<?php } else { ?>
						<div class="return_link"><a href="<?php echo $gllr_options["return_link_url"]; ?>"><?php echo $gllr_options['return_link_text']; ?></a></div>
					<?php }
				} ?>
			</div>			
		</div>
	<script type="text/javascript">
		(function($){
			$( document ).ready(function(){
				var $content = $(".gallery");
				$content.imagesLoaded(function() {
					$content.masonry({
	  					columnWidth: 20,
	  					itemSelector: '.item'
					});
				});
			});
		})(jQuery);
	</script>
	<script type="text/javascript">
		(function($){
			$(document).ready(function(){
				$("a[rel=gallery_fancybox]").fancybox({
					'transitionIn'		: 'elastic',
					'transitionOut'		: 'elastic',
					'titlePosition' 	: 'inside',
					'speedIn'					:	500, 
					'speedOut'				:	300,
					'titleFormat'			: function(title, currentArray, currentIndex, currentOpts) {
						return '<span id="fancybox-title-inside">' + (title.length ? title + '<br />' : '') + '<?php _e( "Image", "gallery"); ?> ' + (currentIndex + 1) + ' / ' + currentArray.length + '</span><?php if( get_post_meta( $post->ID, 'gllr_download_link', true ) != '' ){?><br /><a href="'+$(currentOpts.orig).attr('rel')+'" target="_blank"><?php echo __('Download high resolution image', 'gallery'); ?> </a><?php } ?>';
					}<?php if( $gllr_options['start_slideshow'] == 1 ) { ?>,
					'onComplete':	function() {
						clearTimeout(jQuery.fancybox.slider);
						jQuery.fancybox.slider=setTimeout("jQuery.fancybox.next()",<?php echo empty( $gllr_options['slideshow_interval'] )? 2000 : $gllr_options['slideshow_interval'] ; ?>);
					}<?php } ?>
				});
			});
		})(jQuery);
	</script>
<?php get_footer(); ?>