<?php
defined('BASEPATH') or die;

require_once BASEPATH."/app/Models/BaseModel.php";

class MLikes extends BaseModel
{
    /*
     * Для Ajax
     */
    public function getLike($photo_id, $ip) {

        $p = array();
        $sql = "SELECT * FROM ipvotings WHERE photo_id = ? AND ip = ?";
        $stmt = $this->DB->prepare($sql);
        $stmt->execute([$photo_id, $ip]);
        $p = $stmt->fetch(PDO::FETCH_ASSOC);

        return $p;
    }

    /*
     * Для Ajax
     */
    public function updateLike($like, $id) {

        $sql = "UPDATE ipvotings SET `like` = :like WHERE id = :id";
        $stmt = $this->DB->prepare($sql);
        $stmt->execute(['like' => $like, 'id' => $id]);
    }
}