document.addEventListener('DOMContentLoaded', function() {
    // Initialisation des filtres
    const filterButtons = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');
    const selectFilters = document.querySelectorAll('.filter-select');

    // Filtrage par boutons
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filterValue = this.dataset.filter;
            
            // Mettre à jour l'état actif
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            // Appliquer le filtre
            filterGallery(filterValue);
        });
    });

    // Filtrage par selects
    selectFilters.forEach(select => {
        select.addEventListener('change', function() {
            const filterType = this.dataset.filterType;
            const filterValue = this.value;
            
            // Pour les selects, on peut soit recharger la page, soit filtrer en AJAX
            if (filterType === 'category') {
                filterGallery(filterValue);
            }
        });
    });

    // Fonction de filtrage
    function filterGallery(filterValue) {
        galleryItems.forEach(item => {
            const itemCategories = item.dataset.categories.split(' ');
            
            if (filterValue === 'all' || itemCategories.includes(filterValue)) {
                item.classList.remove('hidden');
            } else {
                item.classList.add('hidden');
            }
        });

        // Animation de réorganisation
        setTimeout(() => {
            const masonry = document.querySelector('.gallery-container');
            masonry.style.display = 'none';
            masonry.offsetHeight; // Trigger reflow
            masonry.style.display = '';
        }, 500);
    }

    // Initialisation Isotope (option avancée)
    if (typeof Isotope !== 'undefined') {
        initIsotope();
    }

    function initIsotope() {
        const iso = new Isotope('.gallery-container', {
            itemSelector: '.gallery-item',
            layoutMode: 'masonry',
            masonry: {
                columnWidth: '.gallery-sizer',
                gutter: '.gallery-gutter'
            },
            transitionDuration: '0.5s'
        });

        // Re-layout après le chargement des images
        imagesLoaded('.gallery-container').on('progress', function() {
            iso.layout();
        });
    }
});