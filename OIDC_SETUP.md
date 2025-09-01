# OIDC Setup for Roundcube CalDAV Plugin

This plugin has been enhanced to support automatic CalDAV configuration using Nextcloud cookies instead of manual username/password entry.

## How It Works

The plugin automatically detects when you're logged into Nextcloud via OIDC and uses the session cookies to:

1. Auto-generate the CalDAV URL based on your current domain
2. Extract your username from the Nextcloud session
3. Use the Nextcloud authentication token for CalDAV connections

## Requirements

- Roundcube and Nextcloud running on the same domain (e.g., `foo.cloud`)
- Nextcloud accessible at `foo.cloud/nextcloud` (or similar)
- Roundcube accessible at `foo.cloud/smail`
- Nextcloud login via OIDC
- Both services using HTTPS

## Setup

### 1. Install Dependencies

```bash
cd plugins/roundcube_caldav
composer update
```

### 2. Enable the Plugin

Add `roundcube_caldav` to your Roundcube plugins array in `config/config.inc.php`:

```php
$config['plugins'] = [
    'roundcube_caldav',
    // ... other plugins
];
```

### 3. Configure OIDC Support

#### Basic Configuration

Include the plugin's configuration in your Roundcube `config/config.inc.php`:

```php
// Include the plugin configuration
require_once(__DIR__ . '/plugins/roundcube_caldav/config.inc.php');
```

#### Customizing Cookie Names

The plugin uses configurable cookie names to support different Nextcloud/OpenID Connect setups. You can customize these in your configuration:

```php
// Default configuration for standard Nextcloud installations
$config['nextcloud_cookies'] = [
    'token' => 'nc_token',        // Cookie containing the OIDC access token
    'username' => 'nc_username',  // Cookie containing the authenticated username
    'session_id' => 'nc_session_id' // Cookie containing the session identifier
];

// Alternative configurations for custom setups:
// For custom Nextcloud installations:
$config['nextcloud_cookies'] = [
    'token' => 'myapp_token',
    'username' => 'myapp_user',
    'session_id' => 'myapp_session'
];

// For generic OIDC providers:
$config['nextcloud_cookies'] = [
    'token' => 'oidc_access_token',
    'username' => 'oidc_user',
    'session_id' => 'oidc_session'
];
```

#### Additional Configuration Options

```php
// Enable/disable OIDC support
$config['oidc_enabled'] = true;

// Custom Nextcloud domain (if different from current domain)
$config['nextcloud_domain'] = 'cloud.example.com';

// Custom CalDAV path
$config['caldav_path'] = '/remote.php/dav/calendars/';
```

## Usage

### Automatic Configuration

When you access the CalDAV settings in Roundcube:

1. **URL**: Automatically filled with `https://yourdomain.com/remote.php/dav/calendars/`
2. **Username**: Automatically filled with your Nextcloud username
3. **Password**: Not required (disabled) when using Nextcloud cookies

### Manual Override

You can still manually enter credentials if needed:

- Clear the auto-filled fields
- Enter your own CalDAV server details
- Use traditional username/password authentication

## Cookie Detection

### Default Cookie Names

The plugin looks for these Nextcloud cookies by default:

- `nc_token` - Authentication token
- `nc_username` - Your username
- `nc_session_id` - Session identifier

### Custom Cookie Names

If your Nextcloud installation uses different cookie names, you can configure them in the `nextcloud_cookies` array. The plugin will automatically use your custom cookie names for authentication.

## Troubleshooting

### Cookies Not Detected

1. Ensure you're logged into Nextcloud
2. Check that both Roundcube and Nextcloud are on the same domain
3. Verify cookies are not blocked by browser settings
4. Check that HTTPS is properly configured
5. **Verify cookie names match your configuration** - If your Nextcloud uses custom cookie names, make sure they're correctly configured in `nextcloud_cookies`

### Connection Issues

1. Verify the CalDAV URL is correct
2. Check that Nextcloud CalDAV is enabled
3. Ensure your user has calendar permissions
4. Check Nextcloud logs for authentication errors
5. **Check cookie configuration** - Ensure the cookie names in your configuration match what your Nextcloud installation actually uses

### Debugging Cookie Detection

You can check the Roundcube error logs to see which cookies are being detected:

```bash
tail -f /path/to/roundcube/logs/errors
```

Look for log entries starting with "OIDC Cookie Status:" to see which cookies are present or missing.

## Security Notes

- Cookies are marked as `HttpOnly` and `Secure` by Nextcloud
- Authentication tokens are automatically managed by Nextcloud
- No passwords are stored in Roundcube when using OIDC mode
- Cookie names are configurable to support different security setups

## Fallback

If Nextcloud cookies are not available, the plugin falls back to traditional username/password authentication, maintaining backward compatibility.
