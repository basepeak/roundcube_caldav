<?php

/**
 * Test file for OIDC Helper dynamic cookie detection
 * 
 * This test verifies that the OIDC helper correctly finds the dynamic ocXXXXXXXX cookie
 * and other required cookies for authentication.
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

// Test 1: Default cookie names with dynamic ocXXXXXXXX
echo "Test 1: Default cookie names with dynamic ocXXXXXXXX\n";
$default_config = [];

$mock_rcube = new MockRcube($default_config);
$oidc_helper = new oidc_helper($mock_rcube);

// Set test cookies - including the dynamic ocXXXXXXXX cookie
$_COOKIE['ocwe8qziyo2m'] = 'test_token_123';  // Dynamic ocXXXXXXXX cookie
$_COOKIE['nc_username'] = 'testuser';
$_COOKIE['nc_session_id'] = 'test_session_456';

echo "Testing with dynamic ocXXXXXXXX cookie:\n";
echo "Dynamic Token: " . $oidc_helper->findOcRandomCookieValue() . "\n";
echo "Username: " . $oidc_helper->getUsername() . "\n";
echo "Session ID: " . $oidc_helper->getSessionId() . "\n";
echo "Has valid credentials: " . ($oidc_helper->hasValidCredentials() ? 'Yes' : 'No') . "\n\n";

// Test 2: Different dynamic cookie name
echo "Test 2: Different dynamic cookie name\n";
$mock_rcube_custom = new MockRcube([]);
$oidc_helper_custom = new oidc_helper($mock_rcube_custom);

// Clear previous cookies and set different dynamic one
unset($_COOKIE['ocwe8qziyo2m'], $_COOKIE['nc_username'], $_COOKIE['nc_session_id']);
$_COOKIE['ocabc123def'] = 'custom_token_789';  // Different dynamic cookie
$_COOKIE['nc_username'] = 'customuser';
$_COOKIE['nc_session_id'] = 'custom_session_012';

echo "Testing with different dynamic cookie:\n";
echo "Dynamic Token: " . $oidc_helper_custom->findOcRandomCookieValue() . "\n";
echo "Username: " . $oidc_helper_custom->getUsername() . "\n";
echo "Session ID: " . $oidc_helper_custom->getSessionId() . "\n";
echo "Has valid credentials: " . ($oidc_helper_custom->hasValidCredentials() ? 'Yes' : 'No') . "\n\n";

// Test 3: No dynamic cookie present
echo "Test 3: No dynamic cookie present\n";
$mock_rcube_fallback = new MockRcube([]);
$oidc_helper_fallback = new oidc_helper($mock_rcube_fallback);

// Clear all cookies
unset($_COOKIE['ocabc123def'], $_COOKIE['nc_username'], $_COOKIE['nc_session_id']);

echo "Testing with no dynamic cookie:\n";
echo "Dynamic Token: " . ($oidc_helper_fallback->findOcRandomCookieValue() ?: 'null') . "\n";
echo "Username: " . ($oidc_helper_fallback->getUsername() ?: 'null') . "\n";
echo "Session ID: " . ($oidc_helper_fallback->getSessionId() ?: 'null') . "\n";
echo "Has valid credentials: " . ($oidc_helper_fallback->hasValidCredentials() ? 'Yes' : 'No') . "\n\n";

// Test 4: Configuration output
echo "Test 4: Configuration output\n";
$config = $oidc_helper->getOidcConfig();
echo "Cookie names from config: " . json_encode($config['cookie_names']) . "\n";

// Test 5: Test getAccountFromCookie method
echo "Test 5: getAccountFromCookie method\n";
$_COOKIE['ocwe8qziyo2m'] = 'test_token_123';
$_COOKIE['nc_username'] = 'testuser';
$account = $oidc_helper->getAccountFromCookie();
echo "Account: " . json_encode($account) . "\n";

echo "All tests completed!\n";
