<?php

if (!class_exists( 'scp_admin' ) ) {

	class scp_admin extends bit51_scp {
		
		/**
		 * Initialize admin function
		 */
		function __construct() {
			
			//add scripts and css
			add_action( 'admin_print_scripts', array( &$this, 'config_page_scripts' ) );
			add_action( 'admin_print_styles', array( &$this, 'config_page_styles' ) );
		
			//add menu items
			add_action( 'admin_menu', array( &$this, 'register_settings_page' ) );
		
			//add settings
			add_action( 'admin_init', array( &$this, 'register_settings' ) );
		
			//add action link
			add_filter( 'plugin_action_links', array( &$this, 'add_action_link' ), 10, 2 );
		
			//add donation reminder
			add_action( 'admin_init', array( &$this, 'ask' ) );
			
		}
	
		/**
		 * Register page settings
		 */
		function register_settings_page() {

			add_options_page( __( $this->pluginname, $this->hook ), __( $this->pluginname, $this->hook ), $this->accesslvl, $this->hook, array( &$this,'scp_admin_init' ) );

		}	
		
		/**
		 * Register admin page main content
		 * To add more boxes to the admin page add a 2nd inner array item with title and callback function or content
		 */
		function scp_admin_init() {

			$this->admin_page( $this->pluginname . ' ' . __( 'Options', $this->hook ), 

				array(

					array( __( 'Instructions', $this->hook), 'install_instructions' ), //primary admin page content
					array( __( 'General Options', $this->hook), 'general_options' ), //primary admin page content

				)

			);

		}
		
		/**
		 * Create instructions block
		 */
		function install_instructions() {
			?>
			<p><?php _e( 'Use the settings below to determine which services you want and where on your site you want them to appear. Note that if you use the Share Center Pro widget it will only show up on individual pages and posts regardless of the settings you choose below.', $this->hook ); ?></p>
			<p><?php _e( 'If you would like to share a short URL instead of the full URL to your content please use the ', $this->hook ); ?><a href="http://wordpress.org/extend/plugins/bitly-shortlinks/" target="_blank">Bit.ly Shortlinks</a><?php _e( ' plugin by ', $this->hook ); ?><a href="http://yoast.com" target="_blank">Yoast</a><?php _e( ' which will allow you to use a standard or custom bit.ly domain to share shorlinks.', $this->hook ); ?></p>
			<?php
		}
		
		/**
		 * Create admin page main content
		 */
		function general_options() {
			global $scpoptions;
			?>
			<form method="post" action="options.php">
			<?php settings_fields( 'bit51_scp_options' ); //use main settings group ?>
				<table class="form-table">
					<tr valign="top">
						<td width="50%">
							<h4><?php _e( 'Buttons to show', $this->hook ); ?></h4>
							<p><?php __( 'Pick which buttons you would like to have appear on your site', $this->hook ); ?></p>
							<table class="bit51sorttable" width="90%" style="margin: 0 auto 0 auto">
								<tbody>
								<tr class="thead">
									<td width="50%"><strong><?php _e( 'Service', $this->hook ); ?></strong></td>
									<td width="20%"><strong><?php _e( 'Enable', $this->hook ); ?></strong></td>
									<td width="30%"><strong><?php _e( 'Weight', $this->hook ); ?></strong></td>
								</tr>
								<?php
									//lets sort the buttons by weight
									$buttons = array( 
										$scpoptions['bufferweight'] => 'Buffer',
										$scpoptions['facebookweight'] => 'Facebook',
										$scpoptions['googleweight'] => 'Google',
										$scpoptions['linkedinweight'] => 'LinkedIn',
										$scpoptions['pinterestweight'] => 'Pinterest',
										$scpoptions['stumbleuponweight'] => 'StumbleUpon',
										$scpoptions['twitterweight'] => 'Twitter'
									);

									ksort ( $buttons );

									$row = 1;

									foreach ( $buttons as $weight => $button ) {
										
										$rowclass = ( $row == 1 ? 'odd' : 'even' );
										$row = ( $row == 1 ? 2 : 1 );

										switch ( $button ) {
											case 'Buffer':
												?>
													<tr class="<?php echo $rowclass; ?>">
														<td width="50%"><label for="buffer"><a href="http://www.bufferapp.com" target="_blank">Buffer</a></label></td>
														<td width="20%"><input type="checkbox" name="bit51_scp[buffer]" id="buffer" value="1" <?php if ( $scpoptions['buffer'] == 1 ) echo "checked"; ?> /></td>
														<td width="30%"><input type="text" name="bit51_scp[bufferweight]" id="bufferweight" value="<?php echo $scpoptions['bufferweight']; ?>" style="width: 25px;" maxlength="3" /></td>
													</tr>
												<?php
												break;
											case 'Facebook':
												?>
													<tr class="<?php echo $rowclass; ?>">
														<td width="50%"><label for="facebook"><a href="http://www.facebook.com" target="_blank">Facebook</a></label></td>
														<td width="20%"><input type="checkbox" name="bit51_scp[facebook]" id="facebook" value="1" <?php if ( $scpoptions['facebook'] == 1 ) echo "checked"; ?> /></td>
														<td width="30%"><input type="text" name="bit51_scp[facebookweight]" id="facebookweight" value="<?php echo $scpoptions['facebookweight']; ?>" style="width: 25px;" maxlength="3" /></td>
													</tr>
												<?php
												break;
											case 'Google':
												?>
													<tr class="<?php echo $rowclass; ?>">
														<td width="50%"><label for="google"><label for="google"><a href="http://plus.google.com" target="_blank">Google +1</a></label></td>
														<td width="20%"><input type="checkbox" name="bit51_scp[google]" id="google" value="1" <?php if ( $scpoptions['google'] == 1 ) echo "checked"; ?> /></td>
														<td width="30%"><input type="text" name="bit51_scp[googleweight]" id="googleweight" value="<?php echo $scpoptions['googleweight']; ?>" style="width: 25px;" maxlength="3" /></td>
													</tr>
												<?php
												break;
											case 'LinkedIn':
												?>
													<tr class="<?php echo $rowclass; ?>">
														<td width="50%"><label for="linkedin"><a href="http://www.linkedin.com" target="_blank">LinkedIn</a></label></td>
														<td width="20%"><input type="checkbox" name="bit51_scp[linkedin]" id="linkedin" value="1" <?php if ( $scpoptions['linkedin'] == 1 ) echo "checked"; ?> /></td>
														<td width="30%"><input type="text" name="bit51_scp[linkedinweight]" id="linkedinweight" value="<?php echo $scpoptions['linkedinweight']; ?>" style="width: 25px;" maxlength="3" /></td>
													</tr>
												<?php
												break;
											case 'Pinterest':
												?>
													<tr class="<?php echo $rowclass; ?>">
														<td width="50%"><label for="pinterest"><a href="http://pinterest.com" target="_blank">Pinterest</a></label></td>
														<td width="20%"><input type="checkbox" name="bit51_scp[pinterest]" id="pinterest" value="1" <?php if ( $scpoptions['pinterest'] == 1 ) echo "checked"; ?> /></td>
														<td width="30%"><input type="text" name="bit51_scp[pinterestweight]" id="pinterestweight" value="<?php echo $scpoptions['pinterestweight']; ?>" style="width: 25px;" maxlength="3" /></td>
													</tr>
												<?php
												break;
											case 'StumbleUpon':
												?>
													<tr class="<?php echo $rowclass; ?>">
														<td width="50%"><label for="stumbleupon"><a href="http://stumbleupon.com" target="_blank">StumbleUpon</a></label></label></td>
														<td width="20%"><input type="checkbox" name="bit51_scp[stumbleupon]" id="stumbleupon" value="1" <?php if ( $scpoptions['stumbleupon'] == 1 ) echo "checked"; ?> /></td>
														<td width="30%"><input type="text" name="bit51_scp[stumbleuponweight]" id="stumbleuponweight" value="<?php echo $scpoptions['stumbleuponweight']; ?>" style="width: 25px;" maxlength="3" /></td>
													</tr>
												<?php
												break;
											case 'Twitter':
												?>
													<tr class="<?php echo $rowclass; ?>">
														<td width="50%"><label for="twitter"><a href="http://www.twitter.com" target="_blank">Twitter</a></label></td>
														<td width="20%"><input type="checkbox" name="bit51_scp[twitter]" id="twitter" value="1" <?php if ( $scpoptions['twitter'] == 1 ) echo "checked"; ?> /></td>
														<td width="30%"><input type="text" name="bit51_scp[twitterweight]" id="twitterweight" value="<?php echo $scpoptions['twitterweight']; ?>" style="width: 25px;" maxlength="3" /></td>
													</tr>
												<?php
												break;
										}

									}
								?>
								<tbody>
							</table>
						</td>
						<td width="50%">
							<h4><?php _e( 'Where to show buttons (if not using widget)', $this->hook ); ?></h4>
							<p><?php __( 'Pick which pages and posts you would like buttons to appear on. If only using the widget leave these all unchecked.', $this->hook ); ?></p>
							<input type="checkbox" name="bit51_scp[archive]" id="archive" value="1" <?php if ( $scpoptions['archive'] == 1 ) echo "checked"; ?> /> <label for="archive"> <?php _e( 'Show on Archives', $this->hook ); ?></label><br />
							<input type="checkbox" name="bit51_scp[page]" id="page" value="1" <?php if ( $scpoptions['page'] == 1 ) echo "checked"; ?> /> <label for="page"> <?php _e( 'Show on Pages', $this->hook ); ?></label><br />
							<input type="checkbox" name="bit51_scp[home]" id="home" value="1" <?php if ( $scpoptions['home'] == 1 ) echo "checked"; ?> /> <label for="home"> <?php _e( 'Show on Homepage</strong', $this->hook ); ?>></label><br />
							<input type="checkbox" name="bit51_scp[search]" id="search" value="1" <?php if ( $scpoptions['search'] == 1 ) echo "checked"; ?> /> <label for="search"> <?php _e( 'Show on Search Results', $this->hook ); ?></label><br />
							<input type="checkbox" name="bit51_scp[single]" id="single" value="1" <?php if ( $scpoptions['single'] == 1 ) echo "checked"; ?> /> <label for="single"> <?php _e( 'Show on Single Posts', $this->hook ); ?></label><br />
							<select name="bit51_scp[locationsingle]" id="locationsingle">
								<option value="0" <?php if ( $scpoptions['locationsingle'] == 0 ) echo "selected"; ?> ><?php _e( 'Bottom', $this->hook ); ?></option>
								<option value="1" <?php if ( $scpoptions['locationsingle'] == 1 ) echo "selected"; ?> ><?php _e( 'Top', $this->hook ); ?></option>
								<option value="2" <?php if ( $scpoptions['locationsingle'] == 2 ) echo "selected"; ?> ><?php _e( 'Both', $this->hook ); ?></option>
							</select><label for="locationsingle"> <?php _e( 'Show above content, below content, or both in single posts and pages', $this->hook ); ?></label><br />
							<select name="bit51_scp[locationlist]" id="locationlist">
								<option value="0" <?php if ( $scpoptions['locationlist'] == 0 ) echo "selected"; ?> ><?php _e( 'Bottom', $this->hook ); ?></option>
								<option value="1" <?php if ( $scpoptions['locationlist'] == 1 ) echo "selected"; ?> ><?php _e( 'Top', $this->hook ); ?></option>
								<option value="2" <?php if ( $scpoptions['locationlist'] == 2 ) echo "selected"; ?> ><?php _e( 'Both', $this->hook ); ?></option>
							</select><label for="locationlist"> <?php _e( 'Show above content, below content, or both on blog, category, search, or other pages where content is listed', $this->hook ); ?></label><br />
							<em><?php _e( 'Note: The widget will only show on single posts and pages regardless of what you choose above.', $this->hook ); ?></em>
						</td>
					</tr>
					<tr valign="top">
						<td colspan="2">
							<h4><?php _e( 'Other Options', $this->hook ); ?></h4>
							<p><input type="checkbox" name="bit51_scp[usecss]" id="usecss" value="1" <?php if ( isset( $scpoptions['usecss'] ) && $scpoptions['usecss'] == 1 ) echo "checked"; ?> /> <label for="single"> <?php _e( 'Use provided CSS', $this->hook ); ?></label><br />
							<em><?php _e( 'Note: Turning off this option will remove the CSS stylesheet provided by the plugin allowing you to style it your own way.', $this->hook ); ?></em></p>
							<p><label for"header"><?php _e( 'Enter text to appear before the sharing buttons (if needed)', $this->hook ); ?></label> <input name="bit51_scp[header]" id="header" value="<?php echo $scpoptions['header']; ?>" type="text"><br />
							<label for"fbappid"><?php _e( 'Enter your Facebook App ID (if you have one)', $this->hook ); ?></label> <input name="bit51_scp[fbappid]" id="fbappid" value="<?php echo $scpoptions['fbappid']; ?>" type="text"><br /></p>
							<p><input type="checkbox" name="bit51_scp[fbog]" id="fbog" value="1" <?php if ( isset( $scpoptions['fbog'] ) && $scpoptions['fbog'] == 1 ) echo "checked"; ?> /> <label for="single"> <?php _e( 'Use Facebook OpenGraph meta data', $this->hook ); ?></label><br />
							<em><?php _e( 'Note that using Facebook OpenGraph here will override Jetpack\'s OpenGraph if you have installed it. If you are using WordPress SEO by Yoast you probably don\'t need this option.', $this->hook ); ?></em></p>
							<p><label for"twitteruser"><?php _e( 'Enter your twitter username (for link tracking and twitter card meta data)', $this->hook ); ?></label> <input name="bit51_scp[twitteruser]" id="twitteruser" value="<?php echo $scpoptions['twitteruser']; ?>" type="text"></p>
							<p><input type="checkbox" name="bit51_scp[tcmd]" id="fbog" value="1" <?php if ( isset( $scpoptions['tcmd'] ) && $scpoptions['tcmd'] == 1 ) echo "checked"; ?> /> <label for="single"> <?php _e( 'Use Twitter card meta data', $this->hook ); ?></label><br />
							<em><?php _e( 'If you are using WordPress SEO by Yoast you probably don\'t need this option.', $this->hook ); ?></em></p>
						</td>
					</tr>
				</table>
				<p class="submit"><input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ) ?>" /></p>
			</form>
			<?php
		}

		/**
		 * Validate input
		 */
		function scp_val_options( $input ) {
			
			//make sure boolean options are set
			$input['buffer'] = isset( $input['buffer'] ) ? $input['buffer'] : '0';
			$input['facebook'] = isset( $input['facebook'] ) ? $input['facebook'] : '0';
			$input['google'] = isset( $input['google'] ) ? $input['google'] : '0';
			$input['linkedin'] = isset( $input['linkedin'] ) ? $input['linkedin'] : '0';
			$input['pinterest'] = isset( $input['pinterest'] ) ? $input['pinterest'] : '0';
			$input['stumbleupon'] = isset( $input['stumbleupon'] ) ? $input['stumbleupon'] : '0';
			$input['twitter'] = isset( $input['twitter'] ) ? $input['twitter'] : '0';
			$input['archive'] = isset( $input['archive'] ) ? $input['archive'] : '0';
			$input['home'] = isset( $input['home'] ) ? $input['home'] : '0';
			$input['page'] = isset( $input['page'] ) ? $input['page'] : '0';
			$input['search'] = isset( $input['search'] ) ? $input['search'] : '0';
			$input['single'] = isset( $input['single'] ) ? $input['single'] : '0';
			$input['usecss'] = isset( $input['usecss'] ) ? $input['usecss'] : '0';
			$input['fbog'] = isset( $input['fbog'] ) ? $input['fbog'] : '0';
			$input['tcmd'] = isset( $input['tcmd'] ) ? $input['tcmd'] : '0';
			$input['locationsingle'] = isset( $input['locationsingle'] ) ? $input['locationsingle'] : '0';
			$input['locationlist'] = isset( $input['locationlist'] ) ? $input['locationlist'] : '0';

			$input['header'] = sanitize_text_field( $input['header'] );
			$input['fbappid'] = sanitize_text_field( $input['fbappid'] );
			$input['twitteruser'] = sanitize_text_field( $input['twitteruser'] );
			$input['bufferweight'] = sanitize_text_field( $input['bufferweight'] );
			$input['faceebookweight'] = sanitize_text_field( $input['faceebookweight'] );
			$input['googleweight'] = sanitize_text_field( $input['googleweight'] );
			$input['linkedinweight'] = sanitize_text_field( $input['linkedinweight'] );
			$input['pinterestweight'] = sanitize_text_field( $input['pinterestweight'] );
			$input['stumbleuponweight'] = sanitize_text_field( $input['stumbleuponweight'] );
			$input['twitterweight'] = sanitize_text_field( $input['twitterweight'] );
			if ( strstr( $input['twitteruser'], '@' ) ) {
				$input['twitteruser'] = substr( $input['twitteruser'], 1 );
			}
		    
		    return $input;
		}
		
	}

}
