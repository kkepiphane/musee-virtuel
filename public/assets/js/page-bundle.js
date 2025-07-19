/**
 * Page Bundle JS - Main functionality for the exposition page
 * Includes: Back to top button, 3D preview initialization, gallery interactions
 */

document.addEventListener("DOMContentLoaded", function () {
  // Back to Top Button
  const backToTopBtn = document.createElement("button");
  backToTopBtn.className = "back-to-top-btn";
  backToTopBtn.innerHTML = `
        <svg class="back-to-top-icon" viewBox="0 0 24 24">
            <path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/>
        </svg>
        <span class="back-to-top-text">Back to Top</span>
    `;
  document.body.appendChild(backToTopBtn);

  // Show/hide back to top button
  window.addEventListener("scroll", function () {
    if (window.pageYOffset > 300) {
      backToTopBtn.classList.add("show");
    } else {
      backToTopBtn.classList.remove("show");
    }
  });

  // Smooth scroll to top
  backToTopBtn.addEventListener("click", function (e) {
    e.preventDefault();
    this.classList.add("clicked");
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
    setTimeout(() => this.classList.remove("clicked"), 300);
  });

  // Initialize 3D Preview if container exists
  if (document.getElementById("virtualTourContainer")) {
    const virtualTour = new ThreeDPreview("virtualTourContainer", {
      modelPath: "/models/exposition-scene.glb",
      backgroundColor: 0xeeeeee,
      autoRotate: true,
      autoRotateSpeed: 0.5,
      cameraPosition: { x: 0, y: 1.5, z: 8 },
    });
  }

  // Gallery Lightbox
  const galleryItems = document.querySelectorAll(".artwork-card");
  const lightbox = document.createElement("div");
  lightbox.className = "lightbox";
  lightbox.innerHTML = `
        <button class="close-lightbox">&times;</button>
        <div class="lightbox-container">
            <div class="lightbox-content">
                <div class="lightbox-image-container">
                    <img src="" alt="" class="lightbox-image">
                    <div class="image-nav">
                        <button class="nav-btn prev-btn">&larr;</button>
                        <button class="nav-btn next-btn">&rarr;</button>
                    </div>
                </div>
                <div class="lightbox-info">
                    <h2 class="lightbox-title"></h2>
                    <p class="artist"></p>
                    <p class="date"></p>
                    <p class="medium"></p>
                    <p class="dimensions"></p>
                    <p class="location"></p>
                    <p class="description"></p>
                    <div class="lightbox-actions">
                        <button class="like-btn">
                            <i class="fas fa-heart"></i> Like
                        </button>
                        <button class="share-btn">
                            <i class="fas fa-share-alt"></i> Share
                        </button>
                        <button class="download-btn">
                            <i class="fas fa-download"></i> Download
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
  document.body.appendChild(lightbox);

  let currentIndex = 0;

  galleryItems.forEach((item, index) => {
    item.addEventListener("click", () => {
      currentIndex = index;
      openLightbox();
    });
  });

  function openLightbox() {
    const item = galleryItems[currentIndex];
    const imgElement = item.querySelector("img");

    if (!imgElement) {
      console.error("Aucune image trouvée dans l'élément galleryItem");
      return;
    }

    const imgSrc = imgElement.src;
    const artworkData = item.dataset;

    console.log("Données de l'œuvre:", artworkData); // Debug

    // Mise à jour de la lightbox
    const lightboxElements = {
      ".lightbox-image": { src: imgSrc },
      ".lightbox-title": { textContent: artworkData.title || "Titre inconnu" },
      ".artist": {
        textContent: `Artiste: ${artworkData.artist || "Artiste inconnu"}`,
      },
      ".date": { textContent: `Date: ${artworkData.date || "Date inconnue"}` },
      ".medium": {
        textContent: `Technique: ${artworkData.medium || "Non spécifiée"}`,
      },
      ".dimensions": {
        textContent: `Dimensions: ${
          artworkData.dimensions || "Non spécifiées"
        }`,
      },
      ".location": {
        textContent: `Localisation: ${artworkData.location || "Musée Virtuel"}`,
      },
      ".description": {
        textContent: artworkData.description || "Aucune description disponible",
      },
    };

    Object.entries(lightboxElements).forEach(([selector, props]) => {
      const element = lightbox.querySelector(selector);
      if (element) {
        Object.assign(element, props);
      } else {
        console.warn(`Élément ${selector} non trouvé dans la lightbox`);
      }
    });

    lightbox.style.display = "flex";
    document.body.style.overflow = "hidden";
  }

  lightbox.addEventListener("click", function (e) {
    if (
      e.target.classList.contains("close-lightbox") ||
      e.target === lightbox
    ) {
      closeLightbox();
    }
  });
  lightbox.querySelector(".prev-btn").addEventListener("click", () => {
    currentIndex =
      (currentIndex - 1 + galleryItems.length) % galleryItems.length;
    openLightbox();
  });
  lightbox.querySelector(".next-btn").addEventListener("click", () => {
    currentIndex = (currentIndex + 1) % galleryItems.length;
    openLightbox();
  });

  function closeLightbox() {
    lightbox.style.display = "none";
    document.body.style.overflow = "auto";
  }

  // Page Transition
  const links = document.querySelectorAll('a[href^="/"]');
  const transitionOverlay = document.createElement("div");
  transitionOverlay.className = "page-transition-overlay";
  document.body.appendChild(transitionOverlay);

  links.forEach((link) => {
    link.addEventListener("click", function (e) {
      if (this.href === window.location.href) return;

      e.preventDefault();
      const href = this.href;

      transitionOverlay.classList.add("active");

      setTimeout(() => {
        window.location.href = href;
      }, 800);
    });
  });

  // Initialize carousel if exists
  if (document.querySelector(".expo-carousel")) {
    new ExpositionCarousel("expoCarousel", {
      slidesToShow: 3,
      slidesToScroll: 1,
      infinite: true,
      autoplay: true,
      responsive: [
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
          },
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
          },
        },
      ],
    });
  }
});
