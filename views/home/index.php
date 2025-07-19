<?php

$page_css = ['home.css', 'animations.css'];
?>
<?php $this->layout('layouts/default', ['pageTitle' => 'Musée Virtuel - Explorer les chefs-d\'œuvre artistiques', 'page_css' => $page_css]) ?>

<?php $this->start('main_content') ?>
<!-- Hero Section -->
<section class="hero">
  <div class="hero-content">
    <!-- Slider d'arrière-plan -->
    <div class="hero-slider">
      <div class="hero-background active" style="background-image: url('<?= BASE_URL ?>/assets/images/header/zalfa-imani-1xp5VxvyKL0-unsplash.jpg')"></div>
      <div class="hero-background" style="background-image: url('<?= BASE_URL ?>/assets/images/header/pexels-pixabay-277054.jpg')"></div>
      <div class="hero-background" style="background-image: url('<?= BASE_URL ?>/assets/images/header/pexels-sevenstormphotography-1604991.jpg')"></div>
    </div>

    <!-- Contenu texte (inchangé) -->
    <h1 class="hero-title">Explorez les <span class="highlight">chefs-d'œuvre</span> de l'histoire</h1>
    <p class="hero-subtitle">Découvrez des milliers d'œuvres d'art numérisées en haute résolution</p>
    <div class="hero-actions">
      <a href="<?= url('galerie') ?>" class="btn btn-primary">Commencer l'exploration</a>
      <a href="#discover" class="btn btn-outline">Découvrir</a>
    </div>
  </div>
</section>

<!-- Collections Section -->
<section id="discover" class="collections">
  <div class="section-header">
    <h2>Nos Collections Exceptionnelles</h2>
    <p>Parcourez nos galeries thématiques</p>
  </div>

  <div class="collections-grid">
    <div class="collection-card">
      <div class="card-image" style="background-image: url('<?= BASE_URL ?>/assets/images/renaissance/New-Featured-Image-1200-x-675-6.jpg')"></div>
      <div class="card-content">
        <h3>Renaissance</h3>
        <p>Découvrez les œuvres qui ont marqué la renaissance artistique</p>
        <a href="<?= url('galerie?period=renaissance') ?>" class="btn-link">Explorer →</a>
      </div>
    </div>

    <div class="collection-card">
      <div class="card-image" style="background-image: url('<?= BASE_URL ?>/assets/images/collections/impressionism.jpg')"></div>
      <div class="card-content">
        <h3>Impressionnisme</h3>
        <p>La révolution de la lumière et de la couleur</p>
        <a href="<?= url('galerie?period=ressionnisme') ?>" class="btn-link">Explorer →</a>
      </div>
    </div>

    <div class="collection-card">
      <div class="card-image" style="background-image: url('<?= BASE_URL ?>/assets/images/avant-gardistes/jaune-rouge-bleu.jpg')"></div>
      <div class="card-content">
        <h3>Art Moderne</h3>
        <p>Les mouvements avant-gardistes du XXe siècle</p>
        <a href="<?= url('galerie?category=peinture') ?>" class="btn-link">Explorer →</a>
      </div>
    </div>

    <div class="collection-card">
      <div class="card-image" style="background-image: url('<?= BASE_URL ?>/assets/images/ere-digitale/digital-art-ai.jpg')"></div>
      <div class="card-content">
        <h3>Art Numérique</h3>
        <p>La création artistique à l'ère digitale</p>
        <a href="<?= url('galerie?period=digital') ?>" class="btn-link">Explorer →</a>
      </div>
    </div>
  </div>
</section>

<!-- Featured Exhibition -->
<section class="exhibition">
  <div class="exhibition-content">
    <h2>Exposition en Vedette</h2>
    <h3>"Lumière et Matière"</h3>
    <p>Une exploration des techniques de clair-obscur à travers les siècles, de Caravage à Rothko.</p>
    <div class="exhibition-details">
      <div class="detail-item">
        <i class="icon-calendar"></i>
        <span>15 Mars - 30 Juin 2025</span>
      </div>
      <div class="detail-item">
        <i class="icon-location"></i>
        <span>Galerie Principale</span>
      </div>
    </div>
    <a href="<?= url('contact') ?>" class="btn btn-primary">+ D'infos</a>
  </div>
  <div class="exhibition-slider">
    <div class="slider-mini">
      <?php
      foreach ($exhibitionArtworks as $artwork): ?>
        <div class="">
          <img src="<?= BASE_URL . '/assets/images/artworks/medium/' . $artwork['image'] ?>" alt="<?= $this->escape($artwork['title']) ?>">
          <div class="slide-tooltip"><?= $this->escape($artwork['title']) ?></div>
        </div>
      <?php endforeach; ?>
    </div>

    <button class="slider-btn prev">←</button>
    <button class="slider-btn next">→</button>
  </div>
</section>

<!-- Virtual Tour Section -->
<section class="virtual-tour">
  <div class="tour-container">
    <div class="tour-preview">
      <div class="preview-video-container">
        <video class="preview-video" id="tourVideo" muted loop>
          <!-- Les sources seront ajoutées par JavaScript -->
          <div class="video-loading">Cliquez pour commencer</div>
        </video>
        <div class="play-button">
          <i class="fa fa-play"></i>
        </div>
      </div>
    </div>
    <div class="tour-content">
      <h2>Visite Virtuelle Immersive</h2>
      <p>Explorez nos galeries comme si vous y étiez avec notre technologie de visite 360°.</p>
      <ul class="tour-features">
        <li><i class="icon-check"></i> Navigation libre à 360°</li>
        <li><i class="icon-check"></i> Commentaires audio d'experts</li>
        <li><i class="icon-check"></i> Fonctionnalité réalité virtuelle</li>
        <li><i class="icon-check"></i> Accès aux détails des œuvres</li>
      </ul>
      <a href="<?= url('galerie') ?>" class="btn btn-secondary">Commencer la visite</a>
    </div>

    <div class="video-selector">
      <button class="video-thumbnail" data-video-index="0">
        <img src="<?= BASE_URL ?>/assets/videos/thumb1.png" alt="Vidéo 1">
      </button>
      <button class="video-thumbnail" data-video-index="1">
        <img src="<?= BASE_URL ?>/assets/videos/thumb2.png" alt="Vidéo 2">
      </button>
      <button class="video-thumbnail" data-video-index="2">
        <img src="<?= BASE_URL ?>/assets/videos/thumb3.png" alt="Vidéo 3">
      </button>
    </div>
  </div>
</section>

<!-- Artists Spotlight -->
<section class="artists">
  <div class="section-header">
    <h2>Artistes à l'Honneur</h2>
    <p>Découvrez les maîtres qui ont façonné l'histoire de l'art</p>
  </div>

  <div class="artists-carousel">
    <?php
    foreach ($featuredArtists as $artist): ?>
      <div class="artist-card" data-bio="<?= $this->escape($artist['bio'] ?? '') ?>">
        <div class="artist-portrait">
          <img src="<?= BASE_URL . '/assets/images/artists/' . $artist['portrait'] ?>"
            alt="<?= $this->escape($artist['name']) ?>">
          <div class="artist-overlay">
            <a href="#" class="btn btn-small">Voir profil</a>
          </div>
        </div>
        <div class="artist-info">
          <h3><?= $this->escape($artist['name']) ?></h3>
          <p><?= $this->escape($artist['period']) ?></p>
          <div class="artist-rating">
            <?php for ($i = 0; $i < ($artist['rating'] ?? 3); $i++): ?>
              <i class="icon-star">★</i>
            <?php endfor; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- Newsletter -->
<section class="newsletter">
  <div class="newsletter-container">
    <div class="newsletter-content">
      <h2>Restez Informés</h2>
      <p>Abonnez-vous à notre newsletter pour recevoir les dernières actualités et expositions</p>
    </div>
    <form class="newsletter-form" id="newsletterForm">
      <div class="form-group">
        <input type="email" placeholder="Votre email" required>
        <button type="submit" class="btn btn-primary" style="border-color:white;">S'abonner</button>
      </div>
      <div class="form-consent">
        <input type="checkbox" id="newsletterConsent" required>
        <label for="newsletterConsent">J'accepte de recevoir des emails du Musée Virtuel</label>
      </div>
    </form>
  </div>
</section>
<!-- Modal Video -->
<div id="videoModal" class="video-modal">
  <div class="modal-content">
    <span class="close-modal">&times;</span>
    <video id="modalVideo" controls>
      Votre navigateur ne supporte pas les vidéos HTML5.
    </video>
  </div>
</div>

<!-- Ajoutez ceci à la fin de votre body -->
<div class="modal-overlay" id="artistModal">
  <div class="modal-container">
    <button class="modal-close">&times;</button>
    <div class="modal-content">
      <div class="modal-portrait">
        <img id="modalArtistImage" src="" alt="">
      </div>
      <div class="modal-info">
        <div class="modal-info-content"> <!-- Nouveau conteneur -->
          <h2 id="modalArtistName"></h2>
          <p class="modal-period" id="modalArtistPeriod"></p>
          <div class="modal-rating" id="modalArtistRating"></div>
          <div class="modal-bio">
            <p id="modalArtistBio"></p>
          </div>
          <a href="#" class="btn btn-primary" id="modalArtistLink">Voir toutes les œuvres</a>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Hero Slider
  document.addEventListener('DOMContentLoaded', function() {
    const tourVideo = document.getElementById('tourVideo');
    const modalVideo = document.getElementById('modalVideo');
    const videoModal = document.getElementById('videoModal');
    const playButton = document.querySelector('.play-button');
    const closeModal = document.querySelector('.close-modal');

    const tourVideos = [
      '<?= BASE_URL ?>/assets/videos/vidéo.mp4',
      '<?= BASE_URL ?>/assets/videos/Art contemporain _ pourquoi le prix des oeuvres explose.mp4',
      '<?= BASE_URL ?>/assets/videos/POURQUOI ART CONTEMPORAIN EST UNE ARNAQUE _.mp4'
    ];

    let currentTourVideo = 0;
    let videoInterval;
    let hasInteracted = false;

    // Initial load without autoplay
    tourVideo.src = tourVideos[0];
    modalVideo.src = tourVideos[0];
    tourVideo.setAttribute('data-playing', 'false');

    function changeTourVideo() {
      if (!hasInteracted) return;

      currentTourVideo = (currentTourVideo + 1) % tourVideos.length;
      tourVideo.src = tourVideos[currentTourVideo];
      tourVideo.load();
      tourVideo.play().catch(e => console.log("Video play error:", e));
    }

    // Open modal and start playback
    function startPlayback() {
      hasInteracted = true;

      // Set current video in modal
      modalVideo.src = tourVideos[currentTourVideo];
      modalVideo.play();

      // Start playing the preview video
      tourVideo.play()
        .then(() => {
          tourVideo.setAttribute('data-playing', 'true');
          playButton.querySelector('i').classList.replace('fa-play', 'fa-pause');
        })
        .catch(e => console.log("Preview play error:", e));

      // Start video rotation
      videoInterval = setInterval(changeTourVideo, 10000);

      // Open modal
      videoModal.style.display = "block";
    }

    // Nouvelle fonction pour changer de vidéo
    function loadSpecificVideo(index) {
      currentTourVideo = index;
      tourVideo.src = tourVideos[index];
      modalVideo.src = tourVideos[index];

      tourVideo.load();
      tourVideo.play().catch(e => console.log("Play error:", e));

      // Mise à jour de la miniature active
      document.querySelectorAll('.video-thumbnail').forEach(btn => {
        btn.style.borderColor =
          parseInt(btn.dataset.videoIndex) === index ? 'var(--primary)' : 'transparent';
      });
    }

    // Ajoutez ceci à l'initialisation :
    document.querySelectorAll('.video-thumbnail').forEach(button => {
      button.addEventListener('click', function() {
        const index = parseInt(this.dataset.videoIndex);
        loadSpecificVideo(index);

        // Si c'est la première interaction
        if (!hasInteracted) {
          hasInteracted = true;
          startPlayback();
        }
      });
    });

    // Modifiez changeTourVideo() pour garder la synchronisation :
    function changeTourVideo() {
      if (!hasInteracted) return;

      const nextIndex = (currentTourVideo + 1) % tourVideos.length;
      loadSpecificVideo(nextIndex);
    }
    // Play/Pause and modal control
    playButton.addEventListener('click', function(e) {
      e.stopPropagation();

      if (!hasInteracted) {
        startPlayback();
        return;
      }

      if (tourVideo.paused) {
        tourVideo.play();
        this.querySelector('i').classList.replace('fa-play', 'fa-pause');
      } else {
        tourVideo.pause();
        this.querySelector('i').classList.replace('fa-pause', 'fa-play');
      }
    });

    // Click on video opens modal
    tourVideo.addEventListener('click', function() {
      if (!hasInteracted) {
        startPlayback();
      } else {
        videoModal.style.display = "block";
        modalVideo.src = tourVideos[currentTourVideo];
        modalVideo.play();
        clearInterval(videoInterval);
      }
    });

    // Close modal
    closeModal.addEventListener('click', function() {
      videoModal.style.display = "none";
      modalVideo.pause();

      if (hasInteracted) {
        videoInterval = setInterval(changeTourVideo, 5000);
      }
    });

    // Close when clicking outside
    window.addEventListener('click', function(event) {
      if (event.target == videoModal) {
        videoModal.style.display = "none";
        modalVideo.pause();

        if (hasInteracted) {
          videoInterval = setInterval(changeTourVideo, 5000);
        }
      }
    });

    // Update UI based on video state
    tourVideo.addEventListener('play', function() {
      this.setAttribute('data-playing', 'true');
      playButton.querySelector('i').classList.replace('fa-play', 'fa-pause');
    });

    tourVideo.addEventListener('pause', function() {
      playButton.querySelector('i').classList.replace('fa-pause', 'fa-play');
    });
    // Newsletter Form
    const newsletterForm = document.getElementById('newsletterForm');
    newsletterForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const email = this.querySelector('input[type="email"]').value;

      // Simulate AJAX submission
      this.innerHTML = `
            <div class="newsletter-success">
                <i class="icon-check-circle"></i>
                <p>Merci pour votre inscription !</p>
            </div>
        `;
    });

    // Animate elements on scroll
    const animateOnScroll = function() {
      const elements = document.querySelectorAll('.collection-card, .exhibition-content, .tour-content');

      elements.forEach(element => {
        const elementPosition = element.getBoundingClientRect().top;
        const screenPosition = window.innerHeight / 1.2;

        if (elementPosition < screenPosition) {
          element.classList.add('animated');
        }
      });
    };

    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll(); // Initialize
  });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const slider = document.querySelector('.slider-mini');
    const slides = document.querySelectorAll('.mini-slide');
    const prevBtn = document.querySelector('.slider-btn.prev');
    const nextBtn = document.querySelector('.slider-btn.next');

    let currentIndex = 0;
    const slideWidth = slides[0].offsetWidth + 16; // Largeur d'un slide + gap (16px = 1rem)

    // Défilement automatique (optionnel)
    let autoSlideInterval = setInterval(() => {
      nextSlide();
    }, 3000); // Change toutes les 3 secondes

    function nextSlide() {
      currentIndex = (currentIndex + 1) % slides.length;
      updateSlider();
    }

    function prevSlide() {
      currentIndex = (currentIndex - 1 + slides.length) % slides.length;
      updateSlider();
    }

    function updateSlider() {
      slider.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
    }

    // Boutons de navigation
    nextBtn.addEventListener('click', () => {
      clearInterval(autoSlideInterval); // Stoppe l'auto-slide si interaction manuelle
      nextSlide();
    });

    prevBtn.addEventListener('click', () => {
      clearInterval(autoSlideInterval);
      prevSlide();
    });

    // Pause auto-slide au survol
    slider.addEventListener('mouseenter', () => clearInterval(autoSlideInterval));
    slider.addEventListener('mouseleave', () => {
      autoSlideInterval = setInterval(nextSlide, 3000);
    });
  });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const backgrounds = document.querySelectorAll('.hero-background');
    let currentIndex = 0;

    function showNextBackground() {
      // Masque l'image actuelle
      backgrounds[currentIndex].classList.remove('active');

      // Passe à l'image suivante
      currentIndex = (currentIndex + 1) % backgrounds.length;

      // Affiche la nouvelle image
      backgrounds[currentIndex].classList.add('active');
    }

    // Démarre le slider (change d'image toutes les 5 secondes)
    setInterval(showNextBackground, 5000);

    // Initialisation - montre la première image
    backgrounds[0].classList.add('active');
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Sélectionne tous les éléments nécessaires
    const artistCards = document.querySelectorAll('.artist-card');
    const modal = document.getElementById('artistModal');
    const modalClose = document.querySelector('.modal-close');

    // Fonction pour ouvrir le modal avec les données de l'artiste
    const openArtistModal = (artistData) => {
      // Met à jour le contenu du modal
      document.getElementById('modalArtistImage').src = artistData.portrait;
      document.getElementById('modalArtistName').textContent = artistData.name;
      document.getElementById('modalArtistPeriod').textContent = artistData.period;
      document.getElementById('modalArtistLink').href = artistData.link;

      // Gestion des étoiles de rating
      const ratingContainer = document.getElementById('modalArtistRating');
      ratingContainer.innerHTML = '';
      for (let i = 0; i < artistData.rating; i++) {
        ratingContainer.innerHTML += '<i class="icon-star">★</i>';
      }

      // Bio (ajoutez data-bio à vos cartes artistes)
      document.getElementById('modalArtistBio').textContent =
        artistData.bio || 'Biographie non disponible';

      // Affiche le modal
      modal.classList.add('active');
      document.body.style.overflow = 'hidden';
    };

    // Écouteur d'événements pour chaque carte artiste
    artistCards.forEach(card => {
      card.addEventListener('click', function(e) {
        // Ne pas ouvrir si on clique sur le lien "Voir profil"
        if (!e.target.closest('.artist-overlay a')) {
          const artistData = {
            portrait: card.querySelector('.artist-portrait img').src,
            name: card.querySelector('.artist-info h3').textContent,
            period: card.querySelector('.artist-info p').textContent,
            rating: card.querySelectorAll('.artist-rating .icon-star').length,
            link: card.querySelector('.artist-overlay a').href,
            bio: card.dataset.bio || '' // Récupère data-bio de la carte
          };
          openArtistModal(artistData);
        }
      });
    });

    // Fermeture du modal
    modalClose.addEventListener('click', () => {
      modal.classList.remove('active');
      document.body.style.overflow = 'auto';
    });

    // Ferme le modal quand on clique en dehors
    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.classList.remove('active');
        document.body.style.overflow = 'auto';
      }
    });
  });
</script>
<?php $this->stop() ?>