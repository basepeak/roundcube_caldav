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
$config['nextcloud_domain'] = '%HOST%';

// CalDAV path configuration
$config['caldav_path'] = '/remote.php/dav/calendars/';

// Cookie Detection Method
// The plugin automatically detects Nextcloud authentication cookies:
// - Dynamic ocXXXXXXXX cookie: Automatically finds the Nextcloud session token
//   (e.g., ocwe8qziyo2m, ocabc123def) using regex pattern /^oc[a-z0-9]+$/
// - nc_username: Contains the authenticated username
// - nc_session_id: Contains the session identifier
//
// No manual configuration required - the plugin will automatically
// detect and use the appropriate cookies for authentication.
