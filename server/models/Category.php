<?php
include_once "db.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

class Category {
    public function init() {
        $db = DbConnect::connect();
        return $db;
    }

    public function getCategories() {
        $db = $this->init();

        $query = $db->query("SELECT * FROM category ORDER BY title ASC");
        while ($res = $query->fetch_assoc()) {
            $row[] = $res;
        }
        return $row;
    }

    public function getCategory($id) {
        $db = $this->init();

        $query = $db->query("SELECT * FROM category WHERE cat_id = ". (int)$id ." ORDER BY title ASC");
        while ($res = $query->fetch_assoc()) {
            $row[] = $res;
        }
        return $row;
    }

    public function addCategory($title) {
        $db = $this->init();
        try {
            $query = $db->query("INSERT INTO category (title) VALUES ('".$title."')");
            return $title;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function updateCategory($id) {
        $db = $this->init();

        if($_SERVER['REQUEST_METHOD'] == 'PUT') { 
            $_PUT = json_decode(file_get_contents('php://input'), true);
        }

        try {
            $query = $db->query("UPDATE category SET title = '".$_PUT['title']."' WHERE cat_id = '".(int)$id."'");
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteCategory($id) {
        $db = $this->init();

        try {
            $query = $db->query("DELETE FROM category WHERE cat_id = '".(int)$id."'");
            if ($query) {
                return true;
            } else {
                return "Error. Category is not empty.";
            }
            
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getCategoryWithFaqs($id) {
        $db = $this->init();

        $query = $db->query("SELECT * FROM category INNER JOIN faq ON category.cat_id = faq.cat_id WHERE category.cat_id = '". (int)$id ."'");
        if ($query) {
            while ($res = $query->fetch_assoc()) {
                $row[] = $res;
            }
            return $row;
        } else {
            return mysqli_error();
        }
            
        
    }
}
?>