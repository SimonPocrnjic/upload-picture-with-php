<?php

//connecting to server

require('config.php');

$myserver = new mysqli(server, server_username,server_password, database);

if($myserver->connect_error)
{
    die("connection failed: " . $myserver->connect_error);
}