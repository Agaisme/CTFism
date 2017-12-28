<?php
/**
 * @Author  : Subraga Islammada <subraga.9310@students.amikom.ac.id>
 * @Date    : 12/15/17 - 1:50 AM
 */

use \modules\controllers\MainController;

class ChallengesController extends MainController {

    public function index() {

    	$this->model('challenges');
    	$this->model('solves');
        $data = $this->challenges->getChall();
        $solved = $this->solves->get();
        $this->template('challenges', array('challenges' => $data, 'solves' => $solved)); 
    }

    public function checkKeys(){

    	$return      = array();
        $success    = null;

        $this->model('challenges');

    	$keysErr = "";
    	$chall_id = "";

    	//Check Method
    	if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    		$keys       = isset($_POST["keys"])     ? ($_POST["keys"])    	: "";
    		$uid       	= isset($_POST["uid"])     	? ($_POST["uid"])    	: "";

    		//Check data is not null
    		if (isset($keys) && isset($uid) && ($keys !== "") && ($uid !== "")) {

    			if (!preg_match("/(flag{([a-zA-Z0-9])*})/", $keys)) {
    				$keysErr = "Not Valid"; 
	    		}

		    	//Get Data Keys
		    	$valKey = $this->challenges->dataKeys($keys);

		    	//Check if Keys Availble
		    	$numKeys = $this->challenges->keysCheck($keys);

		    	//Check if chall_id Avaible
		    	$chall_id = isset($valKey["0"]->chall_id) ? $valKey["0"]->chall_id : "";
		    	if (isset($chall_id)) {
		    		$numChall = $this->challenges->cidCheck($chall_id);
		    		echo($numChall);
		    	}

		    	//

    		}


    		

	    	//Insert Database

	    	//Return Success or Valid Submit


/*	    	$valKey = array(
	    			'challid'      => $valKey["0"]->chall_id,
                    'uid'     => $uid,
                    'keys'   => $keys
                ));


	    	print_r($valKey);*/

/*	    	if (empty($json)) {
			     die($keysErr."\nnull");
			}

	    	if (isset($json)) {

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

				utf8_encode_deep($json);
				echo json_encode($json, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_FORCE_OBJECT | JSON_PRESERVE_ZERO_FRACTION | JSON_UNESCAPED_UNICODE | JSON_PARTIAL_OUTPUT_ON_ERROR);


	    	}*/

				// Check Permission
				/*$ref = $_SERVER['HTTP_REFERER'];*/
				/*'http://localhost/CTFPlatform/app/'*/
					
    	}
    }

    public function getJson() {
    	$id = isset($_GET["id"]) ? $_GET["id"] : "0";
        $this->model('challenges');
        $json = $this->challenges->getData($id);
        
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
		utf8_encode_deep($json);


        echo json_encode($json, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_FORCE_OBJECT | JSON_PRESERVE_ZERO_FRACTION | JSON_UNESCAPED_UNICODE | JSON_PARTIAL_OUTPUT_ON_ERROR);
    }
}
?>