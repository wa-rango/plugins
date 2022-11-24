<?php
if( !defined( 'WP_UNISTALL_PLUGIN')) {
    exit();
}

$option_name = 'sc_option';
delete_option($option_name);

global $wpdb;

$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}mitabla" );