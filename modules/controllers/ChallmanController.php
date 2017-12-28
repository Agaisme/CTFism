<?php
/**
 * @Author  : Subraga Islammada <subraga.9310@students.amikom.ac.id>
 * @Date    : 12/15/17 - 1:50 AM
 */

use \modules\controllers\MainController;

class ChallmanController extends MainController {

    public function index() {

        $this->model('challenges');
    	$this->model('solves');
        $data = $this->challenges->getChall();
        $solved = $this->solves->get();

    	$this->notemplate('challman', array('challenges' => $data, 'solves' => $solved));
    }


    public function details() {

        $this->model('challenges');

        $success    = null;
        $message	= null;

    	$refer = isset($_SERVER['HTTP_REFERER']) ? ($_SERVER['HTTP_REFERER']) : "";
    	//Check Method Request & Refer Permission
    	if ($_SERVER["REQUEST_METHOD"] == 'POST' ) {

    		$ipaddress 	= isset($_SERVER['REMOTE_ADDR'])? ($_SERVER['REMOTE_ADDR']) : ""; 
    		$id       	= isset($_POST["id"])     		? ($_POST["id"])    		: "";


    		if (isset($id) && ($id !== "")) {
   			
	    		//Check if User Valid
		    	$valChall = $this->challenges->challCheck($id);

		    	if (isset($valChall) && $valChall == 1 && $success !== false) {

	                $data = $this->challenges->getWhere(
			            array(
			                'id'  => $id
			            )
			        );

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

        $this->model('challenges');

        $success    = null;
        $message	= null;

    	$refer = isset($_SERVER['HTTP_REFERER']) ? ($_SERVER['HTTP_REFERER']) : "";

    	//Check Method Request & Refer Permission
    	if ($_SERVER["REQUEST_METHOD"] == 'POST' ) {

    		$ipaddress 	= isset($_SERVER['REMOTE_ADDR'])? ($_SERVER['REMOTE_ADDR']) : ""; 
    		$id       	= isset($_POST["id"])     		? ($_POST["id"])    		: "";
    		$name      	= isset($_POST["name"])     	? ($_POST["name"])    		: "";
    		$category   = isset($_POST["category"])     ? ($_POST["category"])    	: "";
    		$description= isset($_POST["description"])	? ($_POST["description"])   : "";
    		$value   	= isset($_POST["value"])     	? ($_POST["value"])  		: "";

    		//Check data is not null
    		if (isset($id) && ($id !== "")) {
   			
	    		//Check if Challanges Valid
		    	$valChall = $this->challenges->challCheck($id);

		    	if (isset($valChall) && $valChall == 1 && $success !== false) {

	                $dataUpdate = array();

	                if(isset($name) && $name != "") {
	                	$dataUpdate["name"] = $name;
	                }

	                if(isset($category) && $category != "") {
	                	$dataUpdate["category"] = $category;
	                }

	                if(isset($description) && $description != "") {
	                	$dataUpdate["description"] = $description;
	                }

	                if(isset($value) && $value != "") {
	                	$dataUpdate["value"] = $value;
	                }

	                $update = $this->challenges->update($dataUpdate, array('id' => $id));

                    if($update) {
                        $message = "Success ! Challenges data has been updated.";
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
	                'id'		=> $id,
	                'message'   => $message
	            );

            echo json_encode($json, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_FORCE_OBJECT | JSON_PRESERVE_ZERO_FRACTION | JSON_UNESCAPED_UNICODE | JSON_PARTIAL_OUTPUT_ON_ERROR);
		}
    }




    public function delete() {

    	/*$this->model('files');*/
        $this->model('solves');
        $this->model('challenges');

        $success    = null;
        $message	= null;

    	$refer = isset($_SERVER['HTTP_REFERER']) ? ($_SERVER['HTTP_REFERER']) : "";
    	//Check Method Request & Refer Permission
    	if ($_SERVER["REQUEST_METHOD"] == 'POST' ) {

    		$cid  = isset($_POST["id"]) ? ($_POST["id"]) : "";

    		//Check data is not null
    		if (isset($cid) && ($cid !== "")) {
    			
	    		//Check if Chall Valid
		    	$valChall = $this->challenges->challCheck($cid);
		    	if (isset($valChall) && $valChall == 1 && $success !== false) {

	                $data = $this->challenges->getWhere(array(
			            'id'  => $cid
			        ));

			        $delC = $this->challenges->delete(array('id' => $cid));

                    if($delC) {
                        $message = "Success ! Challanges has been delete.";
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
	                'cid'		=> $cid,
	                'message'   => $message
	            );

            echo json_encode($json, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_FORCE_OBJECT | JSON_PRESERVE_ZERO_FRACTION | JSON_UNESCAPED_UNICODE | JSON_PARTIAL_OUTPUT_ON_ERROR);
    	}
    }





}
?>