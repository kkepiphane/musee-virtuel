<?php

$page_css = ['contact.css', 'form-validation.css'];
$page_js = ['contact-form.js'];

?>
<?php $this->layout('layouts/default', ['pageTitle' => 'Contact - Musée Virtuel', 'page_css' => $page_css, 'page_js' => $page_js]) ?>

<?php $this->start('main_content') ?>
<!-- Hero Contact -->
<section class="contact-hero">
    <div class="hero-background" style="background-image: url('<?= BASE_URL ?>/assets/images/header/pexels-pixabay-460736.jpg')"></div>
    <div class="hero-content">
        <h1>Contactez-<span class="highlight">nous</span></h1>
        <p>Nous sommes à votre écoute pour toute question ou demande d'information</p>
    </div>
</section>

<!-- Contact Grid -->
<section class="contact-grid">
    <!-- Contact Form -->
    <div class="contact-form-container">
        <h2>Envoyez-nous un message</h2>
        <p class="form-subtitle">Remplissez le formulaire ci-dessous et nous vous répondrons dans les plus brefs délais</p>
        
        <form id="contactForm" class="contact-form" novalidate>
        <input type="hidden" name="csrf_token" value="<?= \MuseeVirtuel\Core\Security::generateCsrfToken() ?>">
            
            <div class="form-group">
                <div class="input-group">
                    <input type="text" id="name" name="name" required>
                    <label for="name">Nom complet</label>
                    <div class="input-underline"></div>
                </div>
                <div class="error-message" id="nameError"></div>
            </div>
            
            <div class="form-group">
                <div class="input-group">
                    <input type="email" id="email" name="email" required>
                    <label for="email">Adresse email</label>
                    <div class="input-underline"></div>
                </div>
                <div class="error-message" id="emailError"></div>
            </div>
            
            <div class="form-group">
                <div class="input-group">
                    <input type="text" id="subject" name="subject" required>
                    <label for="subject">Sujet</label>
                    <div class="input-underline"></div>
                </div>
                <div class="error-message" id="subjectError"></div>
            </div>
            
            <div class="form-group">
                <div class="input-group">
                    <select id="department" name="department" required>
                        <option value=""></option>
                        <option value="general">Informations générales</option>
                        <option value="technical">Support technique</option>
                        <option value="partnerships">Partenariats</option>
                        <option value="press">Presse</option>
                        <option value="education">Service éducatif</option>
                    </select>
                    <label for="department">Service concerné</label>
                    <div class="input-underline"></div>
                </div>
                <div class="error-message" id="departmentError"></div>
            </div>
            
            <div class="form-group">
                <div class="input-group">
                    <textarea id="message" name="message" rows="5" required></textarea>
                    <label for="message">Votre message</label>
                    <div class="input-underline"></div>
                </div>
                <div class="error-message" id="messageError"></div>
            </div>
            
            <div class="form-group checkbox-group">
                <input type="checkbox" id="consent" name="consent" required>
                <label for="consent">J'accepte que mes données soient utilisées pour traiter ma demande (voir <a href="<?= url('privacy') ?>">politique de confidentialité</a>)</label>
                <div class="error-message" id="consentError"></div>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <span class="btn-text">Envoyer le message</span>
                    <div class="loader" id="formLoader"></div>
                </button>
            </div>
        </form>
        
        <div class="form-success" id="formSuccess">
            <div class="success-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                </svg>
            </div>
            <h3>Message envoyé avec succès !</h3>
            <p>Nous avons bien reçu votre demande et vous répondrons dans les plus brefs délais.</p>
            <button class="btn btn-outline" id="newMessageBtn">Nouveau message</button>
        </div>
    </div>
    
    <!-- Contact Info -->
    <div class="contact-info-container">
        <div class="contact-info-card">
            <h2>Coordonnées</h2>
            
            <div class="info-item">
                <div class="info-icon">
                    <i class="fa fa-location"></i>
                </div>
                <div class="info-content">
                    <h3>Adresse</h3>
                    <p>123 Avenue des Arts<br>75001 Paris, France</p>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-icon">
                    <i class="fa fa-phone"></i>
                </div>
                <div class="info-content">
                    <h3>Téléphone</h3>
                    <p>+33 1 23 45 67 89</p>
                    <p class="info-note">Du lundi au vendredi, 9h-18h</p>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-icon">
                    <i class="fa fa-envelope"></i>
                </div>
                <div class="info-content">
                    <h3>Email</h3>
                    <p>contact@museevirtuel.com</p>
                    <p class="info-note">Réponse sous 48h</p>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-icon">
                    <i class="fa fa-clock"></i>
                </div>
                <div class="info-content">
                    <h3>Horaires</h3>
                    <p>Lundi - Vendredi : 9h - 18h</p>
                    <p>Samedi : 10h - 17h</p>
                    <p>Dimanche : Fermé</p>
                </div>
            </div>
            
            <div class="social-links">
                <a href="#" class="social-link" aria-label="Twitter">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="social-link" aria-label="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="social-link" aria-label="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="social-link" aria-label="LinkedIn">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="#" class="social-link" aria-label="YouTube">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>
        
        <div class="contact-map" id="contactMap">
            <div class="map-placeholder">
                <div class="map-loader"></div>
                <p>Chargement de la carte...</p>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section">
    <div class="section-header">
        <h2>Questions fréquentes</h2>
        <p>Trouvez rapidement des réponses à vos interrogations</p>
    </div>
    
    <div class="faq-container">
        <?php foreach ($faqs as $index => $faq): ?>
        <div class="faq-item">
            <div class="faq-question">
                <h3><?= $this->escape($faq['question']) ?></h3>
                <div class="faq-toggle">
                    <span class="toggle-icon"></span>
                </div>
            </div>
            <div class="faq-answer">
                <p><?= $this->escape($faq['answer']) ?></p>
                <?php if(isset($faq['link'])): ?>
                <a href="<?= $faq['link'] ?>" class="faq-link">En savoir plus →</a>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <div class="faq-cta">
        <p>Vous ne trouvez pas la réponse à votre question ?</p>
        <a href="#contactForm" class="btn btn-primary">Contactez-nous</a>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form Validation
    const contactForm = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    const formLoader = document.getElementById('formLoader');
    const formSuccess = document.getElementById('formSuccess');
    
    // Input Animation
    const inputGroups = document.querySelectorAll('.input-group');
    inputGroups.forEach(group => {
        const input = group.querySelector('input, textarea, select');
        const label = group.querySelector('label');
        
        // Check for initial value
        if (input.value) {
            label.classList.add('active');
        }
        
        input.addEventListener('focus', () => {
            label.classList.add('active');
            group.querySelector('.input-underline').style.transform = 'scaleX(1)';
        });
        
        input.addEventListener('blur', () => {
            if (!input.value) {
                label.classList.remove('active');
            }
            group.querySelector('.input-underline').style.transform = 'scaleX(0)';
        });
        
        // For select elements
        if (input.tagName === 'SELECT') {
            input.addEventListener('change', () => {
                if (input.value) {
                    label.classList.add('active');
                } else {
                    label.classList.remove('active');
                }
            });
        }
    });
    
    // Form Submission
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validate form
        if (validateForm()) {
            submitForm();
        }
    });
    
    function validateForm() {
        let isValid = true;
        const name = document.getElementById('name');
        const email = document.getElementById('email');
        const subject = document.getElementById('subject');
        const department = document.getElementById('department');
        const message = document.getElementById('message');
        const consent = document.getElementById('consent');
        
        // Reset errors
        document.querySelectorAll('.error-message').forEach(el => {
            el.textContent = '';
        });
        
        // Name validation
        if (!name.value.trim()) {
            document.getElementById('nameError').textContent = 'Veuillez entrer votre nom';
            isValid = false;
        }
        
        // Email validation
        if (!email.value.trim()) {
            document.getElementById('emailError').textContent = 'Veuillez entrer votre email';
            isValid = false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
            document.getElementById('emailError').textContent = 'Veuillez entrer un email valide';
            isValid = false;
        }
        
        // Subject validation
        if (!subject.value.trim()) {
            document.getElementById('subjectError').textContent = 'Veuillez entrer un sujet';
            isValid = false;
        }
        
        // Department validation
        if (!department.value) {
            document.getElementById('departmentError').textContent = 'Veuillez sélectionner un service';
            isValid = false;
        }
        
        // Message validation
        if (!message.value.trim()) {
            document.getElementById('messageError').textContent = 'Veuillez entrer un message';
            isValid = false;
        } else if (message.value.trim().length < 20) {
            document.getElementById('messageError').textContent = 'Votre message doit contenir au moins 20 caractères';
            isValid = false;
        }
        
        // Consent validation
        if (!consent.checked) {
            document.getElementById('consentError').textContent = 'Vous devez accepter notre politique de confidentialité';
            isValid = false;
        }
        
        return isValid;
    }
    
    function submitForm() {
        // Show loading state
        submitBtn.disabled = true;
        document.querySelector('.btn-text').style.opacity = '0';
        formLoader.style.display = 'block';
        
        // Simulate AJAX submission (replace with actual fetch)
        setTimeout(() => {
            // Hide form, show success message
            contactForm.style.display = 'none';
            formSuccess.style.display = 'block';
            
            // Reset form
            contactForm.reset();
            document.querySelectorAll('.input-group label').forEach(label => {
                label.classList.remove('active');
            });
            
            // Reset button
            submitBtn.disabled = false;
            document.querySelector('.btn-text').style.opacity = '1';
            formLoader.style.display = 'none';
        }, 1500);
    }
    
    // New message button
    document.getElementById('newMessageBtn').addEventListener('click', function() {
        contactForm.style.display = 'block';
        formSuccess.style.display = 'none';
    });
    
    // FAQ Accordion
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
        
        question.addEventListener('click', () => {
            const isOpen = item.classList.contains('active');
            
            // Close all items
            faqItems.forEach(faq => {
                faq.classList.remove('active');
                faq.querySelector('.faq-answer').style.maxHeight = '0';
            });
            
            // Open current if not already open
            if (!isOpen) {
                item.classList.add('active');
                answer.style.maxHeight = answer.scrollHeight + 'px';
            }
        });
    });
    
    // Initialize map (using Leaflet.js)
    function initMap() {
        const mapContainer = document.getElementById('contactMap');
        mapContainer.innerHTML = '';
        
        // This would be replaced with actual Leaflet or Google Maps initialization
        mapContainer.innerHTML = `
            <div class="map-frame">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.9916256937595!2d2.292292615509614!3d48.858370079287475!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e2964e34e2d%3A0x8ddca9ee380ef7e0!2sTour%20Eiffel!5e0!3m2!1sen!2sfr!4v1620000000000!5m2!1sen!2sfr" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        `;
    }
    
    // Load map after a short delay
    setTimeout(initMap, 1000);
});
</script>
<?php $this->stop() ?>