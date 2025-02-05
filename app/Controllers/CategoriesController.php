<?php
namespace App\Controllers;

use App\Config\Database;
use App\Services\AuthService;
use App\Models\Categorie;

class CategoriesController {
    private $db;
    private $categorieModel;

    public function __construct() {
        $this->db = Database::getConnection();
        $this->categorieModel = new Categorie($this->db);
    }

    public function displaycategories() {
        $categories = $this->categorieModel->getToutesCategories();
        include_once __DIR__ . '/../Views/admin/Categories.php';
        return $categories ;
    }

    public function ajouterCategorie() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';

            if (!empty($name)) {
                $resultat = $this->categorieModel->ajouterCategorie($name);
                
                if ($resultat['success']) {
                    header('Location: /categories?success=1');
                    exit();
                } else {
                    $error = $resultat['message'];
                }
            } else {
                $error = "Le nom de la catégorie est requis";
            }
        }
        
        include_once __DIR__ . '/../Views/admin/Categories.php';
    }
}