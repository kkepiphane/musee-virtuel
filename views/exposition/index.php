<?php

$page_css = ['expositions.css', 'gallery.css'];
$page_js = ['exposition-carousel.js'];

?>

<?php $this->layout('layouts/default', ['pageTitle' => 'Expositions - Musée Virtuel', 'page_css' => $page_css, 'page_js' => $page_js]) ?>

<?php $this->start('main_content') ?>
<!-- Hero Section -->
<section class="expo-hero">
    <div class="hero-background" style="background-image: url('<?= asset('images/expositions/expo-hero.jpg') ?>')"></div>
    <div class="hero-content">
        <h1>Expositions <span class="highlight">Virtuelles</span></h1>
        <p>Découvrez nos collections thématiques et expositions temporaires en ligne</p>
        <div class="hero-scroll-indicator">
            <span>Explorer</span>
            <div class="arrow-down"></div>
        </div>
    </div>
</section>

<!-- Current Exhibitions -->
<section class="current-exhibitions">
    <div class="section-header">
        <h2>Expositions en Cours</h2>
        <p>Explorez nos expositions actuellement disponibles</p> 
    </div>

    <div class="expo-slider" id="currentExpoSlider">
        <?php foreach ($currentExhibitions as $expo): ?>
        <div class="expo-slide">
            <div class="expo-card">
                <div class="expo-image">
                    <img src="<?= asset('images/expositions/' . $expo['image']) ?>" 
                         alt="<?= $this->escape($expo['title']) ?>" 
                         loading="lazy">
                    <div class="expo-badge">
                        <span>En cours</span>
                    </div>
                    <div class="expo-overlay">
                        <a href="<?= url('exposition/' . $expo['slug']) ?>" class="expo-view-btn">
                            <i class="fas fa-eye"></i> Voir l'exposition
                        </a>
                    </div>
                </div>
                <div class="expo-info">
                    <h3><?= $this->escape($expo['title']) ?></h3>
                    <div class="expo-meta">
                        <span class="expo-date">
                            <i class="fas fa-calendar-alt"></i> 
                            <?= date('d.m.Y', strtotime($expo['start_date'])) ?> - <?= date('d.m.Y', strtotime($expo['end_date'])) ?>
                        </span>
                        <span class="expo-duration">
                            <i class="fas fa-clock"></i> 
                            <?= $expo['duration'] ?> min de visite
                        </span>
                    </div>
                    <p class="expo-description"><?= $this->escape($expo['short_description']) ?></p>
                    <div class="expo-actions">
                        <a href="<?= url('exposition/' . $expo['slug']) ?>" class="btn btn-primary">
                            Explorer
                        </a>
                        <button class="btn btn-outline expo-share-btn" data-expo-id="<?= $expo['id'] ?>">
                            <i class="fas fa-share-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Upcoming Exhibitions -->
<section class="upcoming-exhibitions">
    <div class="section-header">
        <h2>Expositions à Venir</h2>
        <p>Découvrez nos prochaines collections thématiques</p>
    </div>

    <div class="upcoming-grid">
        <?php foreach ($upcomingExhibitions as $expo): ?>
        <div class="upcoming-card">
            <div class="upcoming-image">
                <img src="<?= asset('images/expositions/' . $expo['image']) ?>" 
                     alt="<?= $this->escape($expo['title']) ?>" 
                     loading="lazy">
                <div class="upcoming-badge">
                    <span>Bientôt disponible</span>
                </div>
                <div class="upcoming-overlay">
                    <div class="countdown" data-date="<?= date('Y-m-d', strtotime($expo['start_date'])) ?>">
                        <div class="countdown-item">
                            <span class="countdown-days">00</span>
                            <span class="countdown-label">Jours</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-hours">00</span>
                            <span class="countdown-label">Heures</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-minutes">00</span>
                            <span class="countdown-label">Minutes</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="upcoming-info">
                <h3><?= $this->escape($expo['title']) ?></h3>
                <p class="upcoming-date">
                    <i class="fas fa-calendar-alt"></i> 
                    Début: <?= date('d.m.Y', strtotime($expo['start_date'])) ?>
                </p>
                <p class="upcoming-description"><?= $this->escape($expo['short_description']) ?></p>
                <button class="btn btn-outline reminder-btn" data-expo-id="<?= $expo['id'] ?>">
                    <i class="fas fa-bell"></i> Me rappeler
                </button>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Past Exhibitions -->
<section class="past-exhibitions">
    <div class="section-header">
        <h2>Archives des Expositions</h2>
        <p>Revivez nos expositions passées</p>
    </div>

    <div class="past-filter">
        <button class="filter-btn active" data-year="all">Toutes</button>
        <?php foreach ($exhibitionYears as $year): ?>
        <button class="filter-btn" data-year="<?= $year ?>"><?= $year ?></button>
        <?php endforeach; ?>
    </div>

    <div class="past-grid" id="pastExpoGrid">
        <?php foreach ($pastExhibitions as $expo): ?>
        <div class="past-card" data-year="<?= date('Y', strtotime($expo['end_date'])) ?>">
            <div class="past-image">
                <img src="<?= asset('images/expositions/' . $expo['image']) ?>" 
                     alt="<?= $this->escape($expo['title']) ?>" 
                     loading="lazy">
                <div class="past-overlay">
                    <a href="<?= url('exposition/' . $expo['slug']) ?>" class="past-view-btn">
                        Voir l'archive
                    </a>
                </div>
            </div>
            <div class="past-info">
                <h3><?= $this->escape($expo['title']) ?></h3>
                <p class="past-date">
                    <?= date('d.m.Y', strtotime($expo['start_date'])) ?> - <?= date('d.m.Y', strtotime($expo['end_date'])) ?>
                </p>
                <div class="past-stats">
                    <span class="stat-item">
                        <i class="fas fa-users"></i> <?= $expo['visitors'] ?> visiteurs
                    </span>
                    <span class="stat-item">
                        <i class="fas fa-heart"></i> <?= $expo['likes'] ?> favoris
                    </span>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="load-more-container">
        <button class="btn btn-outline" id="loadMorePast">Charger plus d'expositions</button>
    </div>
</section>

<!-- Virtual Tour CTA -->
<section class="virtual-tour-cta">
    <div class="cta-container">
        <div class="cta-content">
            <h2>Visite Guidée Exclusive</h2>
            <p>Découvrez nos expositions avec un guide expert grâce à nos visites virtuelles interactives</p>
            <a href="<?= url('visites-virtuelles') ?>" class="btn btn-primary">
                Découvrir les visites
            </a>
        </div>
        <div class="cta-image">
            <img src="<?= asset('images/expositions/virtual-tour-preview.jpg') ?>" 
                 alt="Visite virtuelle" 
                 loading="lazy">
            <div class="play-button">
                <i class="fas fa-play"></i>
            </div>
        </div>
    </div>
</section>

<!-- Share Modal -->
<div class="expo-share-modal" id="shareModal">
    <div class="modal-content">
        <button class="modal-close" id="closeShareModal">
            <i class="fas fa-times"></i>
        </button>
        <h3>Partager cette exposition</h3>
        <div class="share-options">
            <button class="social-share facebook">
                <i class="fab fa-facebook-f"></i>
                <span>Facebook</span>
            </button>
            <button class="social-share twitter">
                <i class="fab fa-twitter"></i>
                <span>Twitter</span>
            </button>
            <button class="social-share pinterest">
                <i class="fab fa-pinterest-p"></i>
                <span>Pinterest</span>
            </button>
            <button class="social-share link" id="copyLinkBtn">
                <i class="fas fa-link"></i>
                <span>Copier le lien</span>
            </button>
        </div>
    </div>
</div>

<!-- Reminder Modal -->
<div class="reminder-modal" id="reminderModal">
    <div class="modal-content">
        <button class="modal-close" id="closeReminderModal">
            <i class="fas fa-times"></i>
        </button>
        <h3>Rappel pour l'exposition</h3>
        <p>Recevez un rappel par email lorsque cette exposition sera disponible</p>
        <form id="reminderForm">
            <input type="hidden" id="reminderExpoId">
            <div class="form-group">
                <input type="email" id="reminderEmail" placeholder="Votre adresse email" required>
            </div>
            <div class="form-group checkbox-group">
                <input type="checkbox" id="newsletterOptIn" checked>
                <label for="newsletterOptIn">Recevoir aussi notre newsletter</label>
            </div>
            <button type="submit" class="btn btn-primary">
                <span class="btn-text">Activer le rappel</span>
                <div class="loader" id="reminderLoader"></div>
            </button>
        </form>
        <div class="form-success" id="reminderSuccess">
            <div class="success-icon">
                <i class="fas fa-check"></i>
            </div>
            <h4>Rappel activé avec succès !</h4>
            <p>Nous vous enverrons un email lorsque l'exposition sera disponible.</p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Current Exhibitions Slider
    const currentExpoSlider = new Splide('#currentExpoSlider', {
        type: 'loop',
        perPage: 1,
        perMove: 1,
        gap: '2rem',
        pagination: false,
        breakpoints: {
            1200: { perPage: 1 },
            992: { 
                perPage: 1,
                arrows: false,
                pagination: true
            }
        }
    }).mount();

    // Filter Past Exhibitions
    const pastFilterBtns = document.querySelectorAll('.past-filter .filter-btn');
    pastFilterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const year = this.dataset.year;
            
            // Update active button
            pastFilterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Filter items
            const allItems = document.querySelectorAll('.past-card');
            allItems.forEach(item => {
                if (year === 'all' || item.dataset.year === year) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // Load More Past Exhibitions
    const loadMoreBtn = document.getElementById('loadMorePast');
    let pastExpoLimit = 6;
    const allPastExpos = document.querySelectorAll('.past-card');
    
    function updatePastExpoVisibility() {
        allPastExpos.forEach((item, index) => {
            if (index < pastExpoLimit && 
                (item.style.display !== 'none' || 
                 document.querySelector('.past-filter .filter-btn.active').dataset.year === 'all')) {
                item.style.display = 'block';
            } else if (index >= pastExpoLimit) {
                item.style.display = 'none';
            }
        });
        
        loadMoreBtn.style.display = pastExpoLimit >= allPastExpos.length ? 'none' : 'block';
    }
    
    loadMoreBtn.addEventListener('click', function() {
        pastExpoLimit += 6;
        updatePastExpoVisibility();
    });
    
    updatePastExpoVisibility();

    // Countdown for Upcoming Exhibitions
    function updateCountdowns() {
        const countdowns = document.querySelectorAll('.countdown');
        const now = new Date().getTime();
        
        countdowns.forEach(countdown => {
            const targetDate = new Date(countdown.dataset.date).getTime();
            const distance = targetDate - now;
            
            if (distance > 0) {
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                
                countdown.querySelector('.countdown-days').textContent = days.toString().padStart(2, '0');
                countdown.querySelector('.countdown-hours').textContent = hours.toString().padStart(2, '0');
                countdown.querySelector('.countdown-minutes').textContent = minutes.toString().padStart(2, '0');
            } else {
                countdown.innerHTML = '<span>Exposition disponible</span>';
            }
        });
    }
    
    updateCountdowns();
    setInterval(updateCountdowns, 60000);

    // Share Modal
    const shareModal = document.getElementById('shareModal');
    const closeShareModal = document.getElementById('closeShareModal');
    const expoShareBtns = document.querySelectorAll('.expo-share-btn');
    
    expoShareBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const expoId = this.dataset.expoId;
            // In a real app, you would set the share URL here
            shareModal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        });
    });
    
    closeShareModal.addEventListener('click', function() {
        shareModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });

    // Reminder Modal
    const reminderModal = document.getElementById('reminderModal');
    const closeReminderModal = document.getElementById('closeReminderModal');
    const reminderBtns = document.querySelectorAll('.reminder-btn');
    const reminderForm = document.getElementById('reminderForm');
    const reminderSuccess = document.getElementById('reminderSuccess');
    
    reminderBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const expoId = this.dataset.expoId;
            document.getElementById('reminderExpoId').value = expoId;
            reminderModal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            reminderSuccess.style.display = 'none';
            reminderForm.style.display = 'block';
        });
    });
    
    closeReminderModal.addEventListener('click', function() {
        reminderModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
    
    reminderForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const loader = document.getElementById('reminderLoader');
        const submitBtn = this.querySelector('button[type="submit"]');
        
        // Show loading state
        submitBtn.disabled = true;
        loader.style.display = 'block';
        this.querySelector('.btn-text').style.opacity = '0';
        
        // Simulate AJAX submission
        setTimeout(() => {
            // Show success message
            reminderForm.style.display = 'none';
            reminderSuccess.style.display = 'block';
            
            // Reset form
            this.reset(); 
            
            // Reset button
            submitBtn.disabled = false;
            loader.style.display = 'none';
            this.querySelector('.btn-text').style.opacity = '1';
        }, 1500);
    });

    // Scroll to content
    document.querySelector('.hero-scroll-indicator').addEventListener('click', function() {
        document.querySelector('.current-exhibitions').scrollIntoView({
            behavior: 'smooth'
        });
    });

    // Animate elements on scroll
    const animateOnScroll = function() {
        const elements = document.querySelectorAll('.expo-slide, .upcoming-card, .past-card, .virtual-tour-cta');
        
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
<?php $this->stop() ?>