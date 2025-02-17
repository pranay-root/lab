<?php
// get_flag.php
session_start();

// Store the flag in a PHP variable - not visible in source
$hidden_flag = "flag{xss_protection_bypassed}";

// Only return the flag if the request is AJAX
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
   strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    echo $hidden_flag;
} else {
    // Redirect non-AJAX requests
    header('Location: xss-lab.php');
    exit();
}
?>
<!--
   <img src=x onerror="
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'flag.php');
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onload = function() { alert(this.responseText); };
        xhr.send();
    ">    
-->