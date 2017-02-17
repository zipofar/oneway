<?php

require_once BASEPATH."/app/Models/BaseModel.php";

class MPerson extends BaseModel
{

    private $ip = "";

    public function getPerson($id, $ip) {

        $this->ip = $ip;

        $person = $this->getById('persons', $id);

        $place = $this->getById('places', $person['place_id']);

        $city = $this->getById('citys', $place['city_id']);

        $country = $this->getById('countrys', $place['country_id']);

        $function = $this->getById('functions', $person['function_id']);

        $photos = $this->getWhere('photos', 'person_id', '=', $id);

        $count_likes = array_map(function($arr) {
            $arr['count_likes'] = $this->getCountLikes('ipvotings', 'photo_id', '=', $arr['id']);
            $arr['is_like'] = $this->getLike($arr['id'], $this->ip);
            return $arr;
        }, $photos);



        $person['city'] = $city['name'];
        $person['country'] = $country['name'];
        $person['function'] = $function['name'];
        $person['photos'] = $count_likes;

        return $person;
    }

    private function getLike($photo_id, $ip) {

        $sql = "SELECT * FROM ipvotings WHERE photo_id = ? AND ip = ?";
        $stmt = $this->DB->prepare($sql);
        $stmt->execute([$photo_id, $ip]);
        $p = $stmt->fetch(PDO::FETCH_ASSOC);
        $p = ($p === false)? 0 : intval($p['like']);

        return $p;
    }

}