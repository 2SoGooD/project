<?php
include_once "db.php";

class Faq {
    public function init() {
        $db = DbConnect::connect();
        return $db;
    }

    public function getFaqs() {
        $db = $this->init();

        $query = $db->query("SELECT * FROM faq ORDER BY faq_id DESC");
        while ($res = $query->fetch_assoc()) {
            $row[] = $res;
        }
        return $row;
    }
}
?>