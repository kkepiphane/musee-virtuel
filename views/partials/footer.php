  <!-- Footer -->
  <footer class="main-footer">
    <div class="footer-container">
      <!-- Footer Top -->
      <div class="footer-top">
        <div class="footer-about">
          <div class="footer-logo">
            <a href="<?= url('/') ?>">
              <svg class="logo-icon" viewBox="0 0 48 48">
                <path d="M24 6L6 24l18 18 18-18z" fill="#fff" />
                <path d="M24 6v36" stroke="#5bc0be" stroke-width="4" />
                <path d="M42 24H6" stroke="#5bc0be" stroke-width="4" />
                <circle cx="24" cy="24" r="4" fill="#e63946" />
              </svg>
              <span>MuséeVirtuel</span>
            </a>
          </div>
          <p class="footer-description">
            Le Musée Virtuel offre un accès inégalé aux plus belles œuvres d'art du monde,
            à travers des expériences numériques immersives et des contenus éducatifs de qualité.
          </p>
          <div class="footer-social">
            <a href="#" class="social-link" aria-label="Facebook">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="social-link" aria-label="Twitter">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="social-link" aria-label="Instagram">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="social-link" aria-label="YouTube">
              <i class="fab fa-youtube"></i>
            </a>
            <a href="#" class="social-link" aria-label="Pinterest">
              <i class="fab fa-pinterest-p"></i>
            </a>
          </div>
        </div>

        <div class="footer-links">
          <div class="footer-column">
            <h4 class="footer-title">Explorer</h4>
            <ul>
              <li><a href="<?= url('galerie') ?>">Galerie</a></li>
              <!-- <li><a href="<?= url('expositions') ?>">Expositions</a></li>
              <li><a href="<?= url('collections') ?>">Collections</a></li> -->
              <li><a href="<?= url('a-propos') ?>">À propos</a></li>
              <li><a href="<?= url('contact') ?>">Contact</a></li>
            </ul>
          </div>
        </div>

        <div class="footer-newsletter">
          <h4 class="footer-title">Newsletter</h4>
          <p>Abonnez-vous pour recevoir nos actualités et offres exclusives</p>
          <form class="newsletter-form">
            <div class="input-group">
              <input type="email" placeholder="Votre email" required>
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-paper-plane"></i>
              </button>
            </div>
          </form>
          <div class="app-download">
            <p>Téléchargez notre application :</p>
            <div class="app-buttons">
              <a href="#" class="app-btn">
                <img src="<?= BASE_URL ?>/assets/images/icon-foot/download-on-the-app-store-apple-logo-svgrepo-com.svg" alt="Télécharger sur l'App Store">
              </a>

              <a href="#" class="app-btn">
                <img src="<?= BASE_URL ?>/assets/images/icon-foot/google-play-svgrepo-com.svg" alt="Disponible sur Google Play">
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer Bottom -->
      <div class="footer-bottom">
        <div class="footer-copyright">
          &copy; <?= date('Y') ?> Musée Virtuel. Tous droits réservés.
        </div>
        <div class="footer-legal">
          <a href="<?= url('conditions') ?>">Conditions d'utilisation</a>
          <a href="<?= url('politique-confidentialite') ?>">Politique de confidentialité</a>
          <a href="<?= url('cookies') ?>">Préférences cookies</a>
        </div>
        <div class="footer-lang">
          <select id="languageSelector">
            <option value="fr" selected>Français</option>
            <option value="en">English</option>
            <option value="es">Español</option>
            <option value="de">Deutsch</option>
            <option value="it">Italiano</option>
          </select>
        </div>
      </div>
    </div>
  </footer>

  <!-- Back to Top Button -->
  <button class="back-to-top" id="backToTop">
    <i class="fas fa-arrow-up"></i>
  </button>

  <script>
    // Header functionality
    document.addEventListener('DOMContentLoaded', function() {
      // Mobile menu toggle
      const mobileMenuToggle = document.getElementById('mobileMenuToggle');
      const mobileMenu = document.getElementById('mobileMenu');
      const mobileMenuClose = document.getElementById('mobileMenuClose');

      mobileMenuToggle.addEventListener('click', function() {
        mobileMenu.classList.add('active');
        document.body.style.overflow = 'hidden';
      });

      mobileMenuClose.addEventListener('click', function() {
        mobileMenu.classList.remove('active');
        document.body.style.overflow = 'auto';
      });

      // Mobile dropdown
      const mobileDropdownToggles = document.querySelectorAll('.mobile-dropdown-toggle');
      mobileDropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
          e.preventDefault();
          const dropdown = this.nextElementSibling;
          const icon = this.querySelector('i');

          dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
          icon.classList.toggle('fa-chevron-up');
          icon.classList.toggle('fa-chevron-down');
        });
      });

      // Search toggle
      const searchToggle = document.getElementById('searchToggle');
      const headerSearch = document.getElementById('headerSearch');
      const searchOverlay = document.getElementById('searchOverlay');
      const searchClose = document.getElementById('searchClose');

      searchToggle.addEventListener('click', function() {
        searchOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
      });

      searchClose.addEventListener('click', function() {
        searchOverlay.classList.remove('active');
        document.body.style.overflow = 'auto';
      });

      // Back to top button
      const backToTop = document.getElementById('backToTop');
      window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
          backToTop.classList.add('show');
        } else {
          backToTop.classList.remove('show');
        }
      });

      backToTop.addEventListener('click', function() {
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });
      });

      // Smooth scroll for anchor links
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
          e.preventDefault();

          const targetId = this.getAttribute('href');
          if (targetId === '#') return;

          const targetElement = document.querySelector(targetId);
          if (targetElement) {
            targetElement.scrollIntoView({
              behavior: 'smooth'
            });

            // Close mobile menu if open
            if (mobileMenu.classList.contains('active')) {
              mobileMenu.classList.remove('active');
              document.body.style.overflow = 'auto';
            }
          }
        });
      });
    });
  </script>
  </body>

  </html>