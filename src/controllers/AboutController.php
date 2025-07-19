<?php
namespace MuseeVirtuel\Controllers;

use MuseeVirtuel\Core\Controller;

class AboutController extends Controller {
    public function index() {
        $this->loadModel('Team');
        
        $data = [
            'teamMembers' => $this->model->getAll(),
            'timelineEvents' => $this->model->getTimeline(), 
            'partners' => $this->model->getPartners(),
            'page_css' => ['about.css', 'timeline.css', 'team.css'],
            'page_js' => ['timeline.js', 'team-carousel.js']
        ];
        
        $this->render('about/index', $data);
    }
}