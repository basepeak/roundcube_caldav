<?php

/**
 * Nextcloud Cookie Helper class for Roundcube CalDAV plugin
 * 
 * This class handles Nextcloud authentication by reading cookies and provides methods
 * to extract user information and tokens for CalDAV connections.
 */

class oidc_helper
{
    private $rcube;
    private $config;
    private $cookie_names;
    
    public function __construct($rcube)
    {
        $this->rcube = $rcube;
        $this->config = $rcube->config;
        
        // Get configurable cookie names with fallback to defaults
        $this->cookie_names = $this->config->get('nextcloud_cookies', [
            'token' => 'nc_token',
            'username' => 'nc_username',
            'session_id' => 'nc_session_id'
        ]);
    }
    
    /**
     * Check if Nextcloud cookies are available
     * 
     * @return bool
     */
    public function isOidcEnabled(): bool
    {
        // Check if we have the necessary Nextcloud cookies
        $has_cookies = $this->hasNextcloudCookies();
        
        // Log cookie status for debugging
        error_log("OIDC Cookie Status:");
        error_log("  " . $this->cookie_names['token'] . ": " . (isset($_COOKIE[$this->cookie_names['token']]) ? 'Present' : 'Missing'));
        error_log("  " . $this->cookie_names['username'] . ": " . (isset($_COOKIE[$this->cookie_names['username']]) ? 'Present' : 'Missing'));
        error_log("  " . $this->cookie_names['session_id'] . ": " . (isset($_COOKIE[$this->cookie_names['session_id']]) ? 'Present' : 'Missing'));
        error_log("  All cookies present: " . ($has_cookies ? 'Yes' : 'No'));
        
        return $has_cookies;
    }
    
    /**
     * Check if we have the necessary Nextcloud cookies
     * 
     * @return bool
     */
    private function hasNextcloudCookies(): bool
    {
        return isset($_COOKIE[$this->cookie_names['token']]) && 
               isset($_COOKIE[$this->cookie_names['username']]) && 
               isset($_COOKIE[$this->cookie_names['session_id']]);
    }
    
    /**
     * Get the current domain from the request
     * 
     * @return string
     */
    public function getCurrentDomain(): string
    {
        $host = $_SERVER['HTTP_HOST'] ?? '';
        $port = $_SERVER['SERVER_PORT'] ?? '';
        
        if ($port && $port != '80' && $port != '443') {
            $host .= ':' . $port;
        }
        
        return $host;
    }
    
    /**
     * Auto-generate CalDAV URL based on domain
     * 
     * @return string
     */
    public function generateCalDavUrl(): string
    {
        $domain = $this->getCurrentDomain();
        $protocol = $this->isSecure() ? 'https' : 'http';
        
        // Get configurable CalDAV path with fallback to default
        $caldavPath = $this->config->get('caldav_path', '/remote.php/dav/calendars/');
        
        $url = $protocol . '://' . $domain . $caldavPath . $this->getUsername();
        
        error_log("OIDC CalDAV URL Generated: " . $url);
        
        return $url;
    }
    
    /**
     * Check if the current connection is secure
     * 
     * @return bool
     */
    private function isSecure(): bool
    {
        return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            || $_SERVER['SERVER_PORT'] == 443
            || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');
    }
    
    /**
     * Get Nextcloud token from cookies
     * 
     * @return string|null
     */
    public function getAccessToken(): ?string
    {
        $token = $_COOKIE[$this->cookie_names['token']] ?? null;
        
        if ($token) {
            error_log("OIDC Token Retrieved: " . substr($token, 0, 20) . "...");
        } else {
            error_log("OIDC Token: Not found in cookies");
        }
        
        return $token;
    }
    
    /**
     * Get Nextcloud username from cookies
     * 
     * @return string|null
     */
    public function getUsername(): ?string
    {
        $username = $_COOKIE[$this->cookie_names['username']] ?? null;
        
        if ($username) {
            error_log("OIDC Username Retrieved: " . $username);
        } else {
            error_log("OIDC Username: Not found in cookies");
        }
        
        return $username;
    }
    
    /**
     * Get Nextcloud session ID from cookies
     * 
     * @return string|null
     */
    public function getSessionId(): ?string
    {
        return $_COOKIE[$this->cookie_names['session_id']] ?? null;
    }
    
    /**
     * Check if we have valid Nextcloud credentials
     * 
     * @return bool
     */
    public function hasValidCredentials(): bool
    {
        return $this->hasNextcloudCookies() && 
               $this->getAccessToken() !== null && 
               $this->getUsername() !== null;
    }
    
    /**
     * Get CalDAV authentication credentials for basic auth
     * Uses OIDC token as password for basic authentication
     * 
     * @return array
     */
    public function getCalDavCredentials(): array
    {
        return [
            'username' => $this->getUsername(),
            'password' => $this->getAccessToken(), // Use OIDC token as password
            'token' => $this->getAccessToken()
        ];
    }
    
    /**
     * Create custom cURL options for OIDC basic authentication
     * 
     * @return array
     */
    public function getCurlOptions(): array
    {
        $username = $this->getUsername();
        $token = $this->getAccessToken();
        
        if ($username && $token) {
            return [
                CURLOPT_USERPWD => $username . ':' . $token,
                CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
                CURLOPT_HTTPHEADER => [
                    'Content-Type: text/calendar; charset=UTF-8'
                ]
            ];
        }
        
        return [];
    }
    
    /**
     * Get Nextcloud configuration
     * 
     * @return array
     */
    public function getOidcConfig(): array
    {
        return [
            'enabled' => $this->isOidcEnabled(),
            'domain' => $this->getCurrentDomain(),
            'caldav_url' => $this->generateCalDavUrl(),
            'username' => $this->getUsername(),
            'session_id' => $this->getSessionId(),
            'has_credentials' => $this->hasValidCredentials(),
            'cookie_names' => $this->cookie_names
        ];
    }
}
