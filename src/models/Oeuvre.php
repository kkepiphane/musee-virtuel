<?php
namespace MuseeVirtuel\Models;

class Oeuvre {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getFeatured($limit = 4) {
        $stmt = $this->db->prepare("
            SELECT * FROM oeuvres 
            WHERE featured = 1 
            ORDER BY created_at DESC 
            LIMIT :limit
        ");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("
            SELECT * FROM oeuvres 
            WHERE id = :id
        ");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Autres méthodes CRUD...
}