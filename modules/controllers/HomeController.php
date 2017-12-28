<?php

use \modules\controllers\MainController;

class HomeController extends MainController {

    public function index() {

        $data = isset($_SESSION["ctfplat_usession"]) ? $_SESSION["ctfplat_usession"] : '';
        

        $this->model('user');
        $this->model('solves');
        $this->model('challenges');
        $this->template('home', array('userData' => $data, 'total' => array(

            'user' => $this->user->rows(),
            'solves' => $this->solves->rows(),
            'challenges' => $this->challenges->rows()

        )));
        
    }
}
?>