<?php
$link = mysqli_connect("localhost","dasher_server","JpShTNNSec9N5dW7", 'dasher-57');
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>