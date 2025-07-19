<?php

namespace MuseeVirtuel\Controllers;

use MuseeVirtuel\Core\Controller;

class GalerieController extends Controller
{
  public function index()
  {
    $this->loadModel('Artwork');

    // Récupération des paramètres de filtrage
    $category = $_GET['category'] ?? null;
    $period = $_GET['period'] ?? null;
    $search = $_GET['search'] ?? null;
    $sort = $_GET['sort'] ?? 'recent';
    $page = (int)($_GET['page'] ?? 1);

    // Récupération des œuvres filtrées
    $artworks = $this->model->getFilteredArtworks($category, $period, $search, $sort, $page);

    $data = [
      'artworks' => $artworks,
      'current_category' => $category,
      'current_period' => $period,
      'current_sort' => $sort,
      'page_css' => ['gallery.css', 'filter.css'],
      'page_js' => ['gallery-filter.js']
    ];

    $this->render('galerie/index', $data);
  }

  public function detail($id)
  {
    $this->loadModel('Artwork');

    $artwork = $this->model->getDetails($id);

    if (!$artwork) {
      $this->handleError(404, 'Œuvre non trouvée');
      return;
    }

    $data = [
      'artwork' => $artwork,
      'related' => $this->model->getRelated($id),
      'page_css' => ['lightbox.css'],
      'page_js' => ['lightbox.js', 'share.js']
    ];

    $this->render('galerie/detail', $data);
  }
}
