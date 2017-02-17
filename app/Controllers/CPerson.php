<?php
defined('BASEPATH') or die;

require_once BASEPATH."/app/Controllers/BaseController.php";
require_once BASEPATH."/app/Models/MPerson.php";

class CPerson extends BaseController
{
    public function index($id) {

        $person = new MPerson();
        $data = $person->getPerson($id, $this->ip);
        if($data === false) { echo "PAGE 404"; return;}

        $this->view('person', array('person' => $data));
    }
}