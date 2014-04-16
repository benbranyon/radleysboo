<?php
/*
	Plugin Name: Share Center Pro
	Plugin URI: http://wordpress.org/plugins/share-center-pro/installation/
	Description: Add common social sharing services in a widget to be used anywhere on your page or at the bottom of your posts or other content.
	Version: 2.4.7
	Text Domain: share-center-pro
	Domain Path: /languages
	Author: iThemes
	Author URI: http://ithemes.com
	License: GPLv2
	Copyright 2014  iThemes  (email : updates@ithemes.com)
*/


//Require common Bit51 library
require_once( plugin_dir_path( __FILE__ ) . 'lib/bit51/bit51.php' );

if ( ! class_exists( 'bit51_scp' )) {

	class bit51_scp extends Bit51 {
	
		public $pluginversion 	= '0016'; //current plugin version
	
		//important plugin information
		public $hook 			= 'share-center-pro';
		public $pluginbase		= 'share-center-pro/share-center-pro.php';
		public $pluginname		= 'Share Center Pro';
		public $homepage		= 'http://wordpress.org/plugins/share-center-pro/installation/';
		public $supportpage 	= 'http://wordpress.org/support/plugin/share-center-pro';
		public $wppage 			= 'http://wordpress.org/extend/plugins/share-center-pro/';
		public $accesslvl		= 'manage_options';
		public $paypalcode		= 'QKDGZFLN3QG68';
		public $plugindata 		= 'bit51_scp_data';
		public $primarysettings	= 'bit51_scp';
		public $settings		= array(
			'bit51_scp_options' 	=> array(
				'bit51_scp' 			=> array(
					'callback' 				=> 'scp_val_options',
					'header' 				=> '',
					'pinterest' 			=> '0',
					'pinterestweight'		=> '50',
					'facebook' 				=> '0',
					'facebookweight'		=> '20',
					'google' 				=> '0',
					'googleweight'			=> '30',
					'linkedin' 				=> '0',
					'linkedinweight'		=> '40',
					'stumbleupon'			=> '0',
					'stumbleuponweight'		=> '60',
					'twitter'				=> '0',
					'twitterweight'			=> '70',
					'buffer'				=> '0',
					'bufferweight'			=> '10',
					'archive'				=> '0',
					'page'					=> '0',
					'home'					=> '0',
					'search'				=> '0',
					'single'				=> '0',
					'twitteruser'			=> '',
					'usecss'				=> '1',
					'fbappid'				=> '',
					'fpog'					=> '0',
					'tcmd'					=> '0',
					'locationsingle'		=> '0',
					'locationlist'			=> '0'
				)
			)
		);

		function __construct() {

			global $scpoptions, $scpdata;
		
			//set path information
			
			if ( ! defined( 'SCP_PP' ) ) {
				define( 'SCP_PP', plugin_dir_path( __FILE__ ) );
			}
			
			if ( ! defined( 'SCP_PU' ) ) {
				define( 'SCP_PU', plugin_dir_url( $this->pluginbase, __FILE__ ) );
			}
		
			//require admin page
			require_once( plugin_dir_path( __FILE__ ) . 'inc/admin.php' );
			new scp_admin( $this );
			
			//require setup information
			require_once( plugin_dir_path( __FILE__ ) . 'inc/setup.php' );
			register_activation_hook( __FILE__, array( 'scp_setup', 'on_activate' ) );
			register_deactivation_hook( __FILE__, array( 'scp_setup', 'on_deactivate' ) );
			register_uninstall_hook( __FILE__, array( 'scp_setup', 'on_uninstall' ) );

			$scpoptions = get_option( $this->primarysettings );
			$scpdata = get_option( $this->plugindata );
			
			if ( $scpdata['version'] != $this->pluginversion  || get_option( 'scpoptions' ) != false ) {
				new scp_setup( 'activate' );
			}

			//require widget info
			require_once( plugin_dir_path( __FILE__ ) . 'inc/widget.php' );

			//register the widget
			add_action( 'widgets_init', array( &$this, 'scp_loadwidget' ) );

			//Enqueue javascripts
			add_action( 'wp_enqueue_scripts', array( &$this, 'scp_footerscripts' ) );

			//add to button output to content that isn't a widget
			add_filter( 'the_content', array( &$this, 'scp_addtocontent' ), 25 );

			//Enqueue the stylesheet
			if ( isset( $scpoptions['usecss'] ) && $scpoptions['usecss'] == 1 ) {
				add_action( 'wp_print_styles', array( &$this, 'scp_addstylesheet' ) );
			}

			if ( ( isset( $scpoptions['fbog'] ) && $scpoptions['fbog'] == 1 ) || ( isset( $scpoptions['tcmd'] ) && $scpoptions['tcmd'] == 1 ) ) {

				//Add facebook meta to header
				add_action( 'wp_head', array( &$this, 'scp_addmeta' ) );

				//remove jetpack OpenGraph (if needed)
				if ( isset( $scpoptions['fbog'] ) && $scpoptions['fbog'] == 1 ) {

					$active_plugins = get_option( 'active_plugins', array() );

					if ( in_array( 'jetpack/jetpack.php', $active_plugins ) ) {
						add_filter( 'jetpack_enable_opengraph', '__return_false', 99 );
					}

				}
				
			}

		}

		/**
		  * Add the facebook META data to the head
		  *
		  * @return null
		  **/
		function scp_addmeta() {
			
			global $scpoptions, $posts, $post;
			

			$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );

			if ( is_array( $thumbnail ) && strlen( $thumbnail[0] ) > 1 ) {

				$thumbnail = $thumbnail[0];

			} else { //get a thumbnail from an image in the post

				$content = $posts[0]->post_content; 
				
				$output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches );

				if ( $output > 0 ) {
					$thumbnail = $matches[1][0];
				} else {
					$thumbnail = '';
				}

			}
				
			echo "<!--## Begin Share Center Pro Scripts ## -->\n";

			//add FaceBook OpenGraph Data
			if ( $scpoptions['fbog'] == 1 ) {
					
				echo "<meta property=\"og:title\" content=\"" . get_the_title( $post->ID ) . "\"/>\n" .
					"<meta property=\"og:type\" content=\"article\"/>\n" .
					"<meta property=\"og:url\" content=\"" . get_permalink( $post->ID ) . "\"/>\n" . 
					"<meta property=\"og:locale\" content=\"" . get_bloginfo( 'language' ) . "\"/>\n";
					
				if ( strlen( $thumbnail ) > 1 ) { //only display thumbnail if an image is used
					echo "<meta property=\"og:image\" content=\"" . $thumbnail . "\"/>\n";
				}

				echo "<meta property=\"og:site_name\" content=\"" . get_bloginfo() . "\"/>\n";
				
				if ( strlen( get_the_author() > 1 ) ) { //only display author if needed
					echo "<meta property=\"og:author\" content=\"" . get_the_author() . "\" />\n";
				}
				
				if ( is_home() || is_front_page() ) {
					echo "<meta property=\"og:description\" content=\"" . get_bloginfo( 'description' ) . "\"/>\n";
				} else if ( is_singular() ) {
					echo "<meta property=\"og:description\" content=\"" . strip_tags( get_the_excerpt() ) . "\"/>\n";
				} 
				
				if ( strlen( $scpoptions['fbappid'] > 1 ) ) {
					echo "<meta property=\"fb:app_id\" content=\"" . $scpoptions['fbappid'] . "\" />\n";
				}

			}

			//add Twitter card  Data
			if ( $scpoptions['tcmd'] == 1 ) {
			
				echo "<meta name=\"twitter:card\" content=\"summary\">\n";

				if ( strlen( $scpoptions['twitteruser'] > 1 ) ) {
					echo "<meta name=\"twitter:site\" content=\"@" . $scpoptions['twitteruser'] . "\">\n";
				}

				if ( is_home() || is_front_page() ) {
					echo "<meta property=\"twitter:description\" content=\"" . get_bloginfo( 'description' ) . "\"/>\n";
				} else if ( is_singular() ) {
					echo "<meta property=\"twitter:description\" content=\"" . strip_tags( get_the_excerpt() ) . "\"/>\n";
				} 

				echo "<meta property=\"twitter:title\" content=\"" . get_the_title( $post->ID ) . "\"/>\n";
				echo "<meta property=\"twitter:url\" content=\"" . get_permalink( $post->ID ) . "\"/>\n";

			}

			echo "<!--## End Share Center Pro Scripts ## -->\n";

		}

		/**
		 * Enqueue style sheet
		 *
		 * @return null
		 **/
		function scp_addstylesheet() {

			wp_register_style( 'share-center-pro', SCP_PU . 'inc/style.css' );
			wp_enqueue_style( 'share-center-pro' );
			
		}

		/**
		  * Create a filter to add buttons to the content if not in a widget
		  *
		  * @return Object
		  * @param Object
		  **/
		function scp_addtocontent( $content ) {
			
			global $scpoptions;
			
			//if the buttons should be on the current content then add them to the end of it
			if ( ( is_archive() && $scpoptions['archive'] == 1 ) || ( is_page() && ! is_front_page() && ! is_home() && $scpoptions['page'] == 1 ) || ( ( is_front_page() || is_home() ) && $scpoptions['home'] == 1 ) || ( is_search() &&  $scpoptions['search'] == 1 ) || ( is_single() && $scpoptions['single'] == 1 ) ) {

				//decide which location we should pick based on page type
				if ( is_page() || is_single() ) {
					$location = $scpoptions['locationsingle'];
				} else {
					$location = $scpoptions['locationlist'];
				}
				
				//add buttons before/after/both depending on user's choice
				switch ( $location ) {
					case '0':
						return $content . $this->scp_social_buttons();
						break;
					case '1':
						return $this->scp_social_buttons() . $content;
						break;
					case '2':
						return $this->scp_social_buttons() . $content . $this->scp_social_buttons();
						break;
					default:
						return $content;
						break;
				}

				return $content . $this->scp_social_buttons();
			} else {
				return $content;
			}

		}

		/**
		  * Load required javascripts in the footer
		  *
		  * @return null
		  */
		function scp_footerscripts() {

			global $scpoptions;
			
			//load the footer script
			wp_enqueue_script( 'facebook', SCP_PU . 'inc/share.js', array( 'jquery' ), false, true );

		}

		/**
		 * Load the widget
		 * @return Null
		 **/
		function scp_loadwidget() {

			register_widget( 'SCP_Widget' );

		}

		/**
		 * Create the social button output
		 *
		 * @return null
		 **/
		function scp_social_buttons() {

			global $scpoptions, $post;
			
			//Get the URLs
			$short_url = get_post_meta( $post->ID, '_yoast_bitlylink', true );
			$full_url = get_permalink( $post->ID );
			
			if ( strlen( $short_url ) < 1 ) {
				$share_url = $full_url;
			} else {
				$share_url = $short_url;
			}
			
			
			//get the twitter username
			$twitteruser = stripslashes( $scpoptions['twitteruser'] );

			//initialize the buttons
			$buttons = '';

			//lets sort the buttons by weight
			$buttonarray = array( 
				$scpoptions['bufferweight'] => 'Buffer',
				$scpoptions['facebookweight'] => 'Facebook',
				$scpoptions['googleweight'] => 'Google',
				$scpoptions['linkedinweight'] => 'LinkedIn',
				$scpoptions['pinterestweight'] => 'Pinterest',
				$scpoptions['stumbleuponweight'] => 'StumbleUpon',
				$scpoptions['twitterweight'] => 'Twitter'
			);

			ksort ( $buttonarray );
			
			$buttons .= "\n<!--## Begin Share Center Pro Scripts ## -->\n";	
			$buttons .= "<div class=\"scpclear\"></div>\n";
			$buttons .= "<div id=\"share-center-pro\">\n";

			if ( $scpoptions['facebook'] == 1 ) {
				$buttons .= "<div id=\"fb-root\"></div>";
			}

			if ( strlen( $scpoptions['header'] ) > 1 ) {
				$buttons .= "<div class=\"scpHeading\">" . $scpoptions['header'] . "</div>\n";
				$buttons .= "<div class=\"scpclear\"></div>\n";
			}

			foreach ( $buttonarray as $weight => $button ) {
										
				switch ( $button ) {

					case 'Buffer':
						if ( $scpoptions['buffer'] == 1 ) {
							$buttons .= "<div class=\"scpBuffer\"><a href=\"http://bufferapp.com/add\" class=\"buffer-add-button\" data-url=\"" . $share_url . "\"data-count=\"vertical\" data-via=\"" . $twitteruser . "\"></a></div>\n";
						}
						break;
					case 'Facebook':
						if ( $scpoptions['facebook'] == 1 ) {
							$buttons .= "<div class=\"scpFacebook\"><div class=\"fb-like\" data-href=\"" . urldecode( $share_url ) . "\" data-send=\"false\" data-layout=\"box_count\" data-width=\"450\" data-show-faces=\"false\"></div></div>\n";
						}
						break;
					case 'Google':
						if ( $scpoptions['google'] == 1 ) {
							$buttons .= "<div class=\"scpGoogle\"><g:plusone size=\"tall\" href=\"" . $share_url . "\"></g:plusone></div>\n";
						}	
						break;
					case 'LinkedIn':
						if ( $scpoptions['linkedin'] == 1 ) {
							$buttons .= "<div class=\"scpLinkedin\"><script type=\"in/share\" data-counter=\"top\" url=\"" . $share_url . "\"></script></div>\n";
						}	
						break;
					case 'Pinterest':
						if ( $scpoptions['pinterest'] == 1 ) {
							$buttons .="<div class=\"scpPinterest\"><a href=\"http://pinterest.com/pin/create/button/?url=" . urlencode( $share_url ) . "&media=" . urlencode( wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ) ) . "\" class=\"pin-it-button\" count-layout=\"vertical\"><img border=\"0\" src=\"//assets.pinterest.com/images/PinExt.png\" title=\"Pin It\" /></a></div>\n";
						}
						break;
					case 'StumbleUpon':
						if ( $scpoptions['stumbleupon'] == 1 ) {
							$buttons .="<div class=\"scpStumbleupon\"><su:badge layout=\"5\" location=\"" . $share_url . "\"></su:badge></div>\n";
						}
						break;
					case 'Twitter':
						if ( $scpoptions['twitter'] == 1 ) {
							$buttons .= "<div class=\"scpTwitter\"><a href=\"http://twitter.com/share\" class=\"twitter-share-button\"  data-url=\"" . $share_url . "\" data-counturl=\"" . $full_url . "\" data-text=\"" . get_the_title() . "\" data-count=\"vertical\" data-via=\"" . $twitteruser . "\"></a></div>\n";
						}
						break;

				}

			}

			$buttons .= "<span class=\"stretch\"></span>\n";
			$buttons .= "</div>\n";
			$buttons .= "<div class=\"scpclear\"></div>\n";
			$buttons .= "<!--## End Share Center Pro Scripts ## -->\n";	
			
			return $buttons;

		}
		
	}

}

//create plugin object
global $bit51scp; 
$bit51scp = new bit51_scp();
