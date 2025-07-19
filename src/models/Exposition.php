<?php
namespace MuseeVirtuel\Models;

use MuseeVirtuel\Config\Database;
use PDO;

class Exposition {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Récupère les expositions en cours
     */
    public function getCurrent(): array {
        $stmt = $this->db->prepare("
            SELECT 
                e.id,
                e.title,
                e.slug,
                e.short_description,
                e.start_date,
                e.end_date,
                e.cover_image as image,
                e.duration,
                e.visitors,
                e.likes,
                COUNT(ea.artwork_id) as artwork_count
            FROM exhibitions e
            LEFT JOIN exhibition_artworks ea ON e.id = ea.exhibition_id
            WHERE e.is_current = 1
            GROUP BY e.id
            ORDER BY e.start_date DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Récupère les expositions à venir (limit 3)
     */
    public function getUpcoming(): array {
        $stmt = $this->db->prepare("
            SELECT 
                id,
                title,
                slug,
                short_description,
                start_date,
                end_date,
                cover_image as image,
                DATEDIFF(start_date, CURDATE()) as days_until
            FROM exhibitions
            WHERE start_date > CURDATE()
            ORDER BY start_date ASC
            LIMIT 3
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Récupère les expositions passées
     */
    public function getPast(): array {
        $stmt = $this->db->prepare("
            SELECT 
                id,
                title,
                slug,
                short_description,
                start_date,
                end_date,
                cover_image as image,
                visitors,
                likes,
                YEAR(end_date) as year
            FROM exhibitions
            WHERE end_date < CURDATE()
            ORDER BY end_date DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Récupère une exposition par son slug
     */
    public function getBySlug(string $slug): ?array {
        $stmt = $this->db->prepare("
            SELECT 
                id,
                title,
                description,
                start_date,
                end_date,
                location,
                cover_image,
                visitors,
                likes
            FROM exhibitions
            WHERE slug = :slug
        ");
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetch() ?: null;
    }

    /**
     * Récupère les œuvres d'une exposition
     */
    public function getArtworks(string $slug): array {
        $stmt = $this->db->prepare("
            SELECT 
                a.id,
                a.title,
                a.image,
                a.year,
                a.dimensions,
                ar.name as artist_name
            FROM artworks a
            JOIN exhibition_artworks ea ON a.id = ea.artwork_id
            JOIN exhibitions e ON ea.exhibition_id = e.id
            JOIN artists ar ON a.artist_id = ar.id
            WHERE e.slug = :slug
            ORDER BY ea.display_order ASC
        ");
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetchAll();
    }

    /**
     * Récupère les années des expositions passées pour le filtre
     */
    public function getExhibitionYears(): array {
        $stmt = $this->db->prepare("
            SELECT DISTINCT YEAR(end_date) as year 
            FROM exhibitions 
            WHERE end_date < CURDATE()
            ORDER BY year DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * Enregistre un rappel pour une exposition
     */
    public function setReminder(int $exhibitionId, string $email): bool {
        $token = bin2hex(random_bytes(32));
        $stmt = $this->db->prepare("
            INSERT INTO exhibition_reminders 
            (exhibition_id, email, token) 
            VALUES (:exhibition_id, :email, :token)
        ");
        return $stmt->execute([
            ':exhibition_id' => $exhibitionId,
            ':email' => $email,
            ':token' => $token
        ]);
    }

    /**
     * Incrémente le compteur de vues d'une exposition
     */
    public function incrementViews(int $exhibitionId): bool {
        $stmt = $this->db->prepare("
            UPDATE exhibitions 
            SET visitors = visitors + 1 
            WHERE id = :id
        ");
        return $stmt->execute([':id' => $exhibitionId]);
    }

    /**
     * Loggue un partage social
     */
    public function logShare(int $exhibitionId, string $platform): bool {
        $stmt = $this->db->prepare("
            INSERT INTO exhibition_shares 
            (exhibition_id, platform) 
            VALUES (:exhibition_id, :platform)
        ");
        return $stmt->execute([
            ':exhibition_id' => $exhibitionId,
            ':platform' => $platform
        ]);
    }
}