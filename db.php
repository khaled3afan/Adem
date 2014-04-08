<?php

/* DB NAME */
define("DB_NAME","Faares");

/* DB USER */
define("DB_USER","root");

/* DB PASS */
define("DB_PASS","");


/* START WORK ! */

include './classes/class.Connect.php';

$connect = new FrConnect("localhost",DB_USER,DB_PASS,DB_NAME);

$connect->connectDB();
$connect->selectDB();
$connect->setCharset();