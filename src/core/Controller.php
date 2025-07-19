<?php
namespace MuseeVirtuel\Core;

use League\Plates\Engine;


class Controller {
    protected $model;
    protected $view;

    public function __construct() {
        $this->initializeView();
    }

    protected function initializeView() {
        $viewsPath = realpath(__DIR__ . '/../../views');
        
        if (!$viewsPath) {
            throw new \RuntimeException("Views directory not found");
        }
        
        $this->view = new Engine($viewsPath);
        $this->configureView();
    }

    protected function configureView() {
        // Configuration de base
        $this->view->addData(['site_name' => 'Musée Virtuel']);
        
        // Fonction asset
        $this->view->registerFunction('asset', function ($path) {
            return '/public/assets/' . ltrim($path, '/');
        });
        
        // Ajoutez d'autres fonctions globales si nécessaire
    }



    protected function addAssets(array $css = [], array $js = [])
    {
        return [
            'page_css' => array_merge(['main.css', 'header-footer.css'], $css),
            'page_js' => array_merge(['main.js'], $js)
        ];
    }



    protected function render(string $viewPath, array $data = []) {
        if (!$this->view) {
            throw new \RuntimeException("View engine not initialized");
        }
        
        // Ajoute les assets par défaut
        $defaultAssets = $this->addAssets();
        $data = array_merge($data, $defaultAssets);
        
        echo $this->view->render($viewPath, $data);
    }
    
    protected function loadModel(string $modelName) {
        $modelClass = "MuseeVirtuel\\Models\\" . $modelName;
        
        if (class_exists($modelClass)) {
            $this->model = new $modelClass();
            return;
        }
        
        // Fallback manuel avec vérifications supplémentaires
        $modelPath = __DIR__ . '/../../../models/' . $modelName . '.php';
        
        if (!file_exists($modelPath)) {
            throw new \RuntimeException("Fichier modèle introuvable: $modelPath");
        }
        
        require_once $modelPath;
        
        if (!class_exists($modelClass)) {
            throw new \RuntimeException("La classe $modelClass n'a pas été trouvée dans $modelPath");
        }
        
        $this->model = new $modelClass();
    }

    protected function jsonResponse(array $data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    
    protected function redirect(string $url) {
        header("Location: $url");
        exit;
    }

    protected function handleError(int $code, string $message = '') {
        http_response_code($code);
        $this->render("errors/{$code}", ['message' => $message]);
        exit;
    }
}