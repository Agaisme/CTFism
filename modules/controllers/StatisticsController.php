<?php
/**
 * @Author  : Subraga Islammada <subraga.9310@students.amikom.ac.id>
 * @Date    : 12/15/17 - 1:50 AM
 */

use \modules\controllers\MainController;

class StatisticsController extends MainController {

    public function index() {

        $this->template('statistics'); // view home yang sudah dimasukkan kedalam template
    }
}
?>