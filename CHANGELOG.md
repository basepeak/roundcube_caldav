# Changelog

## [Unreleased] - 2024-01-XX

### Added
- **Configurable cookie names for OIDC authentication**: The cookie keys used to retrieve tokens, usernames, and session IDs are now configurable through the `nextcloud_cookies` configuration array
- Support for custom Nextcloud/OpenID Connect setups with different cookie naming conventions
- Enhanced configuration documentation with examples for different deployment scenarios
- Comprehensive test suite for the configurable cookie functionality

### Changed
- Modified `oidc_helper.php` to use configurable cookie names instead of hardcoded values
- Updated `config.inc.php` with detailed documentation and example configurations
- Enhanced `OIDC_SETUP.md` with troubleshooting information for custom cookie configurations
- Added fallback mechanism to default cookie names when no custom configuration is provided

### Technical Details
- Cookie names are now retrieved from `$config['nextcloud_cookies']` array
- Default fallback values: `nc_token`, `nc_username`, `nc_session_id`
- Configuration supports custom deployments with different cookie naming schemes
- Backward compatibility maintained - existing installations continue to work without changes

### Migration
No migration required for existing installations. The plugin will continue to work with the default cookie names. To use custom cookie names, add the `nextcloud_cookies` configuration to your Roundcube config.
