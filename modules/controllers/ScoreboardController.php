<?php
/**
 * @Author  : Subraga Islammada <subraga.9310@students.amikom.ac.id>
 * @Date    : 12/15/17 - 1:50 AM
 */

use \modules\controllers\MainController;

class ScoreboardController extends MainController {


    public function index() {

        $this->model('scoreboard');

        $dataRank = $this->scoreboard->listRank();

        $this->template('scoreboard', array('scoreboard' => $dataRank));
    }

    public function getRank(){


    	$this->model('solves');

        $dataSolves = $this->solves->getSolves();
		
		/*
        foreach ($dataSolves as $key => $value) {
        	echo($dataSolves[$key]->chall_id);
        	echo "\n";
        }
        */

        // The function unicode encode
		function utf8_encode_deep(&$input) {
		    if (is_string($input)) {
		        $input = utf8_encode($input);
		    } else if (is_array($input)) {
		        foreach ($input as &$value) {
		            utf8_encode_deep($value);
		        }

		        unset($value);
		    } else if (is_object($input)) {
		        $vars = array_keys(get_object_vars($input));

		        foreach ($vars as $var) {
		            utf8_encode_deep($input->$var);
		        }
		    }
		}
		// $structure is now utf8 encoded
		utf8_encode_deep($dataSolves);


        echo json_encode($dataSolves, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_FORCE_OBJECT | JSON_PRESERVE_ZERO_FRACTION | JSON_UNESCAPED_UNICODE | JSON_PARTIAL_OUTPUT_ON_ERROR);

    }

}
?>