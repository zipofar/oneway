<?php

require_once BASEPATH."/app/Controllers/BaseController.php";
require_once BASEPATH."/app/Models/MPerson.php";

class CPerson extends BaseController
{
    public function index($id) {


        $person = new MPerson();
        $person->getPerson($id);


        $this->view('person', array('person' => $person));
    }
}