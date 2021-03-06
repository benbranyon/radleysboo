<!DOCTYPE html>

<html <?php language_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width">
		<title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' );?>">
		
		<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/"><?php bloginfo('name');?></a>
				</div>
				<div class="collapse navbar-collapse">
					<?php wp_nav_menu(array('theme_location'=>'primary', 'container' => 'false', 'menu_class'=> 'nav navbar-nav'));?>
					<ul class="nav navbar-nav">
						
					</ul>
				</div>
			</div>
		</div>
