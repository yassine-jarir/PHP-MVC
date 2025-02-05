<?php
namespace App\Controllers;

use App\Models\Course;
use App\Config\Database;
use App\Services\AuthService;

class CourseController {
    private $db;
    private $courseModel;

    public function __construct() {
        $this->db = Database::getConnection();
        $this->courseModel = new Course($this->db);
    }

    // Afficher le formulaire d'ajout
    public function showAddForm() {
        if (!AuthService::hasRole('admin')) {
            header('Location: /login');
            exit;
        }
        include_once __DIR__ . '/../Views/admin/course.php';
    }

     

    // READ - Lister tous les cours
    public function getAllCourses() {
        $courses = $this->courseModel->getAllCourses();
        $categorieModel = new \App\Models\Categorie($this->db);
        $categories = $categorieModel->getToutesCategories();
        include_once __DIR__ . '/../Views/admin/Courses.php';
        return $categories ;
     }

    // READ - Afficher un cours spécifique
    public function getCourse($id) {
        $course = $this->courseModel->getCourseById($id);
        if ($course) {
            include_once __DIR__ . '/../Views/admin/view_course.php';
        } else {
            $_SESSION['error_message'] = 'Cours non trouvé.';
            header('Location: /admin/courses');
            exit;
        }
    }

    // UPDATE - Mettre à jour un cours
    public function updateCourse() {
        if (!AuthService::hasRole('admin')) {
            header('Location: /login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? '';
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $contentType = $_POST['content_type'] ?? '';
            $content = '';

            if (empty($id) || empty($title) || empty($description) || empty($contentType)) {
                $_SESSION['error_message'] = 'Tous les champs sont requis.';
                header('Location: /admin/course/edit/' . $id);
                exit;
            }

            // Gestion du contenu selon le type
            if ($contentType === 'text') {
                $content = $_POST['content'] ?? '';
            } elseif ($contentType === 'video' && isset($_FILES['video_file'])) {
                // Gestion de la nouvelle vidéo si une est téléchargée
                if ($_FILES['video_file']['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = __DIR__ . '/../../public/uploads/videos/';
                    $fileName = uniqid() . '_' . basename($_FILES['video_file']['name']);
                    $targetFile = $uploadDir . $fileName;

                    if (move_uploaded_file($_FILES['video_file']['tmp_name'], $targetFile)) {
                        $content = 'uploads/videos/' . $fileName;
                    } else {
                        $_SESSION['error_message'] = "Erreur lors de l'upload de la vidéo.";
                        header('Location: /admin/course/edit/' . $id);
                        exit;
                    }
                }
            }

            if ($this->courseModel->updateCourse($id, $title, $description, $contentType, $content)) {
                $_SESSION['success_message'] = 'Cours mis à jour avec succès.';
                header('Location: /admin/courses');
            } else {
                $_SESSION['error_message'] = 'Erreur lors de la mise à jour du cours.';
                header('Location: /admin/course/edit/' . $id);
            }
            exit;
        }
    }

    // DELETE - Supprimer un cours
    public function deleteCourse() {
        if (!AuthService::hasRole('admin')) {
            header('Location: /login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['course_id'] ?? null;
            
            // Récupérer les informations du cours avant la suppression
            $course = $this->courseModel->getCourseById($id);
            
            if ($course && $this->courseModel->deleteCourse($id)) {
                // Supprimer le fichier vidéo si c'est un cours vidéo
                if ($course['content_type'] === 'video' && !empty($course['content'])) {
                    $videoPath = __DIR__ . '/../../public/' . $course['content'];
                    if (file_exists($videoPath)) {
                        unlink($videoPath);
                    }
                }
                $_SESSION['success_message'] = 'Cours supprimé avec succès.';
            } else {
                $_SESSION['error_message'] = 'Erreur lors de la suppression du cours.';
            }
            header('Location: /admin/courses');
            exit;
        }
    }

    // Afficher le dashboard admin des cours
    public function adminDashboard() {
        if (!AuthService::hasRole('admin')) {
            header('Location: /login');
            exit;
        }
        
        $courses = $this->courseModel->getAllCourses();
        include_once __DIR__ . '/../Views/admin/Courses.php';
    }

    // Afficher le formulaire d'édition
    public function showEditForm($id) {
        if (!AuthService::hasRole('admin')) {
            header('Location: /login');
            exit;
        }

        $course = $this->courseModel->getCourseById($id);
        if ($course) {
            include_once __DIR__ . '/../Views/admin/edit_course.php';
        } else {
            $_SESSION['error_message'] = 'Cours non trouvé.';
            header('Location: /admin/courses');
            exit;
        }
    }

    // Afficher la liste des cours pour les utilisateurs
    public function listCourses() {
        if (!AuthService::isAuthenticated()) {
            header('Location: /login');
            exit;
        }
        
        $courses = $this->courseModel->getAllCourses();
        include_once __DIR__ . '/../Views/user/list_courses.php';
    }
    public function addCourse() {
       
        
        // Get all categories
        $categorieModel = new \App\Models\Categorie($this->db);
        $categories = $categorieModel->getToutesCategories();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $content = $_POST['content'] ?? '';
            $category_id = $_POST['category_id'] ?? null;
            $image = $_POST['image'] ?? '';
    
            if (empty($title) || empty($description) || empty($category_id)) {
                $_SESSION['error_message'] = 'Title, description and category are required.';
                header('Location: /admin/course/add');
                exit;
            }
    
            if ($this->courseModel->addCourse($title, $description, $content, $category_id, $image)) {
                $_SESSION['success_message'] = 'Course added successfully.';
                include_once __DIR__ . '/../Views/admin/courses.php';

            } else {
                $_SESSION['error_message'] = 'Error adding the course.';
                header('Location: /admin/course/add');
            }
            exit;
        }
        include_once __DIR__ . '/../Views/admin/courses.php';
    }

}