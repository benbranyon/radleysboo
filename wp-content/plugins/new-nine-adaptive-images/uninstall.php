<?php
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
} else {
    delete_option( 'adaptive_images_breakpoints' );
    delete_option( 'adaptive_images_jpg_quality' );
    delete_option( 'adaptive_images_watch_cache' );
    delete_option( 'adaptive_images_time_cache' );
    delete_option( 'adaptive_images_sharpen' );
    delete_option( 'adaptive_images_notice' );
}
?>