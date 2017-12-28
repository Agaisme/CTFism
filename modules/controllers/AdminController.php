<?php
/**
 * @Author  : Subraga Islammada <subraga.9310@students.amikom.ac.id>
 * @Date    : 12/15/17 - 1:50 AM
 */

use \modules\controllers\MainController;

class AdminController extends MainController {

    public function index() {
        $this->template('adminPage'); // view home yang sudah dimasukkan kedalam template
    }
}
?>