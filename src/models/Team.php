<?php
namespace MuseeVirtuel\Models;

use MuseeVirtuel\Config\Database;

class Team {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Récupère tous les membres de l'équipe
     */
    public function getAll(): array {
        $stmt = $this->db->prepare("
            SELECT 
                id, 
                name, 
                position, 
                bio,  
                photo,
                email,
                twitter,
                linkedin,
                display_order
            FROM team_members
            ORDER BY display_order ASC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Récupère les membres par département
     */
    public function getByDepartment(string $department): array {
        $stmt = $this->db->prepare("
            SELECT 
                id, 
                name, 
                position, 
                bio, 
                photo,
                email
            FROM team_members
            WHERE department = :department
            ORDER BY display_order ASC
        ");
        $stmt->execute([':department' => $department]);
        return $stmt->fetchAll();
    }

    /**
     * Récupère les partenaires institutionnels
     */
    public function getPartners(): array {
        $stmt = $this->db->prepare("
            SELECT 
                id,
                name,
                logo,
                website,
                partnership_type,
                since_year
            FROM partners
            ORDER BY since_year DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Récupère la timeline institutionnelle
     */
    public function getTimeline(): array {
        $stmt = $this->db->prepare("
            SELECT 
                year,
                title,
                description,
                image
            FROM history_timeline
            ORDER BY year ASC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}