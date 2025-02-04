<?php
namespace App\Models;

use PDO;

class Course {

    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }

     public function getAllCourses() {
        $stmt = $this->db->prepare("SELECT * FROM courses");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

     public function addCourse($title, $description) {
        $stmt = $this->db->prepare("INSERT INTO courses (title, description) VALUES (:title, :description)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        return $stmt->execute();
    }
}
