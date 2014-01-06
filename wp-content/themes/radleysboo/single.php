<?php
/*
   Template Name: Index
*/

get_header();?>
	<div id="wrap">
		<div class="container site-content">
			<div class="row article">
				<h2><a href="<?php the_permalink();?>" rel="bookmark" title="<?php the_title_attribute();?>"><?php the_title();?></a></h2>
				<?php the_content(); ?>
			</div>
		</div>
	</div>

<?php get_footer(); ?>