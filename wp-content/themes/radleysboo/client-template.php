<?php
/*
Template Name: Client Template
*/
?>

<?php get_header(); ?>
	<div class="spacer"></div>
		<div id="wrap">
		<div class="container site-content">
			<header class="entry-header">
				<h2 class="entry-title"><?php the_title(); ?></h2>
			</header>
			<?php if ( function_exists( 'pdfprnt_show_buttons_for_custom_post_type' ) ) echo pdfprnt_show_buttons_for_custom_post_type( 'post_type=gallery&orderby=post_date' ); ?>
			<div class="gallery_box entry-content">
				<?php 
					global $post;
					global $wpdb;
					global $wp_query;
					$paged = $wp_query->query_vars["paged"];
					$permalink = get_permalink();
					$gllr_options = get_option( 'gllr_options' );
					if( substr( $permalink, strlen( $permalink ) -1 ) != "/" )
					{
						if( strpos( $permalink, "?" ) !== false ) {
							$permalink = substr( $permalink, 0, strpos( $permalink, "?" ) -1 )."/";
						}
						else {
							$permalink .= "/";
						}
					}
					$count = 0;
					$args = array(
						'post_type'	=> 'gallery',
						'post_status' => 'publish',
						'orderby' => 'post_date',
						'post__not_in' => array(63),
						'posts_per_page' => -1,
					);
					$second_query = new WP_Query( $args );
					if ( function_exists( 'pdfprnt_show_buttons_for_custom_post_type' ) ) echo pdfprnt_show_buttons_for_custom_post_type( $second_query );
					$count_all_albums = count($second_query->posts);
					$per_page = $showitems = get_option( 'posts_per_page' );  
					if( $paged != 0 )
						$start = $per_page * ($paged - 1);
					else
						$start = $per_page * $paged;
					if ($second_query->have_posts()) : while ($second_query->have_posts()) : $second_query->the_post();
						if( $count < $start ) {
							$count++;
							continue;
						}
						if( ( $count - $start ) > $per_page - 1 )
							break;
						$attachments	= get_post_thumbnail_id( $post->ID );
						if( empty ( $attachments ) ) {
							$attachments = get_children( 'post_parent='.$post->ID.'&post_type=attachment&post_mime_type=image&numberposts=1' );
							$id = key($attachments);
							$image_attributes = wp_get_attachment_image_src( $id, 'album-thumb' );
							$image_attributes_large = wp_get_attachment_image_src($id, 'large' );
						}
						else {
							$image_attributes = wp_get_attachment_image_src( $attachments, 'album-thumb' );
							$image_attributes_large = wp_get_attachment_image_src( $attachments, 'large');
						}
						if( 1 == $gllr_options['border_images'] ){
							$gllr_border = 'border-width: '.$gllr_options['border_images_width'].'px; border-color:'.$gllr_options['border_images_color'].'; padding:0;';
							$gllr_border_images = $gllr_options['border_images_width'] * 2;
						}
						else{
							$gllr_border = 'padding:0;';
							$gllr_border_images = 0;
						}
						$count++;
				?>
					<div class="tilt">
						<a href="<?php echo $permalink; echo basename( get_permalink( $post->ID ) ); ?>"><img style="<?php echo $gllr_border; ?>" alt="<?php echo $post->post_title; ?>" title="<?php echo $post->post_title; ?>" class="item" src="<?php echo $image_attributes_large[0]; ?>" /></a>
					</div>
				<?php endwhile; endif; wp_reset_query(); ?>
				<?php
					if( $paged == 0 )
							$paged = 1;
					$pages = intval ( $count_all_albums/$per_page );
					if( $count_all_albums % $per_page > 0 )
						$pages +=1;
					$range = 100;
					if( ! $pages ) {
						$pages = 1;
					}
					if( 1 != $pages ) {
						echo "</div><div class='clear'></div><div class='pagination'>";
						for ( $i = 1; $i <= $pages; $i++ ) {
							if ( 1 != $pages && ( !( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
								echo ( $paged == $i ) ? "<span class='current'>". $i ."</span>":"<a href='". get_pagenum_link($i) ."' class='inactive' >". $i ."</a>";
							}
						}

						echo "<div class='clear'></div></div>\n";
					} else {?>
						</div>
					<?php } ?>
			<?php comments_template(); ?>
		</div>
	</div>
	<script type="text/javascript">
		(function($){
			$(window).load(function(){
				$(".gallery_box").masonry({
  					columnWidth: 20,
  					itemSelector: '.item'
				});
			});
		})(jQuery);
	</script>
<?php get_footer(); ?>
