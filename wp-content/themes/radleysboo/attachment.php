<?php get_header(); ?>
	<div class="spacer"></div>
	<?php
		$image_attributes = wp_get_attachment_image_src( $attachment->ID, 'photo-thumb' );
		$image_attributes_large = wp_get_attachment_image_src( $attachment->ID, 'large' );
		$image_attributes_full = wp_get_attachment_image_src( $attachment->ID, 'full' );
		$image_attributes_medium = wp_get_attachment_image_src($attachment->ID, 'medium');
	?>
	<div id="wrap">
		<div class="container site-content">
			<div class="row">
				<div class="col-sm-8">
					<img style="<?php echo $gllr_border; ?>" alt="<?php echo $post->post_title; ?>" title="<?php echo $post->post_title; ?>" src="<?php echo str_replace ('-160x120','',$image_attributes_large[0]); ?>" />
				</div>
			</div>
			<div class="row">
				<div class="col-sm-8">
					<?php comments_template( '', true ); ?>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>