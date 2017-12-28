<?php
/**
 * @Author  : Subraga Islammada <subraga.9310@students.amikom.ac.id>
 * @Date    : 12/15/17 - 1:50 AM
 */

use \modules\controllers\MainController;

class UsermanController extends MainController {

    public function index() {

    	$this->model('user');

    	$data = $this->user->get();

    	$this->notemplate('userman', array('user' => $data));

    }


    public function editUser(){

        $this->model('user');

        $success    = null;
        $message	= null;

    	$refer = isset($_SERVER['HTTP_REFERER']) ? ($_SERVER['HTTP_REFERER']) : "";

    	//Check Method Request & Refer Permission
    	if ($_SERVER["REQUEST_METHOD"] == 'POST' ) {

    		$ipaddress 	= isset($_SERVER['REMOTE_ADDR'])? ($_SERVER['REMOTE_ADDR']) : ""; 
    		$uid       	= isset($_POST["uid"])     		? ($_POST["uid"])    		: "";
    		$state      = isset($_POST["state"]) && (($_POST["state"]) == 'admin' || ($_POST["state"]) == 'verified') ? ($_POST["state"]) : "";
    		$valState   = isset($_POST["val"])     		? ($_POST["val"])    		: "";

    		//Check data is not null
    		if (isset($uid) && isset($state) && ($state !== "") && ($uid !== "")) {

    			if (!preg_match("/^([0-1]){1}$/", $valState)) {
    				$message = "Not Valid Value"; 
    				$success = false;
    			}
    			
	    		//Check if User Valid
		    	$valUser = $this->user->userCheck($uid);

			    	if (isset($valUser) && $valUser == 1 && $success !== false) {

		                $dataUpdate = array(
		                    $state  => $valState
		                );

		                $update = $this->user->update($dataUpdate, array('id' => $uid));

	                    if($update) {

	                        $message = "Success ! User has been edited.";
		                	$success = true;
	                    }

		            }else{
		            	$message = "Sorry ! Error found in your request.";
		            	$success = false;
		            }

	    	}else{
	    		/*Keys Incorrect*/
	    		$message = "Sorry ! Your request not valid.";
	    		$success = false;
	    	}

			//Return Success or Not
	        $json = array(
	        		'success'	=> $success,
	                'uid'		=> $uid,
	                'message'   => $message
	            );

            echo json_encode($json, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_FORCE_OBJECT | JSON_PRESERVE_ZERO_FRACTION | JSON_UNESCAPED_UNICODE | JSON_PARTIAL_OUTPUT_ON_ERROR);
		}
    }



    public function details() {

        $this->model('user');

        $success    = null;
        $message	= null;

    	$refer = isset($_SERVER['HTTP_REFERER']) ? ($_SERVER['HTTP_REFERER']) : "";
    	//Check Method Request & Refer Permission
    	if ($_SERVER["REQUEST_METHOD"] == 'POST' ) {

    		$ipaddress 	= isset($_SERVER['REMOTE_ADDR'])? ($_SERVER['REMOTE_ADDR']) : ""; 
    		$uid       	= isset($_POST["uid"])     		? ($_POST["uid"])    		: "";


    		if (isset($uid) && ($uid !== "")) {
   			
	    		//Check if User Valid
		    	$valUser = $this->user->userCheck($uid);

		    	if (isset($valUser) && $valUser == 1 && $success !== false) {

	                $data = $this->user->getDetails($uid);

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
					utf8_encode_deep($data);


			        echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_FORCE_OBJECT | JSON_PRESERVE_ZERO_FRACTION | JSON_UNESCAPED_UNICODE | JSON_PARTIAL_OUTPUT_ON_ERROR);

	            }
	    	}
    	}
    }

    public function update(){

        $this->model('user');

        $success    = null;
        $message	= null;

    	$refer = isset($_SERVER['HTTP_REFERER']) ? ($_SERVER['HTTP_REFERER']) : "";

    	//Check Method Request & Refer Permission
    	if ($_SERVER["REQUEST_METHOD"] == 'POST' ) {

    		$ipaddress 	= isset($_SERVER['REMOTE_ADDR'])? ($_SERVER['REMOTE_ADDR']) : ""; 
    		$uid       	= isset($_POST["uid"])     		? ($_POST["uid"])    		: "";
    		$email      = isset($_POST["email"])     	? ($_POST["email"])    		: "";
    		$website    = isset($_POST["website"])     	? ($_POST["website"])    	: "";
    		$country    = isset($_POST["country"])     	? ($_POST["country"])    	: "";
    		$password   = isset($_POST["password"])     ? ($_POST["password"])  	: "";

    		//Check data is not null
    		if (isset($uid) && ($uid !== "")) {
    			
	    		//Check if User Valid
		    	$valUser = $this->user->userCheck($uid);

		    	if (isset($valUser) && $valUser == 1 && $success !== false) {

	                $dataUpdate = array();

	                if(isset($email) && $email != "") {
	                	$dataUpdate["email"] = $email;
	                }

	                if(isset($password) && $password != "") {
	                	$dataUpdate["password"] = md5($password);
	                }

	                if(isset($website) && $website != "") {
	                	$dataUpdate["website"] = $website;
	                }

	                if(isset($country) && $country != "") {
	                	$dataUpdate["country"] = $country;
	                }

	                $update = $this->user->update($dataUpdate, array('id' => $uid));

                    if($update) {
                        $message = "Success ! User data has been updated.";
	                	$success = true;
                    }

	            }else{
	            	$message = "Sorry ! Error found in your request.";
	            	$success = false;
	            }

	    	}else{
	    		/*Keys Incorrect*/
	    		$message = "Sorry ! Your request not valid.";
	    		$success = false;
	    	}

			//Return Success or Not
	        $json = array(
	        		'success'	=> $success,
	                'uid'		=> $uid,
	                'message'   => $message
	            );

            echo json_encode($json, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_FORCE_OBJECT | JSON_PRESERVE_ZERO_FRACTION | JSON_UNESCAPED_UNICODE | JSON_PARTIAL_OUTPUT_ON_ERROR);
		}
    }


    public function delete() {

        $this->model('user');
        $this->model('solves');

        $success    = null;
        $message	= null;

    	$refer = isset($_SERVER['HTTP_REFERER']) ? ($_SERVER['HTTP_REFERER']) : "";
    	//Check Method Request & Refer Permission
    	if ($_SERVER["REQUEST_METHOD"] == 'POST' ) {

    		$uid  = isset($_POST["uid"]) ? ($_POST["uid"]) : "";

    		//Check data is not null
    		if (isset($uid) && ($uid !== "")) {
    			
	    		//Check if User Valid
		    	$valUser = $this->user->userCheck($uid);
		    	if (isset($valUser) && $valUser == 1 && $success !== false) {

	                $data = $this->user->getWhere(array(
			            'id'  => $uid
			        ));

			        /*$delS = $this->solves->delete(array('id' => $uid));*/

			        $delU = $this->user->delete(array('id' => $uid));

			        /*if($delS) {
                        $message = "Success ! User history has been delete.";
	                	$success = true;
                    }*/

                    if($delU) {
                        $message = "Success ! User has been delete.";
	                	$success = true;
                    }

	            }else{
	            	$message = "Sorry ! User not found";
	            	$success = false;
	            }
		    }

		    //Return Success or Not
	        $json = array(
	        		'success'	=> $success,
	                'uid'		=> $uid,
	                'message'   => $message
	            );

            echo json_encode($json, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_FORCE_OBJECT | JSON_PRESERVE_ZERO_FRACTION | JSON_UNESCAPED_UNICODE | JSON_PARTIAL_OUTPUT_ON_ERROR);
    	}
    }


}

?>