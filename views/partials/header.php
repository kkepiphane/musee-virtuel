<?php
// Déterminez la page active en fonction de l'URL
$current_route = str_replace(BASE_URL, '', $_SERVER['REQUEST_URI']);
$current_route = explode('?', $current_route)[0]; // Enlevez les paramètres GET
?>
<header class="main-header">
  <div class="header-container">
    <!-- Logo -->
    <div class="logo-container">
      <a href="<?= url('/') ?>" class="logo-link">
        <svg class="logo-icon" viewBox="0 0 48 48">
          <path d="M24 6L6 24l18 18 18-18z" fill="#3a506b" />
          <path d="M24 6v36" stroke="#5bc0be" stroke-width="4" />
          <path d="M42 24H6" stroke="#5bc0be" stroke-width="4" />
          <circle cx="24" cy="24" r="4" fill="#e63946" />
        </svg>
        <span class="logo-text">Musée<span class="logo-highlight">Virtuel</span></span>
      </a>
    </div>

    <!-- Navigation Principale -->
    <nav class="main-nav">
      <ul class="nav-list">
        <li class="nav-item <?= ($current_route === '/') ? 'active' : '' ?>">
          <a href="<?= url('/') ?>" class="nav-link">Accueil</a>
        </li>
        <li class="nav-item <?= (strpos($current_route, '/galerie') === 0) ? 'active' : '' ?>">
          <a href="<?= url('galerie') ?>" class="nav-link">Galerie</a>
        </li>
        <li class="nav-item <?= (strpos($current_route, '/a-propos') === 0) ? 'active' : '' ?>">
          <a href="<?= url('a-propos') ?>" class="nav-link">À propos</a>
        </li>
        <li class="nav-item <?= (strpos($current_route, '/contact') === 0) ? 'active' : '' ?>">
          <a href="<?= url('contact') ?>" class="nav-link">Contact</a>
        </li>
      </ul>
    </nav>

    <!-- Utilitaires -->
    <div class="header-utils">
      <button class="search-toggle" id="searchToggle">
        <i class="fas fa-search"></i>
      </button>
      <div class="search-box" id="headerSearch">
        <input type="text" placeholder="Rechercher...">
        <button class="search-btn">
          <i class="fas fa-search"></i>
        </button>
      </div>

      <div class="user-actions">
        <a href="<?= url('mon-compte') ?>" class="account-link" title="Mon compte">
          <i class="fas fa-user"></i>
        </a>
        <a href="<?= url('favoris') ?>" class="wishlist-link" title="Favoris">
          <i class="fas fa-heart"></i>
          <span class="wishlist-count">3</span>
        </a>
      </div>

      <button class="menu-toggle" id="mobileMenuToggle">
        <span class="menu-bar"></span>
        <span class="menu-bar"></span>
        <span class="menu-bar"></span>
      </button>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div class="mobile-menu" id="mobileMenu">
    <div class="mobile-menu-container">
      <div class="mobile-menu-header">
        <a href="<?= url('/') ?>" class="mobile-logo">MuséeVirtuel</a>
        <button class="menu-close" id="mobileMenuClose">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <ul class="mobile-nav-list">
        <li class="<?= ($current_route === '/') ? 'active' : '' ?>">
          <a href="<?= url('/') ?>">Accueil</a>
        </li>
        <li class="<?= (strpos($current_route, '/galerie') === 0) ? 'active' : '' ?>">
          <a href="<?= url('galerie') ?>">Galerie</a>
        </li>
        <li class="<?= (strpos($current_route, '/a-propos') === 0) ? 'active' : '' ?>">
          <a href="<?= url('a-propos') ?>">À propos</a>
        </li>
        <li class="<?= (strpos($current_route, '/contact') === 0) ? 'active' : '' ?>">
          <a href="<?= url('contact') ?>">Contact</a>
        </li>
      </ul>

      <div class="mobile-utils">
        <div class="mobile-search">
          <input type="text" placeholder="Rechercher...">
          <button class="search-btn">
            <i class="fas fa-search"></i>
          </button>
        </div>

        <div class="mobile-user-actions">
          <a href="<?= url('mon-compte') ?>" class="btn btn-outline">
            <i class="fas fa-user"></i> Mon compte
          </a>
          <a href="<?= url('favoris') ?>" class="btn btn-primary">
            <i class="fas fa-heart"></i> Favoris
          </a>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- Search Overlay -->
<div class="search-overlay" id="searchOverlay">
  <div class="search-overlay-container">
    <button class="search-close" id="searchClose">
      <i class="fas fa-times"></i>
    </button>
    <div class="search-overlay-content">
      <h3>Rechercher dans le Musée Virtuel</h3>
      <form class="search-overlay-form">
        <input type="text" placeholder="Rechercher des œuvres, artistes, collections...">
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-search"></i> Rechercher
        </button>
      </form>
      <div class="search-suggestions">
        <h4>Suggestions :</h4>
        <ul>
          <li><a href="#">Van Gogh</a></li>
          <li><a href="#">Renaissance</a></li>
          <li><a href="#">Sculptures modernes</a></li>
          <li><a href="#">Expositions actuelles</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>