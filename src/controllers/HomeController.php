<?php

namespace MuseeVirtuel\Controllers;

use MuseeVirtuel\Core\Controller;
use MuseeVirtuel\Models\Artwork;
use MuseeVirtuel\Models\Artist;
use MuseeVirtuel\Models\Exhibition;

class HomeController extends Controller
{
  protected $Artwork;
  protected $Artist;
  protected $Exhibition;

  public function __construct()
  {
    parent::__construct();

    $this->Artwork = new Artwork();
    $this->Artist = new Artist();
    $this->Exhibition = new Exhibition();
  }

  public function index()
  {
    $data = [  
      'featuredArtworks' => $this->Artwork->getFeatured(6),
      'currentExhibitions' => $this->Exhibition->getCurrentExhibitions(),
      'featuredArtists' => $this->Artist->getFeaturedArtists(5),
      'exhibitionArtworks' => $this->Artwork->getCurrentExhibitionArtworks() ?? []
    ];

    $this->render('home/index', $data);
  }
}
