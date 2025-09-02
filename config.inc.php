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
