<?php

require_once BASEPATH."/app/Controllers/BaseController.php";
require_once BASEPATH."/app/Models/MPerson.php";

class CPerson extends BaseController
{
    public function index($id) {

        if(isset($_SERVER['REMOTE_ADDR'])) {
            $ip = ip2long($_SERVER['REMOTE_ADDR']);
        }

        $person = new MPerson();
        $data = $person->getPerson($id, $ip);

        $this->view('person', array('person' => $data));
    }
}