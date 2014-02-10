<?php

if ( ! class_exists( 'scp_setup' ) ) {

	class scp_setup extends bit51_scp {

		/**
		 * Verify case is set correctly and continue or die
		 */
		function __construct( $case = false ) {
	
			if ( ! $case ) {
				die( 'error' );
			}

			switch( $case ) {
				case 'activate': //active plugin
					$this->activate_execute();
					break;

				case 'deactivate': //deactivate plugin
					$this->deactivate_execute();
					break;

				case 'uninstall': //uninstall plugin
					$this->uninstall_execute();
					break;
			}
		}

		/**
		 * Entrypoint for activation
		 */
		function on_activate() {
			new scp_setup( 'activate' );
		}

		/**
		 * Entrypoint for deactivation
		 */
		function on_deactivate() {
	
			$devel = false; //set to true to uninstall for development
		
			if ( $devel ) {
				$case = 'uninstall';
			} else {
				$case = 'deactivate';
			}

			new scp_setup( $case );
		}

		/**
		 * Entrypoint for uninstall
		 */
		function on_uninstall() {
			if ( __FILE__ != WP_UNINSTALL_PLUGIN ) { //verify they actually clicked uninstall
				return;
			}

			new scp_setup( 'uninstall' );
		}

		/**
		 * Execute activation functions
		 */
		function activate_execute() {

			$this->default_settings(); //verify and set default options
			
			$options = get_option( $this->plugindata );
			
			//update if version numbers don't match
			if ( isset( $options['version'] ) && $options['version'] != $this->pluginversion ) {
				$this->update_execute();
			}
			
			$options['version'] = $this->pluginversion; //set new version number
			
			//remove no support nag if it's been more than six months
			if ( ! isset( $options['activatestamp'] ) || $options['activatestamp'] < ( time() - 15552000 ) ) {

				if ( isset( $options['no-nag'] ) ) {
					unset( $options['no-nag'] );
				}
				
				//set activate timestamp to today (they'll be notified again in a month)
				$options['activatestamp'] = time();

			}
			
			update_option( $this->plugindata, $options ); //save new plugin data

		}
		
		/**
		 * Execute update functions
		 */
		function update_execute() {

			global $scpoptions;

			if ( get_option( 'SSP_options' ) != false ) {
			
				$oldoptions = maybe_unserialize( get_option( 'SSP_options' ) );

				$scpoptions['header'] = isset( $oldoptions['heading'] ) ? $oldoptions['heading'] : '';
				$scpoptions['digg'] = isset( $oldoptions['show_digg'] ) ? $oldoptions['show_digg'] : '0';
				$scpoptions['facebook'] = isset( $oldoptions['show_facebook'] ) ? $oldoptions['show_facebook'] : '0';
				$scpoptions['google'] = isset( $oldoptions['show_google'] ) ? $oldoptions['show_google'] : '0';
				$scpoptions['linkedin'] = isset( $oldoptions['show_linkedin'] ) ? $oldoptions['show_linkedin'] : '0';
				$scpoptions['twitter'] = isset( $oldoptions['show_twitter'] ) ? $oldoptions['show_twitter'] : '0';
				$scpoptions['twitteruser'] = isset( $oldoptions['twitter_user'] ) ? $oldoptions['twitter_user'] : '';
				$scpoptions['archive'] = isset( $oldoptions['show_archive'] ) ? $oldoptions['show_archive'] : '0';
				$scpoptions['page'] = isset( $oldoptions['show_page'] ) ? $oldoptions['show_page'] : '0';
				$scpoptions['front'] = isset( $oldoptions['show_front'] ) ? $oldoptions['show_front'] : '0';
				$scpoptions['home'] = isset( $oldoptions['show_home'] ) ? $oldoptions['show_home'] : '0';
				$scpoptions['search'] = isset( $oldoptions['show_search'] ) ? $oldoptions['show_search'] : '0';
				$scpoptions['single'] = isset( $oldoptions['show_single'] ) ? $oldoptions['show_single'] : '0';

				update_option( $this->primarysettings, $scpoptions ); //save new options data

				delete_option( 'SSP_options' );

			}

		}

		/**
		 * Execute deactivation functions
		 */
		function deactivate_execute() {
		}

		/**
		 * Execute uninstall functions
		 */
		function uninstall_execute() {
		
			//remove all settings
			foreach( $this->settings as $settings ) {
				foreach ( $settings as $setting => $option ) {
					delete_option( $setting );
				}
			}
			
			//delete plugin information (version, etc)
			delete_option( $this->plugindata );
		}

	}

}