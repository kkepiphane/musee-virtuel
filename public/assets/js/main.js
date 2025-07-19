// Animation d'entrée premium
document.addEventListener('DOMContentLoaded', function() {
    // Création de l'overlay d'animation
    const pageLoadOverlay = document.createElement('div');
    pageLoadOverlay.className = 'page-load-overlay';
    pageLoadOverlay.innerHTML = `
        <div class="pl-animation-container">
            <div class="pl-logo">
                <svg viewBox="0 0 48 48">
                    <path class="pl-path-1" d="M24 6L6 24l18 18 18-18z" fill="none" stroke="#3a506b" stroke-width="4"/>
                    <path class="pl-path-2" d="M24 6v36" stroke="#5bc0be" stroke-width="4"/>
                    <path class="pl-path-3" d="M42 24H6" stroke="#5bc0be" stroke-width="4"/>
                    <circle class="pl-circle" cx="24" cy="24" r="4" fill="#e63946"/>
                </svg>
            </div>
            <div class="pl-progress">
                <div class="pl-progress-bar"></div>
            </div>
        </div>
    `;
    document.body.appendChild(pageLoadOverlay);

    // Animation de chargement
    setTimeout(() => {
        pageLoadOverlay.classList.add('animate');
        
        // Simuler un chargement complet (remplacer par window.onload en production)
        setTimeout(() => {
            pageLoadOverlay.classList.add('complete');
            
            // Supprimer l'overlay après l'animation
            setTimeout(() => {
                pageLoadOverlay.remove();
            }, 1000);
        }, 2000);
    }, 100);
});

// Bouton retour en haut premium
const backToTopBtn = document.createElement('button');
backToTopBtn.className = 'back-to-top-btn';
backToTopBtn.innerHTML = `
    <svg viewBox="0 0 24 24" class="back-to-top-icon">
        <path d="M12 4l-8 8h5v8h6v-8h5z"/>
    </svg>
    <span class="back-to-top-text">Haut de page</span>
`;
document.body.appendChild(backToTopBtn);

// Affichage conditionnel
window.addEventListener('scroll', () => {
    if (window.pageYOffset > 300) {
        backToTopBtn.classList.add('show');
    } else {
        backToTopBtn.classList.remove('show');
    }
});

// Animation de retour
backToTopBtn.addEventListener('click', (e) => {
    e.preventDefault();
    
    // Animation fluide
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
    
    // Effet de clic
    backToTopBtn.classList.add('clicked');
    setTimeout(() => {
        backToTopBtn.classList.remove('clicked');
    }, 300);
});

// Animation d'entrée différée
setTimeout(() => {
    backToTopBtn.classList.add('loaded');
}, 1500);

// Transition entre les pages
document.addEventListener('DOMContentLoaded', function() {
    const allLinks = document.querySelectorAll('a:not([target="_blank"]):not([href^="#"]):not([href^="mailto"]):not([href^="tel"])');
    
    allLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            if (this.href && this.href.includes(window.location.hostname)) {
                e.preventDefault();
                const destination = this.href;
                
                // Créer l'overlay de transition
                const transitionOverlay = document.createElement('div');
                transitionOverlay.className = 'page-transition-overlay';
                document.body.appendChild(transitionOverlay);
                
                // Animation d'entrée
                setTimeout(() => {
                    transitionOverlay.classList.add('active');
                    
                    // Redirection après l'animation
                    setTimeout(() => {
                        window.location.href = destination;
                    }, 800);
                }, 50);
            }
        });
    });
});