<?php
defined('BASEPATH') or die;

class BaseController
{
    private $data = array();

    protected $ip = "";

    public function __construct() {
        if(isset($_SERVER['REMOTE_ADDR'])) {
            $this->ip = ip2long($_SERVER['REMOTE_ADDR']);
        }
    }

    protected function view($view_name, array $data) {
        $this->data = $data;
        unset($data);
        extract($this->data);

        require_once BASEPATH."/view/".$view_name.".php";
    }
}