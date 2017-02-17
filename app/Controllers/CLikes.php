<?php

defined('BASEPATH') or die;

require_once BASEPATH."/app/Controllers/BaseController.php";
require_once BASEPATH."/app/Models/MLikes.php";

class CLikes extends BaseController
{
    public function setLikes($photo_id) {

        $photo_id = intval($photo_id);

        $like = new MLikes();

        $photo = $like->getById('photos', $photo_id);

        if($photo === false) { return json_encode(array("error" => "Error: No photo")); }

        $data = $like->getLike($photo_id, $this->ip);

        if(empty($data)) {

            $like->insertInto('ipvotings', ['ip' => $this->ip, 'photo_id' => $photo_id, 'like' => '1']);
            return json_encode(array("is_like" => 1));

        } else {

            $data['like'] = 1 - (intval($data['like'])); //Если было 0, то делаем 1 и наоборот
            $like->updateLike($data['like'], $data['id']);
            return json_encode(array("is_like" => $data['like']));
        }
    }
}