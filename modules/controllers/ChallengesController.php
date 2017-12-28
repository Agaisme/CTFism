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

        $this->model('challenges');
        $this->model('solves');
        $this->model('user');

        $success    = null;
        $message	= null;
    	$keysErr 	= null;
    	$chall_id 	= null;
    	$numChall	= null;
    	$valUser	= null;

    	$refer = isset($_SERVER['HTTP_REFERER']) ? ($_SERVER['HTTP_REFERER']) : "";

    	//Check Method Request & Refer Permission
    	if ($_SERVER["REQUEST_METHOD"] == 'POST' && $refer == (PATH."?page=challenges") ) {

    		$ipaddress 	= isset($_SERVER['REMOTE_ADDR'])? ($_SERVER['REMOTE_ADDR']) : ""; 
    		$keys       = isset($_POST["keys"])     	? ($_POST["keys"])    		: "";
    		$uid       	= isset($_POST["uid"])     		? ($_POST["uid"])    		: "";
    		$date 		= null !== date('Y-m-d H:i:s')	? date('Y-m-d H:i:s')		: "";

    		//Check data is not null
    		if (isset($keys) && isset($uid) && ($keys !== "") && ($uid !== "")) {
    			/*/(flag{([a-zA-Z0-9])*})/*/
    			if (!preg_match("/^(CTF{([a-zA-Z0-9_-])*})$/", $keys)) {
    				$message = "Not Valid Flag Format CTF{[a-zA-Z0-9_-]}"; 
    				$success = false;
	    		}

	    		//Check if User Valid
		    	$valUser = $this->user->userCheck($uid);

		    	//Get row number from keys
		    	$numKeys = $this->challenges->keysCheck($keys);

		    	if ($numKeys !== 0) {

		    		/*Keys Correct*/

		    		//Get Array Object Data from Keys
		    		$valKey = $this->challenges->dataKeys($keys);

		    		//Check if chall_id from keys Avaible
		    		$chall_id = !empty($valKey["0"]->chall_id) ? $valKey["0"]->chall_id : "";

		    		//Get Data From challages
			    	$numChall = $this->challenges->cidCheck($chall_id);

			    	//Check if numChall from challenges Avaible
			    	$numChall = !empty($numChall) ? $numChall["0"]->id : "";

			    	//Check if solves exist on database
			    	$solvesCheck = $this->solves->solvesCheck($numChall, $uid, $keys);

			    	if (isset($chall_id) && isset($valUser) && $valUser == 1) {

			    		//Check if challanges is s valid with keys chall_id
		    			if ($numChall == $chall_id) {

		    				if(empty($solvesCheck) && $solvesCheck == 0) {
			    				//Insert into Database if no errors
				                $insert = $this->solves->insert(
				                    array(
				                        'chall_id'  => $numChall,
				                        'uid'       => $uid,
				                        'ip'       	=> $ipaddress,
				                        'flag'      => $keys,
				                        'date'		=> $date
				                    )
				                );
				                $message = "Congratulation ! Flag successfully submited.";
				                $success = true;	                
				            }elseif (!empty($solvesCheck) && $solvesCheck >= 1) {
				            	$message = "Sorry ! Your flag already submited.";
				            	$success = false;
				            }

		    			}

			    	}

		    	}else{

		    		/*Keys Incorrect*/
		    		$message = "Sorry ! Your flag not valid.";
		    		$success = false;
		    	}

		    		//Return Success or Not
	                $json = array(
	                		'success'	=> $success,
	                        'chall_id'  => $numChall,
	                        'uid'		=> $uid,
	                        'message'   => $message
	                    );

	                echo json_encode($json, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_FORCE_OBJECT | JSON_PRESERVE_ZERO_FRACTION | JSON_UNESCAPED_UNICODE | JSON_PARTIAL_OUTPUT_ON_ERROR);
    		}
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