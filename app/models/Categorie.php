<?php
namespace App\Models;

class Categorie {
    private $db;
    private $table = 'categories';
    
    public function __construct($db) {
        $this->db = $db;
    }

    public function getToutesCategories() {
        try {
            $query = "SELECT id, name, created_at FROM " . $this->table . " ORDER BY created_at DESC";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch(\PDOException $e) {
            return [];
        }
    }

    public function ajouterCategorie($name) {
        try {
            // Vérifier si la catégorie existe déjà (contrainte UNIQUE)
            $checkQuery = "SELECT id FROM " . $this->table . " WHERE name = :name";
            $checkStmt = $this->db->prepare($checkQuery);
            $checkStmt->bindParam(':name', $name);
            $checkStmt->execute();
            
            if($checkStmt->fetch()) {
                return [
                    'success' => false,
                    'message' => 'Cette catégorie existe déjà'
                ];
            }

            $query = "INSERT INTO " . $this->table . " (name) VALUES (:name)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':name', $name);
            
            if($stmt->execute()) {
                return [
                    'success' => true,
                    'message' => 'Catégorie ajoutée avec succès',
                    'id' => $this->db->lastInsertId('categories_id_seq')
                ];
            }
            
            return [
                'success' => false,
                'message' => 'Échec de l\'ajout de la catégorie'
            ];
        } catch(\PDOException $e) {
            return [
                'success' => false,
                'message' => 'Erreur: ' . $e->getMessage()
            ];
        }
    }

    public function getCategorieById($id) {
        try {
            $query = "SELECT id, name, created_at FROM " . $this->table . " WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch(\PDOException $e) {
            return null;
        }
    }

    public function supprimerCategorie($id) {
        try {
            $query = "DELETE FROM " . $this->table . " WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            
            if($stmt->execute()) {
                return [
                    'success' => true,
                    'message' => 'Catégorie supprimée avec succès'
                ];
            }
            return [
                'success' => false,
                'message' => 'Échec de la suppression de la catégorie'
            ];
        } catch(\PDOException $e) {
            return [
                'success' => false,
                'message' => 'Erreur: ' . $e->getMessage()
            ];
        }
    }

    public function modifierCategorie($id, $name) {
        try {
            // Vérifier si le nouveau nom existe déjà pour un autre ID
            $checkQuery = "SELECT id FROM " . $this->table . " WHERE name = :name AND id != :id";
            $checkStmt = $this->db->prepare($checkQuery);
            $checkStmt->bindParam(':name', $name);
            $checkStmt->bindParam(':id', $id);
            $checkStmt->execute();
            
            if($checkStmt->fetch()) {
                return [
                    'success' => false,
                    'message' => 'Une catégorie avec ce nom existe déjà'
                ];
            }

            $query = "UPDATE " . $this->table . " SET name = :name WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            
            if($stmt->execute()) {
                return [
                    'success' => true,
                    'message' => 'Catégorie modifiée avec succès'
                ];
            }
            return [
                'success' => false,
                'message' => 'Échec de la modification de la catégorie'
            ];
        } catch(\PDOException $e) {
            return [
                'success' => false,
                'message' => 'Erreur: ' . $e->getMessage()
            ];
        }
    }
}