<?php
defined('BASEPATH') or die;

class BaseModel
{
    protected $DB;

    private function getDbConfig() {
        require_once BASEPATH."/config/database.php";
        return $db_conf;
    }

    public function __construct()
    {
        extract($this->getDbConfig());
        $this->DB = new PDO ("mysql:host=$host; dbname=$database; charset=$charset", $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    }

    public function insertInto($tablename, array $data) {

        $sql_data = $this->prepareInsertData($data);
        $sql = "INSERT INTO ".$tablename." SET ".$sql_data;
        $stmt = $this->DB->prepare($sql);
        $stmt->execute($data);
    }

    private function prepareInsertData($data) {

        $sql = "";

        foreach($data as $name => $val) {
            $sql .= "`".$name."` = :".$name.", ";
        }

        $sql = substr($sql, 0, -2);

        return $sql;
    }

    public function getById($tablename, $id) {

        $sql = "SELECT * FROM ".$tablename." WHERE id = :id";

        $stmt = $this->DB->prepare($sql);
        $stmt->execute(['id' => $id]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
//        foreach($stmt->fetch(PDO::FETCH_ASSOC) as $key => $val) {
//            $arr[$key] = $val;
//        }
        return $res;
    }

    /**
     * @param $tablename
     * @param $cond1 condition 1
     * @param $oper  comparison operator = < >
     * @param $cond2 condition 2
     * @return array
     */
    protected function getWhere($tablename, $cond1, $oper, $cond2) {

        $arr = array();
        $sql = "SELECT * FROM ".$tablename." WHERE ".$cond1." ".$oper." ?";
        $stmt = $this->DB->prepare($sql);
        $stmt->execute([$cond2]);
        $p = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($p as $key => $val) {
            $arr[$key] = $val;
        }
        return $arr;
    }

    protected function getCountLikes($tablename, $cond1, $oper, $cond2) {

        $arr = array();
        $sql = "SELECT COUNT(*) as count FROM ".$tablename." WHERE ".$cond1." ".$oper." ? AND `like` = 1";
        $stmt = $this->DB->prepare($sql);
        $stmt->execute([$cond2]);
        $p = $stmt->fetch(PDO::FETCH_ASSOC);

        return $p['count'];
    }
}