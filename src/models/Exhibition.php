<?php
namespace MuseeVirtuel\Models;

use MuseeVirtuel\Config\Database;
use PDO;

class Exhibition {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getCurrentExhibitions(): array {
        $stmt = $this->db->prepare("
            SELECT e.*, 
                   GROUP_CONCAT(a.image) as artwork_images
            FROM exhibitions e
            LEFT JOIN exhibition_artworks ea ON e.id = ea.exhibition_id
            LEFT JOIN artworks a ON ea.artwork_id = a.id
            WHERE e.start_date <= NOW() AND e.end_date >= NOW()
            GROUP BY e.id
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}