<?php
namespace MuseeVirtuel\Controllers;
use MuseeVirtuel\Core\Controller;

class ExpositionController extends Controller {
    public function index() {
        $this->loadModel('Exposition');
        
        // Incrémenter les vues pour les stats
        if (!isset($_SESSION['expo_views'])) {
            $_SESSION['expo_views'] = [];
        }
        
        $data = [
            'currentExhibitions' => $this->model->getCurrent(),
            'upcomingExhibitions' => $this->model->getUpcoming(),
            'pastExhibitions' => $this->model->getPast(),
            'exhibitionYears' => $this->model->getExhibitionYears(),
            'page_css' => ['expositions.css', 'gallery.css'],
            'page_js' => ['exposition-carousel.js']
        ];
        
        $this->render('exposition/index', $data);
    }

    public function setReminder() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->loadModel('Exposition');
            $result = $this->model->setReminder(
                $_POST['exhibition_id'],
                $_POST['email']
            );
            echo json_encode(['success' => $result]);
            exit;
        }
    }
}