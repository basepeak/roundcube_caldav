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

1. **URL**: Automatically filled with `https://yourdomain.com/remote.php/dav/calendars/username`
2. **Username**: Automatically filled with your Nextcloud username
3. **Password**: Not required (disabled) when using Nextcloud cookies

### Manual Override

You can still manually enter credentials if needed:

- Clear the auto-filled fields
- Enter your own CalDAV server details
- Use traditional username/password authentication

## Cookie Detection

### Automatic Cookie Detection

The plugin automatically detects these Nextcloud cookies:

- **Dynamic ocXXXXXXXX cookie**: Automatically finds the Nextcloud session token using regex pattern `/^oc[a-z0-9]+$/`
  - Examples: `ocwe8qziyo2m`, `ocabc123def`, `ocxyz789`
  - This cookie contains the authentication token used for CalDAV access
- **nc_username**: Contains the authenticated username
- **nc_session_id**: Contains the session identifier

### How Dynamic Cookie Detection Works

The plugin searches for cookies that match the pattern `oc` followed by one or more lowercase letters or digits. This allows it to work with any Nextcloud installation regardless of the specific cookie name, as Nextcloud generates these cookies dynamically.

## Troubleshooting

### Cookies Not Detected

1. Ensure you're logged into Nextcloud
2. Check that both Roundcube and Nextcloud are on the same domain
3. Verify cookies are not blocked by browser settings
4. Check that HTTPS is properly configured
5. **Verify Nextcloud cookie format**: Ensure your Nextcloud installation uses the standard `ocXXXXXXXX` cookie naming pattern

### Connection Issues

1. Verify the CalDAV URL is correct (should include username at the end)
2. Check that Nextcloud CalDAV is enabled
3. Ensure your user has calendar permissions
4. Check Nextcloud logs for authentication errors
5. **Check cookie detection**: Ensure the plugin can find the dynamic `ocXXXXXXXX` cookie

### Debugging Cookie Detection

You can check the Roundcube error logs to see which cookies are being detected:

```bash
tail -f /path/to/roundcube/logs/errors
```

Look for log entries starting with "OIDC Cookie Status:" to see which cookies are present or missing.

### Common Issues

**"ocXXXXXXXX cookie: Missing"**
- Make sure you're logged into Nextcloud
- Check that cookies are enabled in your browser
- Verify that both services are on the same domain

**"Dynamic token not found"**
- The plugin couldn't find a cookie matching the `oc[a-z0-9]+` pattern
- This might indicate a custom Nextcloud setup with different cookie naming

## Security Notes

- Cookies are marked as `HttpOnly` and `Secure` by Nextcloud
- Authentication tokens are automatically managed by Nextcloud
- No passwords are stored in Roundcube when using OIDC mode
- Dynamic cookie detection ensures compatibility with different Nextcloud setups

## Fallback

If Nextcloud cookies are not available, the plugin falls back to traditional username/password authentication, maintaining backward compatibility.
