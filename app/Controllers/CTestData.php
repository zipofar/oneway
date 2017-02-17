<?php
defined('BASEPATH') or die;

require_once BASEPATH."/app/Controllers/BaseController.php";
require_once BASEPATH."/app/Models/BaseModel.php";

class CTestData extends BaseController
{
    public function insertTestData() {

        $p = new BaseModel();
        $p->insertInto('citys', ['name' => 'Лондон']);
        $p->insertInto('countrys', ['name' => 'Великобритания']);
        $p->insertInto('functions', ['name' => 'актриса']);
        $p->insertInto('places', ['city_id' => '1', 'country_id' => '1']);
        $p->insertInto('persons',
            [
                'name' => 'Emilia',
                'fam' => 'Clarke',
                'function_id' => '1',
                'birthday' => '530658000',
                'note' => 'Британская актриса. Наиболее известна по роли Дайнерис Таргарие в телесериале \'Игра престолов\' и Сары Коннор в фильме \'Терминатор: Генезис\'.',
                'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates explicabo nulla rerum odit debitis placeat, illum est, eligendi beatae ea laborum eum error non.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus minus, voluptates ratione amet saepe quas!</p>',
                'avatar' => 'avatars/ava_0001.jpg',
                'place_id' => '1',
            ]);
        $p->insertInto('photos', ['person_id' => '1', 'pathphoto' => 'photos/photo_person_0001.jpg']);
        $p->insertInto('photos', ['person_id' => '1', 'pathphoto' => 'photos/photo_person_0002.jpg']);
        $p->insertInto('photos', ['person_id' => '1', 'pathphoto' => 'photos/photo_person_0003.jpg']);

        $p->insertInto('ipvotings', ['ip' => ip2long('192.168.0.1'), 'photo_id' => '1', 'like' => '1']);
        $p->insertInto('ipvotings', ['ip' => ip2long('192.168.0.2'), 'photo_id' => '1', 'like' => '1']);
        $p->insertInto('ipvotings', ['ip' => ip2long('192.168.0.3'), 'photo_id' => '1', 'like' => '1']);

        $p->insertInto('ipvotings', ['ip' => ip2long('192.168.0.3'), 'photo_id' => '2', 'like' => '1']);

        $p->insertInto('ipvotings', ['ip' => ip2long('192.168.0.3'), 'photo_id' => '3', 'like' => '1']);
        $p->insertInto('ipvotings', ['ip' => ip2long('192.168.0.33'), 'photo_id' => '3', 'like' => '1']);

    }
}