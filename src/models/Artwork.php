<?php

namespace MuseeVirtuel\Models;

use MuseeVirtuel\Config\Database;
use PDO;

class Artwork
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance();
  }

  /**
   * Récupère les œuvres en vedette (méthode appelée par getFeatured())
   */

  public function getFeaturedArtists(int $limit = 5): array
  {
    $stmt = $this->db->prepare("
        SELECT a.id, a.name, a.slug, a.portrait, a.period, a.rating, a.biography AS bio
        FROM artists a
        WHERE a.is_featured = TRUE
        LIMIT :limit
    ");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function getExhibitionArtworks(): array
  {
    $stmt = $this->db->prepare("
        SELECT a.* 
        FROM artworks a
        JOIN exhibition_artworks ea ON a.id = ea.artwork_id
        JOIN exhibitions e ON ea.exhibition_id = e.id
        WHERE e.start_date <= NOW() AND e.end_date >= NOW()
    ");
    $stmt->execute();
    return $stmt->fetchAll();
  }
  public function getFeatured(int $limit = 6): array
  {
    $stmt = $this->db->prepare("
        SELECT 
            a.id, 
            a.title, 
            a.image, 
            a.year,
            a.views,
            a.likes,
            ar.name AS artist,
            ar.slug AS artist_slug
        FROM artworks a
        JOIN artists ar ON a.artist_id = ar.id
        WHERE a.is_featured = TRUE
        ORDER BY a.views DESC
        LIMIT :limit
    ");

    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  /**
   * Récupère les œuvres d'une exposition spécifique
   */
  public function getByExhibition(?int $exhibitionId = null): array
  {
    $sql = "
        SELECT 
            a.id, a.title, a.image, a.year, a.medium,
            ar.name AS artist, ar.slug AS artist_slug
        FROM artworks a
        JOIN artists ar ON a.artist_id = ar.id
    ";

    if ($exhibitionId) {
      $sql .= " JOIN exhibition_artworks ea ON a.id = ea.artwork_id
                  WHERE ea.exhibition_id = :exhibition_id";
    }

    $stmt = $this->db->prepare($sql);

    if ($exhibitionId) {
      $stmt->bindValue(':exhibition_id', $exhibitionId, PDO::PARAM_INT);
    }

    $stmt->execute();
    return $stmt->fetchAll();
  }

  /**
   * Récupère les œuvres des expositions actuelles
   */
  public function getCurrentExhibitionArtworks(): array
  {
    $stmt = $this->db->prepare("
        SELECT 
            a.id, a.title, a.image, a.year, a.medium,
            ar.name AS artist, e.title AS exhibition_title
        FROM artworks a
        JOIN artists ar ON a.artist_id = ar.id
        JOIN exhibition_artworks ea ON a.id = ea.artwork_id
        JOIN exhibitions e ON ea.exhibition_id = e.id
        WHERE e.start_date <= NOW() AND e.end_date >= NOW()
        ORDER BY e.is_featured DESC, e.start_date DESC
    ");

    $stmt->execute();
    return $stmt->fetchAll();
  }

  /**
   * Récupère les œuvres des expositions actuelles
   */
  public function getCurrentExhibitions(int $limit = 4): array
  {
    $stmt = $this->db->prepare("
        SELECT 
            a.id,
            a.title,
            a.image,
            a.year,
            a.medium,
            ar.name AS artist,
            e.title AS exhibition_title,
            e.slug AS exhibition_slug
        FROM artworks a
        JOIN artists ar ON a.artist_id = ar.id
        JOIN exhibition_artworks ea ON a.id = ea.artwork_id
        JOIN exhibitions e ON ea.exhibition_id = e.id
        WHERE e.start_date <= NOW() AND e.end_date >= NOW()
        ORDER BY e.start_date DESC
        LIMIT :limit
    ");

    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll();
  }

  /**
   * Récupère les artistes en vedette
   */
  /**
   * Récupère les œuvres par catégorie
   */
  public function getByCategory(string $category, int $limit = 8): array
  {
    $stmt = $this->db->prepare("
            SELECT 
                a.id, 
                a.title, 
                a.image, 
                a.year, 
                a.medium,
                a.dimensions,
                a.views,
                a.likes,
                a.category,
                a.period,
                ar.name AS artist,
                ar.slug AS artist_slug
            FROM artworks a
            JOIN artists ar ON a.artist_id = ar.id
            WHERE a.category = :category
            ORDER BY a.is_featured DESC, a.views DESC
            LIMIT :limit
        ");

    $stmt->bindValue(':category', $category, PDO::PARAM_STR);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll();
  }

  /**
   * Récupère toutes les œuvres avec pagination
   */
  public function getAll(int $page = 1, int $perPage = 12): array
  {
    $offset = ($page - 1) * $perPage;

    $stmt = $this->db->prepare("
            SELECT 
                a.id, 
                a.title, 
                a.image, 
                a.year, 
                a.medium,
                a.category,
                a.period,
                a.rating,
                ar.name AS artist
            FROM artworks a
            JOIN artists ar ON a.artist_id = ar.id
            ORDER BY a.created_at DESC
            LIMIT :offset, :perPage
        ");

    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll();
  }

  /**
   * Filtre les œuvres selon plusieurs critères
   */
  public function filter(array $filters = [], int $page = 1, int $perPage = 12): array
  {
    $offset = ($page - 1) * $perPage;
    $where = [];
    $params = [
      'offset' => $offset,
      'perPage' => $perPage
    ];

    // Construction dynamique de la requête
    if (!empty($filters['category'])) {
      $where[] = "a.category = :category";
      $params['category'] = $filters['category'];
    }

    if (!empty($filters['period'])) {
      $where[] = "a.period = :period";
      $params['period'] = $filters['period'];
    }

    if (!empty($filters['search'])) {
      $where[] = "(a.title LIKE :search OR ar.name LIKE :search)";
      $params['search'] = '%' . $filters['search'] . '%';
    }

    $whereClause = $where ? 'WHERE ' . implode(' AND ', $where) : '';

    // Requête de base
    $sql = "
            SELECT 
                a.id, 
                a.title, 
                a.image, 
                a.year, 
                a.medium,
                a.category,
                a.period,
                a.likes,
                ar.name AS artist
            FROM artworks a
            JOIN artists ar ON a.artist_id = ar.id
            $whereClause
            ORDER BY " . $this->getOrderClause($filters['sort'] ?? 'recent') . "
            LIMIT :offset, :perPage
        ";

    $stmt = $this->db->prepare($sql);

    foreach ($params as $key => $value) {
      $stmt->bindValue(':' . $key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
    }

    $stmt->execute();
    return $stmt->fetchAll();
  }

  /**
   * Récupère les détails complets d'une œuvre
   */
  public function getDetails(int $id): ?array
  {
    $stmt = $this->db->prepare("
            SELECT 
                a.*,
                ar.name AS artist,
                ar.biography AS artist_bio,
                ar.portrait AS artist_portrait,
                ar.slug AS artist_slug
            FROM artworks a
            JOIN artists ar ON a.artist_id = ar.id
            WHERE a.id = :id
        ");

    $stmt->execute([':id' => $id]);
    $artwork = $stmt->fetch();

    if ($artwork) {
      // Incrémente le compteur de vues
      $this->incrementViews($id);
      return $artwork;
    }

    return null;
  }

  /**
   * Récupère les œuvres similaires
   */
  public function getRelated(int $artworkId, int $limit = 4): array
  {
    // D'abord on récupère les infos de l'œuvre actuelle
    $current = $this->getDetails($artworkId);

    if (!$current) return [];

    $stmt = $this->db->prepare("
            SELECT 
                a.id, 
                a.title, 
                a.image, 
                a.year,
                ar.name AS artist
            FROM artworks a
            JOIN artists ar ON a.artist_id = ar.id
            WHERE a.id != :id 
            AND (a.artist_id = :artist_id OR a.period = :period OR a.category = :category)
            ORDER BY RAND()
            LIMIT :limit
        ");

    $stmt->execute([
      ':id' => $artworkId,
      ':artist_id' => $current['artist_id'],
      ':period' => $current['period'],
      ':category' => $current['category'],
      ':limit' => $limit
    ]);

    return $stmt->fetchAll();
  }

  public function getFilteredArtworks(?string $category, ?string $period, ?string $search, string $sort, int $page = 1, int $perPage = 12): array
  {
    $offset = ($page - 1) * $perPage;

    $sql = "SELECT a.*, ar.name AS artist 
            FROM artworks a
            JOIN artists ar ON a.artist_id = ar.id
            WHERE 1=1";

    $params = [];

    // Filtre par catégorie
    if ($category) {
      $sql .= " AND a.category LIKE :category";
      $params[':category'] = "%$category%";
    }

    // Filtre par période
    if ($period) {
      $sql .= " AND a.period LIKE :period";
      $params[':period'] = "%$period%";
    }

    // Filtre par recherche
    if ($search) {
      $sql .= " AND (a.title LIKE :search OR ar.name LIKE :search)";
      $params[':search'] = "%$search%";
    }

    // Tri
    switch ($sort) {
      case 'oldest':
        $sql .= " ORDER BY a.year ASC";
        break;
      case 'popular':
        $sql .= " ORDER BY a.views DESC";
        break;
      case 'az':
        $sql .= " ORDER BY a.title ASC";
        break;
      case 'za':
        $sql .= " ORDER BY a.title DESC";
        break;
      default: // recent
        $sql .= " ORDER BY a.id DESC";
    }

    // Pagination
    $sql .= " LIMIT :limit OFFSET :offset";
    $params[':limit'] = $perPage;
    $params[':offset'] = $offset;

    $stmt = $this->db->prepare($sql);

    foreach ($params as $key => $value) {
      $paramType = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
      $stmt->bindValue($key, $value, $paramType);
    }

    $stmt->execute();

    return $stmt->fetchAll();
  }
  /**
   * Met à jour le compteur de likes
   */
  public function toggleLike(int $artworkId, int $userId): array
  {
    // Vérifie si l'utilisateur a déjà liké
    $stmt = $this->db->prepare("
            SELECT id FROM artwork_likes 
            WHERE artwork_id = :artwork_id AND user_id = :user_id
        ");
    $stmt->execute([
      ':artwork_id' => $artworkId,
      ':user_id' => $userId
    ]);

    if ($stmt->fetch()) {
      // Supprime le like
      $stmt = $this->db->prepare("
                DELETE FROM artwork_likes 
                WHERE artwork_id = :artwork_id AND user_id = :user_id
            ");
      $stmt->execute([
        ':artwork_id' => $artworkId,
        ':user_id' => $userId
      ]);

      $action = 'unliked';
    } else {
      // Ajoute le like
      $stmt = $this->db->prepare("
                INSERT INTO artwork_likes (artwork_id, user_id) 
                VALUES (:artwork_id, :user_id)
            ");
      $stmt->execute([
        ':artwork_id' => $artworkId,
        ':user_id' => $userId
      ]);

      $action = 'liked';
    }

    // Récupère le nouveau total de likes
    $totalLikes = $this->db->query("
            SELECT COUNT(*) FROM artwork_likes 
            WHERE artwork_id = $artworkId
        ")->fetchColumn();

    // Met à jour le compteur dans la table artworks
    $this->db->exec("
            UPDATE artworks SET likes = $totalLikes 
            WHERE id = $artworkId
        ");

    return [
      'action' => $action,
      'total_likes' => $totalLikes
    ];
  }

  /**
   * Incrémente le compteur de vues
   */
  private function incrementViews(int $artworkId): void
  {
    $this->db->exec("
            UPDATE artworks SET views = views + 1 
            WHERE id = $artworkId
        ");
  }

  /**
   * Récupère les œuvres les plus populaires
   */
  public function getPopular(int $limit = 6): array
  {
    $stmt = $this->db->prepare("
            SELECT 
                a.id, 
                a.title, 
                a.image, 
                a.views,
                a.likes,
                ar.name AS artist
            FROM artworks a
            JOIN artists ar ON a.artist_id = ar.id
            ORDER BY a.views DESC, a.likes DESC
            LIMIT :limit
        ");

    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll();
  }

  /**
   * Récupère les œuvres d'un artiste
   */
  public function getByArtist(int $artistId, int $limit = 12): array
  {
    $stmt = $this->db->prepare("
            SELECT 
                a.id, 
                a.title, 
                a.image, 
                a.year,
                a.medium
            FROM artworks a
            WHERE a.artist_id = :artist_id
            ORDER BY a.year DESC
            LIMIT :limit
        ");

    $stmt->execute([
      ':artist_id' => $artistId,
      ':limit' => $limit
    ]);

    return $stmt->fetchAll();
  }

  /**
   * Génère la clause ORDER BY en fonction du critère de tri
   */
  private function getOrderClause(string $sort): string
  {
    switch ($sort) {
      case 'oldest':
        return 'a.year ASC';
      case 'popular':
        return 'a.views DESC, a.likes DESC';
      case 'az':
        return 'a.title ASC';
      case 'za':
        return 'a.title DESC';
      case 'recent':
      default:
        return 'a.created_at DESC';
    }
  }

  /**
   * Récupère les œuvres pour une exposition ou toutes les œuvres si aucun ID n'est spécifié
   * @param int|null $exhibitionId ID de l'exposition ou null pour toutes les œuvres
   * @return array
   */
  public function getArtworks(?int $exhibitionId = null, int $limit = 0): array
  {
    $sql = "
        SELECT 
            a.id, a.title, a.image, a.year, a.medium,
            ar.name AS artist, ar.slug AS artist_slug
        FROM artworks a
        JOIN artists ar ON a.artist_id = ar.id
    ";

    if ($exhibitionId) {
      $sql .= " JOIN exhibition_artworks ea ON a.id = ea.artwork_id
                  WHERE ea.exhibition_id = :exhibition_id";
    }

    if ($limit > 0) {
      $sql .= " LIMIT :limit";
    }

    $stmt = $this->db->prepare($sql);

    if ($exhibitionId) {
      $stmt->bindValue(':exhibition_id', $exhibitionId, PDO::PARAM_INT);
    }

    if ($limit > 0) {
      $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    }

    $stmt->execute();
    return $stmt->fetchAll();
  }
}
