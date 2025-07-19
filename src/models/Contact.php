<?php
namespace MuseeVirtuel\Models;

use MuseeVirtuel\Config\Database;
use MuseeVirtuel\Core\Security;

class Contact {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Traite la soumission du formulaire de contact
     */
    public function processForm(array $data): array {
        // Validation
        $errors = $this->validateForm($data);
        
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        // Enregistrement en base
        $stmt = $this->db->prepare("
            INSERT INTO contact_submissions 
            (name, email, subject, department, message, ip_address, user_agent, consent_given)
            VALUES (:name, :email, :subject, :department, :message, :ip, :ua, :consent)
        ");

        $success = $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':subject' => $data['subject'],
            ':department' => $data['department'],
            ':message' => $data['message'],
            ':ip' => $_SERVER['REMOTE_ADDR'],
            ':ua' => $_SERVER['HTTP_USER_AGENT'],
            ':consent' => isset($data['consent']) ? 1 : 0
        ]);

        // Envoi d'email (à implémenter)
        if ($success) {
            $this->sendNotificationEmail($data);
        }

        return ['success' => $success, 'submission_id' => $this->db->lastInsertId()];
    }

    /**
     * Récupère les FAQs actives
     */
    public function getFaqs(): array {
        $stmt = $this->db->prepare("
            SELECT  
                id,
                question,
                answer
            FROM faqs
            WHERE is_active = 1
            ORDER BY display_order ASC, id ASC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Récupère les informations de contact du musée
     */
    public function getContactInfo(): array {
        $stmt = $this->db->prepare("
            SELECT 
                address,
                phone,
                email,
                opening_hours,
                map_iframe_code,
                social_links
            FROM museum_contact_info
            LIMIT 1
        ");
        $stmt->execute();
        return $stmt->fetch() ?: [];
    }

    /**
     * Récupère les départements de contact
     */
    public function getDepartments(): array {
        $stmt = $this->db->prepare("
            SELECT 
                slug,
                name,
                email,
                description
            FROM contact_departments
            WHERE is_active = 1
            ORDER BY display_order ASC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    private function validateForm(array $data): array {
        $errors = [];

        if (empty($data['name'])) {
            $errors['name'] = 'Le nom est obligatoire';
        }

        if (empty($data['email'])) {
            $errors['email'] = 'L\'email est obligatoire';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email invalide';
        }

        if (empty($data['subject'])) {
            $errors['subject'] = 'Le sujet est obligatoire';
        }

        if (empty($data['department'])) {
            $errors['department'] = 'Veuillez sélectionner un service';
        }

        if (empty($data['message'])) {
            $errors['message'] = 'Le message est obligatoire';
        } elseif (strlen($data['message']) < 20) {
            $errors['message'] = 'Le message doit contenir au moins 20 caractères';
        }

        if (empty($data['consent'])) {
            $errors['consent'] = 'Vous devez accepter notre politique de confidentialité';
        }

        // Validation CSRF
        if (!Security::verifyCsrfToken($data['csrf_token'] ?? '')) {
            $errors['csrf'] = 'Erreur de sécurité. Veuillez rafraîchir la page.';
        }

        return $errors;
    }

    private function sendNotificationEmail(array $data): bool {
        // Implémentation de l'envoi d'email
        // Utiliser PHPMailer ou la fonction mail() de PHP
        return true; // Temporaire
    }
}