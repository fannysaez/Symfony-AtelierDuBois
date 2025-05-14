/**
 * Validation du formulaire de contact
 * 
 * Ce script implémente:
 * - Validation JavaScript pour tous les champs du formulaire
 * - Affichage des messages d'erreur
 * - Simulation d'envoi avec message de confirmation
 * - Bonnes pratiques de sécurité (OWASP)
 */

document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.querySelector('.contact form');
    
    if (contactForm) {
        contactForm.addEventListener('submit', validateAndSubmit);
        
        // Amélioration de l'expérience utilisateur avec validation en temps réel
        const inputs = contactForm.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            // Styles des champs de formulaire pour correspondre au design
            input.style.padding = '10px';
            input.style.borderRadius = '4px';
            input.style.border = '1px solid var(--color-dark, #333)';
            input.style.width = '100%';
            input.style.fontFamily = 'var(--font-bdo)';
        });
        
        // Styliser le bouton
        const submitButton = contactForm.querySelector('button[type="submit"]');
        if (submitButton && submitButton.classList.contains('btn-primary')) {
            submitButton.style.transition = 'all 0.3s';
        }
    }
    
    // Fonction pour valider et soumettre le formulaire
    function validateAndSubmit(event) {
        event.preventDefault();
        
        // Récupération des champs
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const messageInput = document.getElementById('message');
        
        // Réinitialiser les messages d'erreur précédents
        removeAllErrors();
        
        // Effectuer toutes les validations
        const isNameValid = validateName(nameInput);
        const isEmailValid = validateEmail(emailInput);
        const isMessageValid = validateMessage(messageInput);
        
        // Si tout est valide, simuler l'envoi
        if (isNameValid && isEmailValid && isMessageValid) {
            simulateFormSubmission(contactForm);
        }
    }
    
    // Validation d'un champ spécifique
    function validateField(input) {
        const inputId = input.id;
        
        switch(inputId) {
            case 'name':
                validateName(input);
                break;
            case 'email':
                validateEmail(input);
                break;
            case 'message':
                validateMessage(input);
                break;
        }
    }
    
    // Validation du nom
    function validateName(input) {
        if (!input.value.trim()) {
            showError(input, 'Le nom est obligatoire');
            return false;
        }
        return true;
    }
    
    // Validation de l'email avec regex
    function validateEmail(input) {
        const email = input.value.trim();
        
        if (!email) {
            showError(input, 'L\'email est obligatoire');
            return false;
        }
        
        // Regex pour validation d'email
        const emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        
        if (!emailRegex.test(email)) {
            showError(input, 'Veuillez saisir une adresse email valide');
            return false;
        }
        
        return true;
    }
    
    // Validation du message
    function validateMessage(input) {
        if (!input.value.trim()) {
            showError(input, 'Le message est obligatoire');
            return false;
        }
        
        // Vérification de longueur minimale
        if (input.value.trim().length < 10) {
            showError(input, 'Le message doit contenir au moins 10 caractères');
            return false;
        }
        
        return true;
    }
    
    // Affichage des erreurs
    function showError(input, message) {
        // Suppression des erreurs précédentes
        removeError(input);
        
        // Création du message d'erreur
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.textContent = message;
        errorDiv.style.color = 'var(--color-error, #ff3333)';
        errorDiv.style.fontSize = 'var(--font-size-small, 0.9rem)';
        errorDiv.style.marginTop = '5px';
        errorDiv.style.fontFamily = 'var(--font-bdo)';
        errorDiv.style.transition = 'all 0.3s';
        
        // Ajout de la classe d'erreur à l'input
        input.classList.add('input-error');
        input.style.borderColor = 'var(--color-error, #ff3333)';
        
        // Insertion du message après l'input
        input.parentNode.appendChild(errorDiv);
    }
    
    // Suppression d'une erreur spécifique
    function removeError(input) {
        const parent = input.parentNode;
        const existingError = parent.querySelector('.error-message');
        
        if (existingError) {
            parent.removeChild(existingError);
        }
        
        input.classList.remove('input-error');
        input.style.borderColor = '';
    }
    
    // Suppression de toutes les erreurs
    function removeAllErrors() {
        const errors = document.querySelectorAll('.error-message');
        errors.forEach(error => error.parentNode.removeChild(error));
        
        const inputs = document.querySelectorAll('.input-error');
        inputs.forEach(input => {
            input.classList.remove('input-error');
            input.style.borderColor = '';
        });
    }
    
    // Simulation d'envoi du formulaire
    function simulateFormSubmission(form) {
        // Désactiver les champs pendant la "soumission"
        const inputs = form.querySelectorAll('input, textarea, button');
        inputs.forEach(input => input.disabled = true);
        
        // Changement du texte du bouton
        const submitButton = form.querySelector('button[type="submit"]');
        const originalButtonText = submitButton.textContent;
        submitButton.textContent = 'Envoi en cours...';
        
        // Simuler un délai d'envoi
        setTimeout(() => {
            // Créer et afficher le message de confirmation
            displayConfirmationMessage(form);
            
            // Réinitialiser le formulaire
            form.reset();
            
            // Réactiver les champs
            inputs.forEach(input => input.disabled = false);
            submitButton.textContent = originalButtonText;
        }, 1500);
    }
    
    // Affichage du message de confirmation
    function displayConfirmationMessage(form) {
        // Création du conteneur de message
        const messageContainer = document.createElement('div');
        messageContainer.className = 'confirmation-message';
        messageContainer.style.backgroundColor = 'var(--color-light, #dff0d8)';
        messageContainer.style.color = 'var(--color-dark)';
        messageContainer.style.padding = '15px';
        messageContainer.style.borderRadius = '4px';
        messageContainer.style.marginTop = '20px';
        messageContainer.style.marginBottom = '20px';
        messageContainer.style.width = '100%';
        messageContainer.style.textAlign = 'center';
        messageContainer.style.fontFamily = 'var(--font-bdo)';
        messageContainer.style.transition = 'all 0.3s';
        messageContainer.style.opacity = '0';
        
        // Message de confirmation
        messageContainer.innerHTML = `
            <h3 style="margin-top: 0;">Message envoyé avec succès!</h3>
            <p>Nous vous répondrons dans les plus brefs délais.</p>
        `;
        
        // Insertion du message avant le formulaire
        form.parentNode.insertBefore(messageContainer, form);
        
        // Forcer le reflow pour permettre la transition
        messageContainer.offsetHeight;
        
        // Afficher avec transition
        messageContainer.style.opacity = '1';
        
        // Faire défiler jusqu'au message
        messageContainer.scrollIntoView({ behavior: 'smooth' });
        
        // Suppression automatique après un certain temps
        setTimeout(() => {
            if (messageContainer.parentNode) {
                messageContainer.style.opacity = '0';
                setTimeout(() => {
                    if (messageContainer.parentNode) {
                        messageContainer.parentNode.removeChild(messageContainer);
                    }
                }, 300); // Durée de la transition
            }
        }, 5700); // 6000 - 300 pour la transition
    }
    
    // --- Section sécurité OWASP ---
    
    /**
     * Bonnes pratiques de sécurité front-end (OWASP):
     * 
     * 1. Validation des données côté client (implémentée ci-dessus)
     *    - N'est qu'une première ligne de défense
     *    - Ne remplace pas la validation côté serveur
     * 
     * 2. Échappement des données:
     *    - Les entrées utilisateur doivent être échappées avant affichage
     *    - Protège contre les attaques XSS (Cross-Site Scripting)
     *    
     * 3. Protection CSRF:
     *    - Le formulaire réel devrait inclure un token CSRF côté serveur
     *    - Protège contre les attaques Cross-Site Request Forgery
     * 
     * 4. Limitation de tentatives:
     *    - Limiter le nombre de soumissions de formulaire
     *    - Protège contre les attaques par force brute
     * 
     * 5. Pas de données sensibles en clair:
     *    - Ne pas stocker/afficher de données sensibles dans le localStorage/sessionStorage
     * 
     * 6. Sanitization des entrées:
     *    - Nettoyage des entrées utilisateur pour éviter les injections
     */
    
    // Exemple d'échappement HTML pour prévenir XSS
    function escapeHTML(str) {
        return str
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }
});