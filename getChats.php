<?php
require "./SETUP.php";
function encryptString2($string, $action = 'e') {
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

function makeClickableLinks($s) {
  return preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $s);
}


// Get all data from database
$getData = mysqli_query($database, "SELECT * FROM publicchat ORDER BY absoluteTime ASC;");
while ($getDataRow = mysqli_fetch_assoc($getData)) {
	$name = encryptString2($getDataRow["name"], "d");
	$content = encryptString2($getDataRow["post"], "d");
	$time = encryptString2($getDataRow["formattedTime"], "d");
    $hash = $getDataRow["id"];
	$classNames = "chat";
    $role = $getDataRow["role"];

	if ($name == $_COOKIE["userLoggedIn"]) { $classNames .= " right"; }
    
    if (substr($content, 0, 5) == "KICK=" && $hash == "KICK") {
        // Oh noes.. Looks like someone was kicked!
        $kickedPerson = substr($content, 5);
        echo "
        <div class=\"" . $classNames . "\">
            <div class=\"content\"><span style=\"font-weight:bold;color:red;\">" . encryptString2($kickedPerson, "d") . "</span> Was Kicked By <span style=\"font-weight:bold;color:red;\">" . $name . "</span></div>
        </div>
        ";
    } elseif (substr($content, 0, 8) == "PROMOTE=" && $hash == "PROMOTE") {
        // Someone was promoted
        $promotedPerson = substr($content, 8);
        echo "
        <div class=\"" . $classNames . "\">
            <div class=\"content\"><span style=\"font-weight:bold;color:#fff200;text-shadow: #EEEE00 0 0 13px;\">" . $promotedPerson . "</span> Was Promoted By <span style=\"font-weight:bold;color:#fff200;text-shadow: #EEEE00 0 0 13px;\">" . $name . "</span></div>
        </div>
        ";

    } else {
        if ($role == "admin") {
            echo "
            <div class=\"" . $classNames . "\">
                <div class=\"profile-image\"><img src=\"http://identicon-1132.appspot.com/" . $name . "?s=7\"></div>
                <div class=\"content\"><div class=\"name\">" . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . " <span class=\"small\">(Admin)</span> <span class=\"time\">" . $time . "</span></div>
                " . makeClickableLinks(htmlspecialchars($content, ENT_QUOTES, 'UTF-8')) . "</div>
            </div>
            ";
        } else {
            echo "
            <div class=\"" . $classNames . "\">
                <div class=\"profile-image\"><img src=\"http://identicon-1132.appspot.com/" . $name . "?s=7\"></div>
                <div class=\"content\"><div class=\"name\">" . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . " <span class=\"time\">" . $time . "</span></div>
                " . makeClickableLinks(htmlspecialchars($content, ENT_QUOTES, 'UTF-8')) . "</div>
            </div>
            ";
        }
    }
}


?>