<?php
/*
Plugin Name: New Nine Adaptive Images
Description: New Nine's Adaptive Images detects your visitor's screen size and automatically creates, caches, and delivers device appropriate re-scaled versions of your web page's embeded HTML images. This plugin loads Adaptive Images and the retina-ready scripts to your website, and creates a cache folder (ai-cache) in the /wp-content/uploads folder. A one-time edit of your .htaccess is required. See the settings screen.
Version: 1.5.2
Author: New Nine Media & Advertising
Author URI: http://www.newnine.com
License: GPL2
Copyright:  2013 NEW NINE MEDIA LP, 7134 W GRAND AVE, CHICAGO, IL 60707
            This program is free software; you can redistribute it and/or modify
            it under the terms of the GNU General Public License, version 2, as
            published by the Free Software Foundation.

            This program is distributed in the hope that it will be useful,
            but WITHOUT ANY WARRANTY; without even the implied warranty of
            MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
            GNU General Public License for more details.

            You should have received a copy of the GNU General Public License
            along with this program; if not, write to the Free Software
            Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
defined( 'ABSPATH' ) OR exit;
class NewNineAdaptiveImages{
    function activate(){
        $breakpoints = get_option( 'adaptive_images_breakpoints' );
        if( !$breakpoints ){
            update_option( 'adaptive_images_breakpoints' , '768, 980, 1200' );
        }
        $quality = get_option( 'adaptive_images_jpg_quality' );
        if( empty( $quality ) ){
            update_option( 'adaptive_images_jpg_quality' , '80' );
        }
        $watch_cache = get_option( 'adaptive_images_watch_cache' );
        if( empty( $watch_cache ) ){
            update_option( 'adaptive_images_watch_cache' , '0' );
        }
        $time_cache = get_option( 'adaptive_images_time_cache' );
        if( empty( $time_cache ) ){
            update_option( 'adaptive_images_time_cache' , '604800' );
        }
        $sharpen = get_option( 'adaptive_images_sharpen' );
        if( empty( $sharpen ) ){
            update_option( 'adaptive_images_sharpen' , 1 );
        }
        delete_option( 'adaptive_images_notice' );
    }
    function admin_notice(){
        global $pagenow;
        $notice = get_option( 'adaptive_images_notice' );
        if( !$notice && $pagenow == 'plugins.php' ){
            printf(
                '<div class="updated"><p>Thanks for activating Adaptive Images! Please <a href="%1$s" target="_blank"><u>rate it</u></a> so we know if we should keep building great plugins like this one. New Nine is <a href="%2$s" target="_blank">on Facebook</a> | <a href="%3$s" target="_blank">on Twitter</a> | <a href="%4$s" target="_blank">on Google+</a> | <a href="%6$s">Delete this notice</a></p></div>' ,
                'http://wordpress.org/plugins/new-nine-adaptive-images/',
                'http://www.facebook.com/new9media',
                'http://twitter.com/NewNineMedia',
                'http://plus.google.com/u/0/116091776202640137729',
                'http://www.newnine.com',
                '?n9m-adaptive-images-notice=1'
            );
        }
    }
    function admin_notice_ignore(){
        if( isset( $_GET['n9m-adaptive-images-notice'] ) && '1' == $_GET['n9m-adaptive-images-notice'] ) {
            update_option( 'adaptive_images_notice' , 1 );
        }
    }
    function enqueue_front(){
        wp_register_script( 'adaptive-images', plugins_url( '/script.js', __FILE__ ), '', '1.5.2', false );
        wp_enqueue_script( 'adaptive-images' );
    }
    function plugin_menu_links( $links ){
        $settings_link = '<a href="'.admin_url( '/options-media.php' ).'">Settings</a>';
        array_push( $links, $settings_link );
        return $links;
    }
    function settings_api_init(){
        add_settings_section(
            'adaptive_images_section',
            'Adaptive Images Settings',
            array( &$this, 'settings_section_callback' ),
            'media'
        );
        add_settings_section(
            'adaptive_images_htaccess_section',
            'Adaptive Images .htaccess',
            array( &$this, 'settings_section_htaccess_callback' ),
            'media'
        );
        add_settings_field(
            'adaptive_images_breakpoints',
            'Breakpoints',
            array( &$this, 'settings_breakpoints_callback' ),
            'media',
            'adaptive_images_section'
        );
        add_settings_field(
            'adaptive_images_jpg_quality',
            'Image Quality',
            array( &$this, 'settings_jpg_quality_callback' ),
            'media',
            'adaptive_images_section'
        );
        add_settings_field(
            'adaptive_images_watch_cache',
            'Watch Cache?',
            array( &$this, 'settings_watch_cache_callback' ),
            'media',
            'adaptive_images_section'
        );
        add_settings_field(
            'adaptive_images_time_cache',
            'Duration of Cache',
            array( &$this, 'settings_time_cache_callback' ),
            'media',
            'adaptive_images_section'
        );
        add_settings_field(
            'adaptive_images_sharpen',
            'Sharpen Image',
            array( &$this, 'settings_sharpen_callback' ),
            'media',
            'adaptive_images_section'
        );
        register_setting( 'media', 'adaptive_images_breakpoints' );
        register_setting( 'media', 'adaptive_images_jpg_quality' );
        register_setting( 'media', 'adaptive_images_watch_cache' );
        register_setting( 'media', 'adaptive_images_time_cache' );
        register_setting( 'media', 'adaptive_images_sharpen' );
    }
    function settings_breakpoints_callback(){
        print '<p><input name="adaptive_images_breakpoints" type="text" class="regular-text" value="'. get_option( 'adaptive_images_breakpoints' ) .'" /> <span class="description">Separate breakpoints by commas. Must be in pixels. You can set as many or as few as you like, but this should generally match your CSS breakpoints.</span></p>';
    }
    function settings_jpg_quality_callback(){
        print '<p><input name="adaptive_images_jpg_quality" type="text" class="small-text" value="'. get_option( 'adaptive_images_jpg_quality' ) .'" /> <span class="description">Set the quality of any generated JPG images. Quality can be any number from 0 (worst) to 100 (best), with better quality resulting in larger files sizes. You can&#8217;t control the quality of GIF or PNG images.</span></p>';
    }
    function settings_watch_cache_callback(){
        print '<p><input name="adaptive_images_watch_cache" type="checkbox" class="code" '.checked( 1, get_option('adaptive_images_watch_cache'), false ).' /> Check to see if you uploaded a newer version of the image or not. <span class="description">You only need this turned on if you routinely replace uploaded images via FTP and don&#8217;t want to manually clear the cache. If you don&#8217;t know what that means, you can probably leave this unchecked.</span></p>';
    }
    function settings_time_cache_callback(){
        print '<p><input name="adaptive_images_time_cache" type="text" value="'. get_option( 'adaptive_images_time_cache' ) .'" /> seconds &ndash; <span class="description">How long should the browser save (cache) the image before checking for a new one? This value must be in seconds. eg, one week = 604800 = 60 x 60 x 24 x 7, or 60 seconds per minute x 60 minutes per hour x 24 hours per day x 7 days</span></p>';
    }
    function settings_sharpen_callback(){
        print '<p><input name="adaptive_images_sharpen" type="checkbox" class="code" '.checked( 1, get_option('adaptive_images_sharpen'), false ).' /> Apply a subtle sharpening to rescaled images? This could help preserve details on rescaled images, but is not required.</p>';
    }
    function settings_section_callback(){
        print '<p>Configure your Adaptive Images settings here. If you haven&#8217;t already done so, you will also need to edit your <code>.htaccess</code> file. See the <strong>Adaptive Images .htaccess</strong> section below.</p>';
    }
    function settings_section_htaccess_callback(){
        print '<p>Add the following to your <code>.htaccess</code> file to enable Adaptive Images to your site. We usually place this just below <code>RewriteEngine On</code>; but, if you know what you&#8217;re doing, you can put it elsewhere in your <code>.htaccess</code>.</p>';
        print '<textarea class="code" rows="6" cols="100" readonly="readonly">RewriteCond %{REQUEST_URI} ';
            $n9m_uploads_dir_array=wp_upload_dir();
            print rtrim( ltrim( str_replace( ABSPATH, '', $n9m_uploads_dir_array['basedir'] ), '/' ), '/' );
            print PHP_EOL;
            print 'RewriteRule \.(?:jpe?g|gif|png)$ '.str_replace( ABSPATH, '', dirname( __FILE__ ) ).'/adaptive-images.php [L]';
        print '</textarea>';
    }
    function __construct(){
        add_action( 'admin_init', array( &$this, 'admin_notice_ignore' ) );
        add_action( 'admin_init', array( &$this, 'settings_api_init' ) );
        add_action( 'admin_notices', array( &$this, 'admin_notice' ) );
        add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_front' ) );
        add_filter( 'plugin_action_links_'.plugin_basename( __FILE__ ), array( &$this, 'plugin_menu_links') , 10 , 2 );
        register_activation_hook( __FILE__, array( &$this, 'activate' ) );
    }
}
new NewNineAdaptiveImages();

?>