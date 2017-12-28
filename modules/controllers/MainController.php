<?php
/**
 * @Author  : Subraga Islammada <subraga.9310@students.amikom.ac.id>
 * @Date    : 12/15/17 - 1:50 AM
 */

namespace modules\controllers;
use \Controller;

class MainController extends Controller {

    protected $login;

    public function __construct() {

        $this->login = isset($_SESSION["ctfplat_usession"]) ? $_SESSION["ctfplat_usession"] : '';

        if(!$this->login) {
            $this->redirect(SITE_URL . "?page=login");
        }
    }

    protected function template($viewName, $data = array()) {

        /* Tambahan Score */
        $this->model('scoreboard');
        $id = $this->login->id;
        $dataRank = $this->scoreboard->getScoreU($id);

        /*Check Admin or User*/
        if (isset($this->login->admin) && $this->login->admin == 1) {
            $view = $this->view('adminTemplate');
        }elseif (isset($this->login->admin) && $this->login->admin == 0) {
            $view = $this->view('template');
        }

        $view->bind('viewName', $viewName);
        $view->bind('data', array_merge($data, array('login' => $this->login, 'uScore'=> $dataRank)));
    }

    protected function notemplate($viewName, $data = array()) {
        $view = $this->view($viewName);
        $view->bind('data', array_merge($data, array('login' => $this->login)));
    }


}
?>