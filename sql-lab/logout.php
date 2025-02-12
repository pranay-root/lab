<?php
session_start();
session_destroy();
header("Location: chall.php");
exit();
?>