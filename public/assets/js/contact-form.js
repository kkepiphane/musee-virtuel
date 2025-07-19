document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    if (!contactForm) return;

    // Validation en temps réel
    contactForm.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('input', function() {
            validateField(this);
        });
    });

    // Soumission du formulaire
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (validateForm()) {
            submitForm();
        } else {
            contactForm.classList.add('form-submit-error');
            setTimeout(() => {
                contactForm.classList.remove('form-submit-error');
            }, 600);
        }
    });

    // Fonction de validation
    function validateField(field) {
        let isValid = true;
        const value = field.value.trim();
        const feedback = field.nextElementSibling;

        // Reset
        field.classList.remove('is-invalid', 'is-valid');
        if (feedback) feedback.textContent = '';

        // Validation requise
        if (field.required && !value) {
            isValid = false;
            setInvalid(field, 'Ce champ est obligatoire');
        }

        // Validation email
        if (field.type === 'email' && value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                isValid = false;
                setInvalid(field, 'Veuillez entrer un email valide');
            }
        }

        // Validation téléphone
        if (field.type === 'tel' && value) {
            const phoneRegex = /^[0-9\-\+\s\(\)]{10,20}$/;
            if (!phoneRegex.test(value)) {
                isValid = false;
                setInvalid(field, 'Format de téléphone invalide');
            }
        }

        if (isValid && value) {
            field.classList.add('is-valid');
        }

        return isValid;
    }

    function setInvalid(field, message) {
        field.classList.add('is-invalid');
        const feedback = field.nextElementSibling;
        if (feedback && feedback.classList.contains('invalid-feedback')) {
            feedback.textContent = message;
        }
    }

    function validateForm() {
        let isValid = true;
        const requiredFields = contactForm.querySelectorAll('[required]');

        requiredFields.forEach(field => {
            if (!validateField(field)) {
                isValid = false;
            }
        });

        return isValid;
    }

    function submitForm() {
        const submitBtn = contactForm.querySelector('[type="submit"]');
        const formData = new FormData(contactForm);

        // Afficher le loader
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;

        // Simuler un envoi AJAX (remplacer par une vraie requête fetch)
        setTimeout(() => {
            // Réussite simulée
            submitBtn.classList.remove('loading');
            submitBtn.disabled = false;

            // Afficher le message de succès
            const successMessage = document.createElement('div');
            successMessage.className = 'alert alert-success mt-4';
            successMessage.innerHTML = `
                <i class="fas fa-check-circle"></i>
                Votre message a bien été envoyé. Nous vous répondrons dans les plus brefs délais.
            `;
            contactForm.reset();
            contactForm.appendChild(successMessage);

            // Supprimer le message après 5s
            setTimeout(() => {
                successMessage.remove();
            }, 5000);

        }, 1500);
    }

    // Initialisation du sélecteur de département
    const departmentSelect = contactForm.querySelector('#contactDepartment');
    if (departmentSelect) {
        departmentSelect.addEventListener('change', function() {
            const emailField = contactForm.querySelector('#contactEmail');
            if (this.value === 'technical') {
                emailField.placeholder = 'email@votredomaine.com (pour vérification)';
            } else {
                emailField.placeholder = 'email@exemple.com';
            }
        });
    }
});