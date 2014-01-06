<?php
/*
   Template Name: Index
*/

get_header();?>
	<div id="wrap">
		<div class="container site-content">
			<div class="row article">
				<?php while ( have_posts() ) : the_post(); ?>
					<h2><?php the_title();?>v</h2>
					<?php the_content(); ?>
				<?php endwhile; ?>
			</div>
		</div>
	</div>

<?php get_footer(); ?>