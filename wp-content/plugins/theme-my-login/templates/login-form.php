<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<div class="login" id="theme-my-login<?php $template->the_instance(); ?>">
	<?php $template->the_action_template_message( 'login' ); ?>
	<?php $template->the_errors(); ?>
	<form name="loginform" id="loginform<?php $template->the_instance(); ?>" class="form-signin" action="<?php $template->the_action_url( 'login' ); ?>" method="post">
		<p>
			<input type="text" name="log" id="user_login<?php $template->the_instance(); ?>" value="<?php $template->the_posted_value( 'log' ); ?>" class="form-control" placeholder="Username" autofocus />
			<input type="password" class="form-control" placeholder="Password" name="pwd" id="user_pass<?php $template->the_instance(); ?>"  />
		<?php do_action( 'login_form' ); ?>
			<label class="checkbox"><input type="checkbox" value="forever" id="rememberme<?php $template->the_instance(); ?>" name="rememberme" /> Remember me</label>
			<button class="btn btn-lg btn-primary btn-block" id="wp-submit<?php $template->the_instance(); ?>" type="submit">Log In</button>
			<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'login' ); ?>" />
			<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
			<input type="hidden" name="action" value="login" />
		</p>
	</form>
	<?php $template->the_action_links( array( 'login' => false ) ); ?>
</div>
