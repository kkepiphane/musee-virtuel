<?php

namespace MuseeVirtuel\Controllers;

use MuseeVirtuel\Core\Controller;
use MuseeVirtuel\Core\Security;

class ContactController extends Controller
{

  public function index()
  {
    $this->loadModel('Contact');
    $data = [
      'departments' => [
        'General' => 'info@museevirtuel.com',
        'Technique' => 'support@museevirtuel.com',
        'Presse' => 'press@museeTéléphonevirtuel.com'
      ],
      'page_css' => ['contact.css', 'form-validation.css'],
      'page_js' => ['contact-form.js'],
      'faqs' => $this->model->getFaqs()
    ];
    $this->render('contact/index', $data);
  }

  public function submit()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->loadModel('contact');
      $result = $this->model->processForm($_POST);

      if ($result['success']) {
        $this->render('contact/success', $result);
      } else {
        $this->render('contact/index', [
          'errors' => $result['errors'],
          'formData' => $_POST
        ]);
      }
    }
  }
}
