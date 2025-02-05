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

     public function addCourse($title, $description,$content, $content_type, $status, $teacher_id, $category_id ) {
        $stmt = $this->db->prepare("INSERT INTO courses (title, description, content, content_type, status, teacher_id, category_id) VALUES (:title, :description,
        :content, :content_type, :status, :teacher_id, category_id
        )");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':content_type', $content_type);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':teacher_id', $teacher_id);
        $stmt->bindParam(':category_id', $category_id);
        return $stmt->execute();
    }
}
