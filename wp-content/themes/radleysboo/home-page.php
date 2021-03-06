<?php
/*
   Template Name: Home Page
*/

get_header();?>
	<div id="wrap" style="margin: 0 auto;">
		<div style="display:none">
			<?php echo do_shortcode('[print_gllr id=63]');?>
		</div>
	</div>
<?php get_footer(); ?>

<script type="text/javascript">
jQuery(function ($) {
	$(document).ready(function() {
		var slides = [];

		$('.gallery').find('a').each(function(i){
			var $this = $(this);
			var obj = {};
			obj.image = $this.attr('href');
			slides.push(obj);
		});

		$.supersized({
			slideshow : 1,
			autoplay : 1,
			fit_always: 1,
			start_slide : 1,
			random: 0,
			image_protect : 1,
			slide_interval : 2000,
			navigation : 0,
			transition: 'carouselRight',
			thumbnail_navigation: 0,
			slide_counter : 0,
			slides : slides
		});
	});
});
</script>

