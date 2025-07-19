<?php
$page_css = ['gallery.css', 'filter.css'];
$page_js = ['gallery-filter.js', 'gallery-filter.js', 'page-bundle.js'] ?>

<?php $this->layout('layouts/default', ['pageTitle' => 'Galerie Virtuelle - Musée Virtuel', 'page_css' => $page_css, 'page_js' => $page_js]) ?>

<?php $this->start('main_content') ?>
<!-- Hero Gallery -->
<section class="gallery-hero">
  <div class="hero-background" style="background-image: url('<?= BASE_URL ?>/assets/images/header/pexels-riciardus-69903.jpg')"></div>
  <div class="hero-content">
    <h1>Galerie <span class="highlight">Virtuelle</span></h1>
    <p>Explorez nos collections d'exception depuis chez vous</p>
  </div>
</section>

<!-- Gallery Filters -->
<section class="gallery-filters">
  <div class="filters-container">
    <div class="filter-group">
      <button class="filter-btn active" data-filter="all">Toutes les œuvres</button>
      <button class="filter-btn" data-filter="peinture">Peintures</button>
      <button class="filter-btn" data-filter="sculpture">Sculptures</button>
      <button class="filter-btn" data-filter="photography">Photographie</button>
      <button class="filter-btn" data-filter="digital">Art numérique</button>
    </div>

    <div class="filter-group">
      <div class="custom-select">
        <select id="periodFilter">
          <option value="all">Toutes les périodes</option>
          <option value="renaissance">Renaissance</option>
          <option value="cubisme">Cubisme</option>
          <option value="ressionnisme">Impressionnisme</option>
          <option value="modern">Moderne</option>
          <option value="contemporary">Contemporain</option>
        </select>
        <div class="select-arrow">
          <i class="icon-arrow-down"></i>
        </div>
      </div>

      <div class="custom-select">
        <select id="sortFilter">
          <option value="recent">Plus récent</option>
          <option value="oldest">Plus ancien</option>
          <option value="popular">Plus populaire</option>
          <option value="az">A-Z</option>
          <option value="za">Z-A</option>
        </select>
        <div class="select-arrow">
          <i class="icon-arrow-down"></i>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Gallery Grid -->
<section class="gallery-container">
  <?php if (empty($artworks)): ?>
    <div class="no-results" style="text-align: center;">
      <p>Aucune œuvre trouvée avec ces critères de recherche.</p>
      <a href="<?= url('galerie') ?>" class="btn">Réinitialiser les filtres</a>
    </div>
  <?php else: ?>
    <div class="gallery-grid" id="galleryGrid">
      <?php foreach ($artworks as $artwork): ?>
        <div class="gallery-item"
          data-category="<?= $artwork['category'] ?>"
          data-period="<?= $artwork['period'] ?>"
          data-title="<?= $this->escape($artwork['title']) ?>"
          data-artist="<?= $this->escape($artwork['artist']) ?>"
          data-id="<?= $artwork['id'] ?>">
          <div class="artwork-card">
            <div class="artwork-image">
              <img src="<?= BASE_URL . '/assets/images/artworks/medium/' . $artwork['image'] ?>"
                alt="<?= $this->escape($artwork['title']) ?> par <?= $this->escape($artwork['artist']) ?>"
                loading="lazy">
              <div class="artwork-overlay">
                <button class="quick-view-btn" data-id="<?= $artwork['id'] ?>">
                  <i class="icon-eye"></i> Voir en détail
                </button>
              </div>
            </div>
            <div class="artwork-info">
              <h3><?= $this->escape($artwork['title']) ?></h3>
              <p class="artist"><?= $this->escape($artwork['artist']) ?>.</p>
              <p class="date"><?= $artwork['year'] ?></p>
              <div class="artwork-actions">
                <button class="like-btn" data-id="<?= $artwork['id'] ?>">
                  <i class="icon-heart"></i>
                  <span class="like-count"><?= $artwork['likes'] ?></span>
                </button>
                <button class="share-btn" data-id="<?= $artwork['id'] ?>">
                  <i class="icon-share"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="load-more-container">
      <button class="btn btn-outline" id="loadMoreBtn">Charger plus d'œuvres</button>
    </div>
  <?php endif; ?>
</section>



<!-- Share Modal -->
<div class="share-modal" id="shareModal">
  <div class="modal-content">
    <button class="close-modal" id="closeShareModal">
      <i class="icon-close"></i>
    </button>
    <h3>Partager cette œuvre</h3>
    <div class="share-options">
      <button class="social-share facebook">
        <i class="icon-facebook"></i>
        <span>Facebook</span>
      </button>
      <button class="social-share twitter">
        <i class="icon-twitter"></i>
        <span>Twitter</span>
      </button>
      <button class="social-share pinterest">
        <i class="icon-pinterest"></i>
        <span>Pinterest</span>
      </button>
      <button class="social-share link" id="copyLinkBtn">
        <i class="icon-link"></i>
        <span>Copier le lien</span>
      </button>
    </div>
    <div class="share-link-container">
      <input type="text" id="shareLinkInput" readonly>
      <button class="btn-small" id="copyLinkBtnAlt">Copier</button>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Gestion des filtres
    const filterButtons = document.querySelectorAll('.filter-btn');
    const periodFilter = document.getElementById('periodFilter');
    const sortFilter = document.getElementById('sortFilter');

    // Appliquer les filtres au changement
    filterButtons.forEach(btn => {
      btn.addEventListener('click', function() {
        const category = this.dataset.filter;
        updateGalleryFilters(category, periodFilter.value, sortFilter.value);
      });
    });

    periodFilter.addEventListener('change', function() {
      const activeCategory = document.querySelector('.filter-btn.active').dataset.filter;
      updateGalleryFilters(activeCategory, this.value, sortFilter.value);
    });

    sortFilter.addEventListener('change', function() {
      const activeCategory = document.querySelector('.filter-btn.active').dataset.filter;
      updateGalleryFilters(activeCategory, periodFilter.value, this.value);
    });

    function updateGalleryFilters(category, period, sort) {
      // Construire l'URL avec les paramètres
      let url = new URL(window.location.href);
      url.searchParams.set('category', category === 'all' ? '' : category);
      url.searchParams.set('period', period === 'all' ? '' : period);
      url.searchParams.set('sort', sort);

      // Recharger la page avec les nouveaux filtres
      window.location.href = url.toString();
    }

    // Initialisation des filtres depuis l'URL
    function initFiltersFromUrl() {
      const urlParams = new URLSearchParams(window.location.search);

      // Catégorie
      const category = urlParams.get('category');
      if (category) {
        const categoryBtn = document.querySelector(`.filter-btn[data-filter="${category}"]`);
        if (categoryBtn) {
          filterButtons.forEach(btn => btn.classList.remove('active'));
          categoryBtn.classList.add('active');
        }
      }

      // Période
      const period = urlParams.get('period');
      if (period && periodFilter) {
        periodFilter.value = period;
      }

      // Tri
      const sort = urlParams.get('sort');
      if (sort && sortFilter) {
        sortFilter.value = sort;
      }
    }

    initFiltersFromUrl();
  });
</script>


<?php $this->stop() ?>