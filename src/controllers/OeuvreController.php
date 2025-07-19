<?php
namespace MuseeVirtuel\Controllers;

use MuseeVirtuel\Core\Controller;

class OeuvreController {
    private $oeuvreModel;
    private $templates;

    public function __construct() {
        $this->oeuvreModel = new Oeuvre();
        $this->templates = require __DIR__ . '/../../config/template.php';
    }

    public function show($id) {
        $oeuvre = $this->oeuvreModel->findById($id);

        if (!$oeuvre) {
            header("HTTP/1.0 404 Not Found");
            echo $this->templates->render('errors/404');
            exit;
        }

        echo $this->templates->render('galerie/show', [
            'pageTitle' => $oeuvre->titre . ' | Musée Virtuel',
            'oeuvre' => $oeuvre
        ]);
    }
}