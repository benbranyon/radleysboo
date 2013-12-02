<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 */

get_header(); ?>
<div class="spacer"></div>
<div id="wrap">
	<div class="container site-content">
		<h1 class="page-title"><?php echo __("404 Error ... Page Not Found"); ?></h1>

		<div class="content">
			<p>
			<?php echo __("I'm sorry, but the page you're seeking does not exist. Please verify that you've entered the correct URL in your browser's address bar."); ?>
			</p>
		</div>
	</div>
</div>

<?php get_footer(); ?>