<?php
session_start();
unset($_SESSION['loggedUser']);
session_destroy();
session_unset();
header('Location: http://getdasher.com/dasher-tools/');
?>