<?php


class BaseController
{
    private $data = array();

    protected function view($view_name, array $data) {
        $this->data = $data;
        unset($data);
        extract($this->data);
//        var_dump($person);
        require_once BASEPATH."/view/".$view_name.".php";
    }
}