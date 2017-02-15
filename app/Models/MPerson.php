<?php

require_once BASEPATH."/app/Models/BaseModel.php";

class MPerson extends BaseModel
{

    public function getPerson($id) {
//        return "Person";

        $person = $this->getById('persons', $id);
        var_dump($person);

        $place = $this->getById('places', $person['place_id']);
        var_dump($place);

        $city = $this->getById('citys', $place['city_id']);
        var_dump($city);

        $country = $this->getById('countrys', $place['country_id']);
        var_dump($country);

        $function = $this->getById('functions', $person['function_id']);
        var_dump($function);

        $photos = $this->getWhere('photos', 'person_id', '=', $id);
        var_dump($photos);

        $ipvotings = $this->getWhere('ipvotings', 'person_id', '=', $id);
        var_dump($ipvotings);
    }

}