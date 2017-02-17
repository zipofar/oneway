<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
mb_internal_encoding("UTF-8");

define("BASEPATH", __DIR__);

if(!empty($_POST)) {

    if(isset($_POST['id_photo'])) {
        $id_photo = intval($_POST['id_photo']);
    }
    require_once BASEPATH."/app/Controllers/CLikes.php";
    $like = new CLikes();
    $is_like = $like->setLikes($id_photo);
    echo json_encode(array("is_like"=>$is_like));
}
else {

    require_once BASEPATH."/app/Controllers/CPerson.php";
    $person = new CPerson();
    $person->index(1);
}

//require_once BASEPATH."/app/Controllers/CTestData.php";
//$city = new CTestData();
//$city->insertTestData();