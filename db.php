<?php
class Database {
    public function connect() {
        $conn = new mysqli("localhost", "root", "", "portfolio1");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        return $conn;
    }
}
?>