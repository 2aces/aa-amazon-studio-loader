<?php
/**
 * Amazon's Publisher Studio Loader by 2Aces Uninstaller
 */

if( !defined( 'ABSPATH') && !defined('WP_UNINSTALL_PLUGIN') ) exit();
delete_option( 'aa_apsl_publisher_id');
delete_option( 'aa_apsl_publisher_filename');
?>
