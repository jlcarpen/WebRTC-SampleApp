<?php
session_start();

include __DIR__ . '/../config.php';
require_once __DIR__ . '/../lib/WebRTC/WebRTCService.php';
require_once __DIR__ . '/../lib/Restful/RestfulEnvironment.php';

use Att\Api\WebRTC\WebRTCService;
use Att\Api\Restful\RestfulEnvironment;
use \Exception;

if (isset($proxy_host) && isset($proxy_port))
    RestfulEnvironment::setProxy($proxy_host, $proxy_port);
if (isset($accept_all_certs))
    RestfulEnvironment::setAcceptAllCerts($accept_all_certs);

try {
    $user = $_POST['user'];
    $token = unserialize($_SESSION['token']);
    $webrtcSrvc = new WebRTCService($FQDN, $token); 
    $webrtcSrvc->associateToken($user);
    http_response_code(201);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode($e->getMessage());
}

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
?>
