<?php

/**
 * Test file for OIDC Helper configurable cookie names
 * 
 * This test verifies that the OIDC helper correctly uses configurable cookie names
 * instead of hardcoded ones.
 */

require_once(__DIR__ . '/../lib/php/oidc_helper.php');

class MockRcubeConfig
{
    private $config = [];
    
    public function __construct($config = [])
    {
        $this->config = $config;
    }
    
    public function get($key, $default = null)
    {
        return $this->config[$key] ?? $default;
    }
}

class MockRcube
{
    public $config;
    
    public function __construct($config = [])
    {
        $this->config = new MockRcubeConfig($config);
    }
}

// Test 1: Default cookie names
echo "Test 1: Default cookie names\n";
$default_config = [
    'nextcloud_cookies' => [
        'token' => 'nc_token',
        'username' => 'nc_username',
        'session_id' => 'nc_session_id'
    ]
];

$mock_rcube = new MockRcube($default_config);
$oidc_helper = new oidc_helper($mock_rcube);

// Set test cookies
$_COOKIE['nc_token'] = 'test_token_123';
$_COOKIE['nc_username'] = 'testuser';
$_COOKIE['nc_session_id'] = 'test_session_456';

echo "Testing with default cookie names:\n";
echo "Token: " . $oidc_helper->getAccessToken() . "\n";
echo "Username: " . $oidc_helper->getUsername() . "\n";
echo "Session ID: " . $oidc_helper->getSessionId() . "\n";
echo "Has valid credentials: " . ($oidc_helper->hasValidCredentials() ? 'Yes' : 'No') . "\n\n";

// Test 2: Custom cookie names
echo "Test 2: Custom cookie names\n";
$custom_config = [
    'nextcloud_cookies' => [
        'token' => 'myapp_token',
        'username' => 'myapp_user',
        'session_id' => 'myapp_session'
    ]
];

$mock_rcube_custom = new MockRcube($custom_config);
$oidc_helper_custom = new oidc_helper($mock_rcube_custom);

// Clear previous cookies and set custom ones
unset($_COOKIE['nc_token'], $_COOKIE['nc_username'], $_COOKIE['nc_session_id']);
$_COOKIE['myapp_token'] = 'custom_token_789';
$_COOKIE['myapp_user'] = 'customuser';
$_COOKIE['myapp_session'] = 'custom_session_012';

echo "Testing with custom cookie names:\n";
echo "Token: " . $oidc_helper_custom->getAccessToken() . "\n";
echo "Username: " . $oidc_helper_custom->getUsername() . "\n";
echo "Session ID: " . $oidc_helper_custom->getSessionId() . "\n";
echo "Has valid credentials: " . ($oidc_helper_custom->hasValidCredentials() ? 'Yes' : 'No') . "\n\n";

// Test 3: Fallback to defaults when no config provided
echo "Test 3: Fallback to defaults\n";
$mock_rcube_fallback = new MockRcube([]);
$oidc_helper_fallback = new oidc_helper($mock_rcube_fallback);

// Set default cookies again
$_COOKIE['nc_token'] = 'fallback_token_345';
$_COOKIE['nc_username'] = 'fallbackuser';
$_COOKIE['nc_session_id'] = 'fallback_session_678';

echo "Testing fallback to default cookie names:\n";
echo "Token: " . $oidc_helper_fallback->getAccessToken() . "\n";
echo "Username: " . $oidc_helper_fallback->getUsername() . "\n";
echo "Session ID: " . $oidc_helper_fallback->getSessionId() . "\n";
echo "Has valid credentials: " . ($oidc_helper_fallback->hasValidCredentials() ? 'Yes' : 'No') . "\n\n";

// Test 4: Configuration output
echo "Test 4: Configuration output\n";
$config = $oidc_helper->getOidcConfig();
echo "Cookie names from config: " . json_encode($config['cookie_names']) . "\n";

echo "All tests completed!\n";
