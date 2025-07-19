<?php
$page_css = ['about.css', 'timeline.css'];
?>

<?php $this->layout('layouts/default', ['pageTitle' => 'À Propos - Musée Virtuel', 'page_css' => $page_css]) ?>

<?php $this->start('main_content') ?>
<!-- Hero About -->
<section class="about-hero">
  <div class="hero-background" style="background-image: url('<?= BASE_URL ?>/assets/images/header/pexels-conojeghuo-375882.jpg')"></div>
  <div class="hero-content">
    <h1>Notre <span class="highlight">Histoire</span> & <span class="highlight">Mission</span></h1>
    <p>Découvrez la passion qui anime notre musée depuis sa création</p>
  </div>
  <div class="scroll-indicator">
    <span>Explorer</span>
    <div class="arrow-down"></div>
  </div>
</section>

<!-- Timeline Section -->
<section class="timeline-section" id="history">
  <div class="section-header">
    <h2>Notre Histoire</h2>
    <p>Un voyage à travers les moments clés de notre institution</p>
  </div>

  <div class="timeline-container">
    <div class="timeline-line"></div>

    <?php foreach ($timelineEvents as $index => $event): ?>
      <div class="timeline-event <?= $index % 2 === 0 ? 'left' : 'right' ?>">
        <div class="event-card">
          <div class="event-date"><?= $event['year'] ?></div>
          <h3 class="event-title"><?= $this->escape($event['title']) ?></h3>
          <p class="event-description"><?= $this->escape($event['description']) ?></p>
          <?php if (isset($event['image'])): ?>
            <div class="event-image">
              <img src="<?= BASE_URL . '/assets/images/about/' . $event['image'] ?>" alt="<?= $this->escape($event['title']) ?>">
            </div>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- Mission Section -->
<section class="mission-section">
  <div class="mission-container">
    <div class="mission-image">
      <div class="image-wrapper">
        <img src="<?= BASE_URL . '/assets/images/about/mission.jpg' ?>" alt="Notre mission">
        <div class="image-overlay"></div>
      </div>
    </div>
    <div class="mission-content">
      <h2>Notre Mission</h2>
      <p class="mission-statement">Rendre l'art accessible à tous, partout dans le monde, à travers des expériences numériques immersives.</p>

      <div class="mission-values">
        <div class="value-card">
          <div class="value-icon">
            <i class="fa-brands fa-accessible-icon"></i>
          </div>
          <h3>Accessibilité</h3>
          <p>Briser les barrières physiques et économiques pour accéder à la culture</p>
        </div>

        <div class="value-card">
          <div class="value-icon">
            <i class="fas fa-graduation-cap"></i>
          </div>
          <h3>Éducation</h3>
          <p>Éveiller la curiosité et enrichir les connaissances artistiques</p>
        </div>

        <div class="value-card">
          <div class="value-icon">
            <i class="fa-regular fa-lightbulb"></i>
          </div>
          <h3>Innovation</h3>
          <p>Repousser les limites de l'expérience muséale grâce à la technologie</p>
        </div>

        <div class="value-card">
          <div class="value-icon">
            <i class="fa-solid fa-file-powerpoint"></i>
          </div>
          <h3>Préservation</h3>
          <p>Conserver numériquement le patrimoine artistique pour les générations futures</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Team Section -->
<section class="team-section">
  <div class="section-header">
    <h2>Notre Équipe</h2>
    <p>Les passionnés qui font vivre le Musée Virtuel</p>
  </div>

  <div class="team-container">
    <?php foreach ($teamMembers as $member): ?>
      <div class="team-card">
        <div class="team-photo">
          <img src="<?= BASE_URL . '/assets/images/team/' . $member['photo'] ?>" alt="<?= $this->escape($member['name']) ?>">
          <div class="photo-overlay">
            <div class="social-links">
              <?php if (isset($member['twitter'])): ?>
                <a href="<?= $member['twitter'] ?>" target="_blank"><i class="icon-twitter"></i></a>
              <?php endif; ?>
              <?php if (isset($member['linkedin'])): ?>
                <a href="<?= $member['linkedin'] ?>" target="_blank"><i class="icon-linkedin"></i></a>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="team-info">
          <h3><?= $this->escape($member['name']) ?></h3>
          <p class="position"><?= $this->escape($member['position']) ?></p>
          <p class="bio"><?= $this->escape($member['bio']) ?></p>
          <button class="btn-contact" data-email="<?= $member['email'] ?>">Contacter</button>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- Technology Section -->
<section class="tech-section">
  <div class="tech-container">
    <div class="tech-content">
      <h2>Notre Technologie</h2>
      <p>Découvrez les innovations qui alimentent notre plateforme</p>

      <div class="tech-stack">
        <div class="tech-item">
          <div class="tech-icon">
            <img src="<?= BASE_URL . '/assets/images/tech/3d-scan.png' ?>" alt="Scan 3D">
          </div>
          <h3>Scan 3D Haute Résolution</h3>
          <p>Numérisation précise au micron près pour une reproduction fidèle</p>
        </div>

        <div class="tech-item">
          <div class="tech-icon">
            <img src="<?= BASE_URL . '/assets/images/tech/ai.png' ?>" alt="IA">
          </div>
          <h3>Intelligence Artificielle</h3>
          <p>Analyse et classification avancée des œuvres d'art</p>
        </div>

        <div class="tech-item">
          <div class="tech-icon">
            <img src="<?= BASE_URL . '/assets/images/tech/vr.png' ?>" alt="Réalité Virtuelle">
          </div>
          <h3>Réalité Virtuelle</h3>
          <p>Expériences immersives à 360° dans les plus grands musées</p>
        </div>

        <div class="tech-item">
          <div class="tech-icon">
            <img src="<?= BASE_URL . '/assets/images/tech/blockchain.png' ?>" alt="Blockchain">
          </div>
          <h3>Blockchain</h3>
          <p>Authentification et certification des œuvres numériques</p>
        </div>
      </div>
    </div>
    <div class="tech-visual">
      <div class="visual-container" id="techVisual">
        <div class="visual-item active" data-tech="scan">
          <img src="<?= BASE_URL . '/assets/images/tech/scan-demo.jpg' ?>" alt="Démonstration scan 3D">
        </div>
        <div class="visual-item" data-tech="ai">
          <img src="<?= BASE_URL . '/assets/images/tech/ai-demo.jpg' ?>" alt="Démonstration IA">
        </div>
        <div class="visual-item" data-tech="vr">
          <img src="<?= BASE_URL . '/assets/images/tech/vr-demo.jpg' ?>" alt="Démonstration VR">
        </div>
        <div class="visual-item" data-tech="blockchain">
          <img src="<?= BASE_URL . '/assets/images/tech/blockchain-demo.jpg' ?>" alt="Démonstration Blockchain">
        </div>
      </div>
      <div class="tech-nav">
        <button class="tech-nav-btn active" data-target="scan"></button>
        <button class="tech-nav-btn" data-target="ai"></button>
        <button class="tech-nav-btn" data-target="vr"></button>
        <button class="tech-nav-btn" data-target="blockchain"></button>
      </div>
    </div>
  </div>
</section>

<!-- Partners Section -->
<section class="partners-section">
  <div class="section-header">
    <h2>Nos Partenaires</h2>
    <p>Des institutions prestigieuses qui nous font confiance</p>
  </div>

  <div class="partners-carousel">
    <?php foreach ($partners as $partner): ?>
      <div class="partner-logo">
        <img src="<?= BASE_URL . '/assets/images/partners/' . $partner['logo'] ?>" alt="<?= $this->escape($partner['name']) ?>">
        <div class="partner-tooltip"><?= $this->escape($partner['name']) ?></div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- Contact CTA -->
<section class="contact-cta">
  <div class="cta-container">
    <h2>Vous avez des questions ?</h2>
    <p>Notre équipe est à votre disposition pour toute demande d'information</p>
    <a href="<?= url('contact') ?>" class="btn btn-primary">Nous contacter</a>
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Timeline Animation
    const timelineEvents = document.querySelectorAll('.timeline-event');

    function animateTimeline() {
      timelineEvents.forEach(event => {
        const eventTop = event.getBoundingClientRect().top;
        const windowHeight = window.innerHeight;

        if (eventTop < windowHeight * 0.75) {
          event.classList.add('animated');
        }
      });
    }

    window.addEventListener('scroll', animateTimeline);
    animateTimeline(); // Initialize

    // Team Contact Buttons
    const contactButtons = document.querySelectorAll('.btn-contact');
    contactButtons.forEach(button => {
      button.addEventListener('click', function() {
        const email = this.getAttribute('data-email');
        window.location.href = `mailto:${email}`;
      });
    });

    // Technology Visual Switcher
    const techButtons = document.querySelectorAll('.tech-nav-btn');
    const techItems = document.querySelectorAll('.visual-item');

    techButtons.forEach(button => {
      button.addEventListener('click', function() {
        const target = this.getAttribute('data-target');

        // Update buttons
        techButtons.forEach(btn => btn.classList.remove('active'));
        this.classList.add('active');

        // Update items
        techItems.forEach(item => {
          item.classList.remove('active');
          if (item.getAttribute('data-tech') === target) {
            item.classList.add('active');
          }
        });
      });
    });

    // Auto-rotate tech visual
    let currentTechIndex = 0;
    setInterval(() => {
      currentTechIndex = (currentTechIndex + 1) % techButtons.length;
      techButtons[currentTechIndex].click();
    }, 5000);

    // Partners Carousel
    const partnersCarousel = new Splide('.partners-carousel', {
      type: 'loop',
      perPage: 5,
      autoplay: true,
      interval: 3000,
      speed: 1000,
      pauseOnHover: true,
      arrows: false,
      pagination: false,
      breakpoints: {
        1200: {
          perPage: 4
        },
        768: {
          perPage: 3
        },
        480: {
          perPage: 2
        }
      }
    }).mount();

    // Smooth scroll for hero arrow
    document.querySelector('.scroll-indicator').addEventListener('click', function() {
      document.getElementById('history').scrollIntoView({
        behavior: 'smooth'
      });
    });
  });
</script>
<?php $this->stop() ?>