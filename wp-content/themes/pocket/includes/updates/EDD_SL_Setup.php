<?php
/**
 * This file handles the theme update process. 
 *
 * @package WordPress
 * @subpackage Pocket
 */


// This is the URL the updater / license checker pings
define( 'OKAY_EDD_SL_STORE_URL', 'http://okaythemes.com' );

// The name of the theme
define( 'OKAY_EDD_SL_THEME_NAME', 'Pocket WordPress Theme' );


// Add license to theme
function okay_license_setup() {
	add_option( 'pocket_activate_license', '22be199696dfa6686430325a7176c8cd' );
}
add_action( 'init', 'okay_license_setup' );


// Initialize the EDD update class
if ( !class_exists( 'EDD_SL_Theme_Updater' ) ) {
	include( dirname( __FILE__ ) . '/EDD_SL_Theme_Updater.php' );
}

$theme_license = trim( get_option( 'pocket_activate_license' ) );

$edd_updater = new EDD_SL_Theme_Updater( array(
		'remote_api_url' 	=> OKAY_EDD_SL_STORE_URL, 	// Our store URL that is running EDD
		'version' 			=> '2.9', 				// The current theme version we are running
		'license' 			=> $theme_license, 		// The license key (used get_option above to retrieve from DB)
		'item_name' 		=> OKAY_EDD_SL_THEME_NAME,	// The name of this theme
		'author'			=> 'Okay Themes'	// The author's name
	)
);


// Activate the license
function okay_edd_activate_license($oldname, $oldtheme=false) {

	 	global $wp_version;

		$license = trim( get_option( 'pocket_activate_license' ) );

		$api_params = array(
			'edd_action' => 'activate_license',
			'license' => $license,
			'item_name' => urlencode( OKAY_EDD_SL_THEME_NAME )
		);

		$response = wp_remote_get( add_query_arg( $api_params, OKAY_EDD_SL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

		if ( is_wp_error( $response ) )
			return false;

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "active" or "inactive"

		update_option( 'edd_sample_theme_license_key_status', $license_data->license );
	
}
add_action("after_switch_theme", "okay_edd_activate_license", 10 , 2);


// Deactivate the license on theme switch
function okay_edd_deactivate_license() {
   
    $theme_license = trim( get_option( 'pocket_activate_license' ) );

    // data to send in our API request
	$api_params = array( 
		'edd_action' => 'deactivate_license', 
		'license'    => $theme_license, 
		'item_name'  => OKAY_EDD_SL_THEME_NAME // the name of our product in EDD
	);
	 
	// Send the remote request
	$response = wp_remote_get( add_query_arg( $api_params, OKAY_EDD_SL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) ); 

	// Delete the option
	delete_option( 'pocket_activate_license' );
	
}
add_action('switch_theme', 'okay_edd_deactivate_license');