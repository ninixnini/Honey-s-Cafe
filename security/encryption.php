<?php
function encryptString($string, $action = 'e') {
    // SECRET KEYS
    $secret_key = 'rongt0249tj2940tjw9g&fir39$t83iorh390jIEF%';
    $secret_iv = 'UH5%qkDJR$euhFEUOHF*2#f0_093f(Q#FAOSMfigrnn';
 
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16 );
 
    if($action == 'e') {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if($action == 'd'){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }
 
    return $output;
}
?>