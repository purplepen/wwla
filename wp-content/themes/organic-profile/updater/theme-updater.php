<?php

/*-----------------------------------------------------------------------------------------------------//
/*	Theme License and Updater
/*-----------------------------------------------------------------------------------------------------*/

// Includes the files needed for the theme updater
if ( !class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'https://organicthemes.com', // Site where EDD is hosted
		'item_name' => 'Profile Theme + Support & Updates Subscription', // Name of theme
		'theme_slug' => 'organic-profile', // Theme slug
		'version' => '2.3', // The current version of this theme
		'author' => 'Organic Themes', // The author of this theme
		'download_id' => '42825', // Optional, used for generating a license renewal link
		'renew_url' => '' // Optional, allows for a custom license renewal link
	),

	// Strings
	$strings = array(
		'theme-license' => __( 'Theme License', 'organic-profile' ),
		'enter-key' => __( 'Enter your theme license key.', 'organic-profile' ),
		'license-key' => __( 'License Key', 'organic-profile' ),
		'license-action' => __( 'License Action', 'organic-profile' ),
		'deactivate-license' => __( 'Deactivate License', 'organic-profile' ),
		'activate-license' => __( 'Activate License', 'organic-profile' ),
		'status-unknown' => __( 'License status is unknown.', 'organic-profile' ),
		'renew' => __( 'Renew?', 'organic-profile' ),
		'unlimited' => __( 'unlimited', 'organic-profile' ),
		'license-key-is-active' => __( 'License key is active.', 'organic-profile' ),
		'expires%s' => __( 'Expires %s.', 'organic-profile' ),
		'%1$s/%2$-sites' => __( 'You have %1$s / %2$s sites activated.', 'organic-profile' ),
		'license-key-expired-%s' => __( 'License key expired %s.', 'organic-profile' ),
		'license-key-expired' => __( 'License key has expired.', 'organic-profile' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'organic-profile' ),
		'license-is-inactive' => __( 'License is inactive.', 'organic-profile' ),
		'license-key-is-disabled' => __( 'License key is disabled.', 'organic-profile' ),
		'site-is-inactive' => __( 'Site is inactive.', 'organic-profile' ),
		'license-status-unknown' => __( 'License status is unknown.', 'organic-profile' ),
		'update-notice' => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'organic-profile' ),
		'update-available' => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'organic-profile' )
	)

);