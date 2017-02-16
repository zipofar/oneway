<?php

require_once BASEPATH."/app/Models/BaseModel.php";

class MPerson extends BaseModel
{

    public function getPerson($id) {

        $person = $this->getById('persons', $id);

        $place = $this->getById('places', $person['place_id']);

        $city = $this->getById('citys', $place['city_id']);

        $country = $this->getById('countrys', $place['country_id']);

        $function = $this->getById('functions', $person['function_id']);

        $photos = $this->getWhere('photos', 'person_id', '=', $id);

//        $arr_photos = array_map(function($arr) {return $arr['pathphoto'];}, $photos);

        $count_likes = array_map(function($arr) {
            $arr['count_likes'] = $this->getCountRecords('ipvotings', 'photo_id', '=', $arr['id']);
            return $arr;
        }, $photos);



        $person['city'] = $city['name'];
        $person['country'] = $country['name'];
        $person['function'] = $function['name'];
        $person['photos'] = $count_likes;

        return $person;
    }

}