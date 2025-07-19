<?php

namespace MuseeVirtuel\Models;

use MuseeVirtuel\Config\Database;
use PDO;

class Artist
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance();
  }

  public function getFeaturedArtists(int $limit = 5): array
  {
    $stmt = $this->db->prepare("
            SELECT id, name, slug, portrait, period 
            FROM artists 
            WHERE is_featured = TRUE 
            ORDER BY RAND() 
            LIMIT :limit
        ");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
  }
}
