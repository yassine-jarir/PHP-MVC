<?php
namespace App\Models;

use PDO;

class Course {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllCourses() {
        $stmt = $this->db->prepare("
            SELECT c.*, cat.name as category_name 
            FROM courses c 
            LEFT JOIN categories cat ON c.category_id = cat.id
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
 
    public function addCourse($title, $description, $content, $category_id, $image) {
        $stmt = $this->db->prepare("
            INSERT INTO courses (title, description, content, category_id, image) 
            VALUES (:title, :description, :content, :category_id, :image)
        ");
        
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':image', $image);
        
        return $stmt->execute();
    }
}