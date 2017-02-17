<?php

require_once BASEPATH."/app/Controllers/BaseController.php";
require_once BASEPATH."/app/Models/MLikes.php";

class CLikes extends BaseController
{
    public function setLikes($photo_id) {

        if(isset($_SERVER['REMOTE_ADDR'])) {
            $ip = ip2long($_SERVER['REMOTE_ADDR']);
        }

        $like = new MLikes();

        $data = $like->getLike($photo_id, $ip);

        if(empty($data)) {
            $like->insertInto('ipvotings', ['ip' => $ip, 'photo_id' => $photo_id, 'like' => '1']);
            $is_like = 1;
        } else {
            $data['like'] = 1 - (intval($data['like'])); //Если было 0, то делаем 1 и наоборот
            $like->updateLike($data['like'], $data['id']);
            $is_like = $data['like'];
        }
        return $is_like;
    }
}