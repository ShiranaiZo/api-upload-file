<?php

include 'mysqlibase.php';

//DB connect
$db = new MySQLBase('127.0.0.1', 'upload', 'root', '');

$headers = getallheaders();
$client_id = isset($headers['client_id']) ? $headers['client_id'] : '';
$client_secret = isset($headers['client_secret']) ? $headers['client_secret'] : '';
