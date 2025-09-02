# Changelog

## [Unreleased] - 2024-01-XX

### Added
- **Dynamic cookie detection for OIDC authentication**: The plugin now automatically detects Nextcloud session cookies using a dynamic pattern matching approach
- Support for automatic detection of `ocXXXXXXXX` cookies (e.g., `ocwe8qziyo2m`, `ocabc123def`) using regex pattern `/^oc[a-z0-9]+$/`
- Enhanced configuration documentation with examples for different deployment scenarios
- Comprehensive test suite for the dynamic cookie detection functionality
- New `getAccountFromCookie()` method for retrieving username and password from cookies

### Changed
- Modified `oidc_helper.php` to use dynamic cookie detection instead of hardcoded cookie names
- Updated `config.inc.php` with documentation about automatic cookie detection
- Enhanced `OIDC_SETUP.md` with troubleshooting information for dynamic cookie detection
- CalDAV URL generation now includes username at the end of the path
- Replaced `getAccessToken()` method with `findOcRandomCookieValue()` for better semantic clarity

### Technical Details
- Cookie detection uses regex pattern `/^oc[a-z0-9]+$/` to find dynamic Nextcloud session tokens
- Automatically works with any Nextcloud installation regardless of specific cookie naming
- No manual configuration required - plugin automatically detects appropriate cookies
- Backward compatibility maintained - existing installations continue to work without changes

### Migration
No migration required for existing installations. The plugin will automatically detect and use the appropriate Nextcloud cookies. The new dynamic detection approach provides better compatibility with different Nextcloud setups.
