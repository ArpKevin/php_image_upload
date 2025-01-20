<?php

$con = mysqli_connect('localhost', 'root', '', 'crud');

if (!$con){
    die('connection failed'.mysqli_connect_error());
}

echo 'connected successfully';

?>