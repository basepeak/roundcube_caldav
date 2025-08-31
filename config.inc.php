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
$config['nextcloud_cookies'] = [
    'token' => 'nc_token',
    'username' => 'nc_username',
    'session_id' => 'nc_session_id'
];
