<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
mb_internal_encoding("UTF-8");

define("BASEPATH", __DIR__);

require_once BASEPATH."/app/Controllers/CPerson.php";
require_once BASEPATH."/app/Controllers/CTestData.php";

$person = new CPerson();
$person->index(1);
//$city = new CTestData();
//$city->insertTestData();