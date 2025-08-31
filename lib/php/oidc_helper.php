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
    
    public function __construct($rcube)
    {
        $this->rcube = $rcube;
        $this->config = $rcube->config;
    }
    
    /**
     * Check if Nextcloud cookies are available
     * 
     * @return bool
     */
    public function isOidcEnabled(): bool
    {
        // Check if we have the necessary Nextcloud cookies
        return $this->hasNextcloudCookies();
    }
    
    /**
     * Check if we have the necessary Nextcloud cookies
     * 
     * @return bool
     */
    private function hasNextcloudCookies(): bool
    {
        return isset($_COOKIE['nc_token']) && 
               isset($_COOKIE['nc_username']) && 
               isset($_COOKIE['nc_session_id']);
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
        
        // Default Nextcloud CalDAV path
        $caldavPath = '/remote.php/dav/calendars/';
        
        return $protocol . '://' . $domain . $caldavPath;
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
        return $_COOKIE['nc_token'] ?? null;
    }
    
    /**
     * Get Nextcloud username from cookies
     * 
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $_COOKIE['nc_username'] ?? null;
    }
    
    /**
     * Get Nextcloud session ID from cookies
     * 
     * @return string|null
     */
    public function getSessionId(): ?string
    {
        return $_COOKIE['nc_session_id'] ?? null;
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
     * Get CalDAV authentication headers for Nextcloud
     * 
     * @return array
     */
    public function getCalDavAuthHeaders(): array
    {
        $token = $this->getAccessToken();
        
        if ($token) {
            return [
                'Authorization: Bearer ' . $token,
                'Content-Type: text/calendar; charset=UTF-8'
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
            'has_credentials' => $this->hasValidCredentials()
        ];
    }
}
