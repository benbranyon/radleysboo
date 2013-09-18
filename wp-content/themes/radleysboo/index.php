<?php
/*
   Template Name: Index
*/

get_header();?>
	<div id="wrap">
	<?php echo  do_shortcode('[image-carousel]');?>
        <div class="container marketing">
		<div class="row">
			<div class="col-lg-4">
				<img class="img-circle" src="" />
				<h2>Blog</h2>
				<p>Blog</p>
			</div>
			<div class="col-lg-4">
				<img class="img-circle" src="" />
				<h2>About</h2>
				<p>About</p>
			</div>
			<div class="col-lg-4">
				<img class="img-circle" src="" />
				<h2>Contact</h2>
				<p>Contact</p>
			</div>
		</div>
		<?php if(have_posts()):?> 
		<?php $counter = 1;?>
		<?php while(have_posts()): the_post();?>
		<?php $counter++;?>
                <hr class="featurette-divider" />
                <div class="row featurette">
			<?php if($counter %2 == 0):?>
			<div class="col-md-5">
				<h2 class="featurette-heading"><a href="<?php the_permalink();?>" rel="bookmark" title="<?php the_title_attribute();?>"><?php the_title();?></a></h2>
				<p class="lead"><?php echo get_the_excerpt();?></p>
			</div>
	
			<div class="col-md-7">
				<?php if( has_post_thumbnail() )
				{
					the_post_thumbnail('large', array('alt'=>'image'));
				}
				?>
			</div>
			<?php else:?>
			<div class="col-md-7">
				<?php if( has_post_thumbnail() )
				{
					the_post_thumbnail('large', array('alt'=>'image'));
				}
				?>
			</div>

			<div class="col-md-5">
				<h2 class="featurette-heading"><a href="<?php the_permalink();?>" rel="bookmark" title="<?php the_title_attribute();?>"><?php the_title();?></a></h2>
				<p class="lead"><?php echo get_the_excerpt();?></p>
			</div>
			<?php endif;?>
                </div>
		<?php endwhile;?>
		<hr class="featurette-divider" /> 
		<?php endif;?>
        </div>
	</div>
<?php get_footer(); ?>
