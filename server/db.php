<?php

class DbConnect {
    public static function connect() {
        $mysqli = new mysqli("localhost", "root", "", "rest");
        return $mysqli;
    }
}

?>