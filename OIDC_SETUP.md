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

The plugin will automatically detect Nextcloud cookies when available. No additional configuration is required.

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

The plugin looks for these Nextcloud cookies:

- `nc_token` - Authentication token
- `nc_username` - Your username
- `nc_session_id` - Session identifier

## Troubleshooting

### Cookies Not Detected

1. Ensure you're logged into Nextcloud
2. Check that both Roundcube and Nextcloud are on the same domain
3. Verify cookies are not blocked by browser settings
4. Check that HTTPS is properly configured

### Connection Issues

1. Verify the CalDAV URL is correct
2. Check that Nextcloud CalDAV is enabled
3. Ensure your user has calendar permissions
4. Check Nextcloud logs for authentication errors

## Security Notes

- Cookies are marked as `HttpOnly` and `Secure` by Nextcloud
- Authentication tokens are automatically managed by Nextcloud
- No passwords are stored in Roundcube when using OIDC mode

## Fallback

If Nextcloud cookies are not available, the plugin falls back to traditional username/password authentication, maintaining backward compatibility.
