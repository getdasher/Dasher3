<?php
$link = mysqli_connect('localhost', 'vauthier_1', 'vferg2013', 'vauthier_dasherusers');
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>