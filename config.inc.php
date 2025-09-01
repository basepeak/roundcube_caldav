<?php

/**
 * Configuration file for Roundcube CalDAV plugin with OIDC support
 * 
 * This file should be included in your Roundcube config/config.inc.php
 * or placed in the plugin directory and loaded by the plugin.
 */

// Enable OIDC/Nextcloud cookie support
$config['oidc_enabled'] = true;

// Nextcloud domain configuration
$config['nextcloud_domain'] = 'cloud.basepeak.dev';

// CalDAV path configuration
$config['caldav_path'] = '/remote.php/dav/calendars/';

// Cookie names for Nextcloud authentication
// These can be customized based on your Nextcloud/OpenID Connect setup
// Default values are for standard Nextcloud installations
$config['nextcloud_cookies'] = [
    'token' => 'nc_token',        // Cookie containing the OIDC access token
    'username' => 'nc_username',  // Cookie containing the authenticated username
    'session_id' => 'nc_session_id' // Cookie containing the session identifier
];

// Alternative cookie configurations for different setups:
// 
// For custom Nextcloud installations with different cookie names:
// $config['nextcloud_cookies'] = [
//     'token' => 'myapp_token',
//     'username' => 'myapp_user',
//     'session_id' => 'myapp_session'
// ];
// 
// For generic OIDC providers:
// $config['nextcloud_cookies'] = [
//     'token' => 'oidc_access_token',
//     'username' => 'oidc_user',
//     'session_id' => 'oidc_session'
// ];
