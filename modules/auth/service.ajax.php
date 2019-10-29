<?php

header('Content-Type: application/json');
$data_payload = array(/* Add static payload here. If not static, you might want to add it conditionally. */);
// see https://www.google.com/recaptcha/admin for details
$siteKey = '6Lc9ByAUAAAAAKOlFnpa91fVuvltXVZYkBUVBOVD';
$secret = '6Lc9ByAUAAAAAM6s0I4ayjcJmeL9T8ymR1nz2KAL';
// see https://developers.google.com/recaptcha/docs/language for details
$lang = 'en';
// the following origins are allowed to use this service
// (we accept requests only if the Origin header contains only those white-listed origins)
$allowed_http_origins = array(
    "http://example.com",
    "http://example.net",
    // running Hugo server locally
    "http://localhost:1313",
);
$http_origin = $_SERVER['HTTP_ORIGIN'];
if (in_array($http_origin, $allowed_http_origins)) {
    header("Access-Control-Allow-Origin: " . $http_origin);
}
// autoloader for ReCaptcha\Foo classes
require_once __DIR__ . '/vendor/autoload.php';
if (isset($_POST['g-recaptcha-response'])) {
    // user's response has been POSTed via g-recaptcha-response
    // $recaptcha = new \ReCaptcha\ReCaptcha($secret);
    // file_get_contents() with URLs is disabled on our PHP installation
    // (allow_url_fopen is set to false for security reasons)
    // thus, we use implementation that makes use of fsockopen() instead
    $recaptcha = new \ReCaptcha\ReCaptcha($secret, new \ReCaptcha\RequestMethod\SocketPost());
    $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
    if ($resp->isSuccess()) {
        // user has succeeded
        echo json_encode(
                array(
                    'success' => true,
                    'data' => $data_payload,
                )
        );
    } else {
        // user has failed or something went wrong
        echo json_encode(
                array(
                    'success' => false,
                    // just forward reCAPTCHA's error codes
                    // see https://developers.google.com/recaptcha/docs/verify#error-code-reference for details
                    // for instance, 'missing-input-response' means that the submitted response was empty
                    'error-codes' => $resp->getErrorCodes(),
                )
        );
    }
} else {
    // user's response has *not* been POSTed via g-recaptcha-response
    echo json_encode(
            array(
                'success' => false,
                // use own error code
                'error-codes' => array('g-recaptcha-response-not-posted'),
            )
    );
}
?>