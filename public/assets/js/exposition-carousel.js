class ExpositionCarousel {
    constructor(containerId, options = {}) {
        this.container = document.getElementById(containerId);
        if (!this.container) return;

        // Default options
        this.options = {
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 5000,
            infinite: true,
            arrows: true,
            dots: false,
            responsive: [],
            ...options
        };

        this.slides = this.container.querySelectorAll('.expo-slide');
        this.currentIndex = 0;
        this.isDragging = false;
        this.startPos = 0;
        this.currentTranslate = 0;
        this.prevTranslate = 0;
        this.animationId = 0;
        this.autoplayInterval = null;

        // Initialize
        this.setupCarousel();
        this.setupEvents();
        this.setupResponsive();
        
        if (this.options.autoplay) {
            this.startAutoplay();
        }
    }

    setupCarousel() {
        this.container.style.overflow = 'hidden';
        this.slides.forEach(slide => {
            slide.style.minWidth = `${100 / this.options.slidesToShow}%`;
            slide.style.userSelect = 'none';
        });

        this.track = document.createElement('div');
        this.track.className = 'expo-carousel-track';
        this.track.style.display = 'flex';
        this.track.style.transition = 'transform 0.5s ease-out';
        this.container.insertBefore(this.track, this.slides[0]);
        
        while (this.slides.length > 0) {
            this.track.appendChild(this.slides[0]);
        }

        // Clone slides for infinite effect
        if (this.options.infinite) {
            const clonesStart = Array.from(this.track.children).slice(0, this.options.slidesToShow).map(el => el.cloneNode(true));
            const clonesEnd = Array.from(this.track.children).slice(-this.options.slidesToShow).map(el => el.cloneNode(true));
            
            clonesEnd.forEach(clone => this.track.insertBefore(clone, this.track.firstChild));
            clonesStart.forEach(clone => this.track.appendChild(clone));
        }

        this.slides = this.track.querySelectorAll('.expo-slide');
        this.updateTrack();
    }

    setupEvents() {
        // Mouse/touch events
        this.track.addEventListener('mousedown', this.startDrag.bind(this));
        this.track.addEventListener('touchstart', this.startDrag.bind(this), { passive: false });
        
        window.addEventListener('mousemove', this.drag.bind(this));
        window.addEventListener('touchmove', this.drag.bind(this), { passive: false });
        
        window.addEventListener('mouseup', this.endDrag.bind(this));
        window.addEventListener('touchend', this.endDrag.bind(this));
        window.addEventListener('mouseleave', this.endDrag.bind(this));

        // Arrow navigation
        if (this.options.arrows) {
            this.prevArrow = document.createElement('button');
            this.prevArrow.className = 'expo-carousel-arrow expo-carousel-prev';
            this.prevArrow.innerHTML = '&larr;';
            this.prevArrow.addEventListener('click', () => this.prev());
            
            this.nextArrow = document.createElement('button');
            this.nextArrow.className = 'expo-carousel-arrow expo-carousel-next';
            this.nextArrow.innerHTML = '&rarr;';
            this.nextArrow.addEventListener('click', () => this.next());
            
            this.container.appendChild(this.prevArrow);
            this.container.appendChild(this.nextArrow);
        }

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') this.prev();
            if (e.key === 'ArrowRight') this.next();
        });
    }

    setupResponsive() {
        const handleResize = () => {
            const newSlidesToShow = this.getSlidesToShow();
            if (newSlidesToShow !== this.options.slidesToShow) {
                this.options.slidesToShow = newSlidesToShow;
                this.slides.forEach(slide => {
                    slide.style.minWidth = `${100 / this.options.slidesToShow}%`;
                });
                this.updateTrack();
            }
        };

        window.addEventListener('resize', handleResize);
        handleResize();
    }

    getSlidesToShow() {
        if (!this.options.responsive) return this.options.slidesToShow;
        
        const width = window.innerWidth;
        let slidesToShow = this.options.slidesToShow;
        
        this.options.responsive.forEach(breakpoint => {
            if (width >= breakpoint.breakpoint && breakpoint.settings.slidesToShow > slidesToShow) {
                slidesToShow = breakpoint.settings.slidesToShow;
            }
        });
        
        return slidesToShow;
    }

    startDrag(e) {
        e.preventDefault();
        e.stopPropagation();
        
        this.isDragging = true;
        this.startPos = this.getPositionX(e);
        this.track.style.transition = 'none';
        
        this.animationId = requestAnimationFrame(this.animation.bind(this));
    }

    drag(e) {
        if (!this.isDragging) return;
        e.preventDefault();
        
        const currentPosition = this.getPositionX(e);
        this.currentTranslate = this.prevTranslate + currentPosition - this.startPos;
    }

    endDrag() {
        if (!this.isDragging) return;
        this.isDragging = false;
        cancelAnimationFrame(this.animationId);
        
        const movedBy = this.currentTranslate - this.prevTranslate;
        this.track.style.transition = 'transform 0.5s ease-out';
        
        if (movedBy < -100 && this.currentIndex < this.slides.length - this.options.slidesToShow) {
            this.next();
        } else if (movedBy > 100 && this.currentIndex > 0) {
            this.prev();
        } else {
            this.updateTrack();
        }
    }

    getPositionX(e) {
        return e.type.includes('mouse') ? e.pageX : e.touches[0].clientX;
    }

    animation() {
        this.track.style.transform = `translateX(${this.currentTranslate}px)`;
        this.animationId = requestAnimationFrame(this.animation.bind(this));
    }

    next() {
        if (this.currentIndex >= this.slides.length - this.options.slidesToShow && !this.options.infinite) return;
        
        this.currentIndex++;
        if (this.options.infinite && this.currentIndex > this.slides.length - this.options.slidesToShow) {
            this.currentIndex = 0;
        }
        this.updateTrack();
    }

    prev() {
        if (this.currentIndex <= 0 && !this.options.infinite) return;
        
        this.currentIndex--;
        if (this.options.infinite && this.currentIndex < 0) {
            this.currentIndex = this.slides.length - this.options.slidesToShow;
        }
        this.updateTrack();
    }

    goTo(index) {
        if (index < 0 || index > this.slides.length - this.options.slidesToShow) return;
        this.currentIndex = index;
        this.updateTrack();
    }

    updateTrack() {
        const slideWidth = this.container.clientWidth / this.options.slidesToShow;
        const newTranslate = -this.currentIndex * slideWidth;
        
        this.currentTranslate = newTranslate;
        this.prevTranslate = newTranslate;
        this.track.style.transform = `translateX(${newTranslate}px)`;
        
        // Handle infinite loop transition end
        const handleTransitionEnd = () => {
            if (this.options.infinite) {
                if (this.currentIndex === 0) {
                    this.currentIndex = this.slides.length - this.options.slidesToShow * 2;
                    this.track.style.transition = 'none';
                    this.updateTrack();
                    setTimeout(() => {
                        this.track.style.transition = 'transform 0.5s ease-out';
                    }, 50);
                } else if (this.currentIndex === this.slides.length - this.options.slidesToShow) {
                    this.currentIndex = this.options.slidesToShow;
                    this.track.style.transition = 'none';
                    this.updateTrack();
                    setTimeout(() => {
                        this.track.style.transition = 'transform 0.5s ease-out';
                    }, 50);
                }
            }
            this.track.removeEventListener('transitionend', handleTransitionEnd);
        };
        
        this.track.addEventListener('transitionend', handleTransitionEnd);
    }

    startAutoplay() {
        this.autoplayInterval = setInterval(() => {
            this.next();
        }, this.options.autoplaySpeed);
        
        this.container.addEventListener('mouseenter', () => {
            clearInterval(this.autoplayInterval);
        });
        
        this.container.addEventListener('mouseleave', () => {
            this.startAutoplay();
        });
    }

    destroy() {
        clearInterval(this.autoplayInterval);
        window.removeEventListener('resize', this.setupResponsive);
        // Remove all event listeners and clean up
    }
}

// Initialize carousels on page load
document.addEventListener('DOMContentLoaded', function() {
    const currentExpoCarousel = new ExpositionCarousel('currentExpoSlider', {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        arrows: true,
        dots: false,
        autoplay: true,
        autoplaySpeed: 5000,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                    arrows: false,
                    dots: true
                }
            }
        ]
    });
});