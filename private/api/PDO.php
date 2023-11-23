<?php 

$host = '127.0.0.1';
$db   = 'webServer';
$user = 'admin';
$pass = 'merfomina';
$charset = 'utf8';

$dsn = "pgsql: host=$host; dbname=$db";
$options = [
    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES=>false,
];

$pdo = new pdo($dsn, $user, $pass, $options);








?>