<?php
namespace App\Controllers;

use App\Models\Course;
use App\Config\Database;

class CourseController {

    private $db;
    private $courseModel;

    public function __construct() {
        $this->db = Database::getConnection();
        $this->courseModel = new Course($this->db);
    }

     public function addCourse() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            
            if ($this->courseModel->addCourse($title, $description)) {
                echo json_encode(['message' => 'Course added successfully.']);
            } else {
                echo json_encode(['message' => 'Error adding course.']);
            }
        }
    }

     public function listCourses() {
        $courses = $this->courseModel->getAllCourses();
        include_once __DIR__ . '/../Views/user/list_courses.php';  
    }

     public function adminDashboard() {
        include_once __DIR__ . '/../Views/admin/list_courses.php';  
    }
}
