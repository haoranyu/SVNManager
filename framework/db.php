<?php
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PWD = '';
$DB_NAME = 'Portfolio';

$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME) or die('Database error:'.mysqli_error());
