<?php

class USN{
	public $name, $contact;
	protected $sql;

	function __construct(){
		$this->name = "USNTime";
		$this->contact = "admin@siratech.no";
		$this->sql = new sqlDB;
	}

	public function GetIP(){
		return $_SERVER['REMOTE_ADDR'];
	}

    protected function json($data){
        header('Content-type: application/json');
        echo json_encode($data);
    }

    protected function jsonError($message){
        header('Content-type: application/json');
        $data = array(
            'success' => false,
            'message' => $message
        );
        echo json_encode($data);
    }

	public function getCommands(){
		if(!isset($_GET['key'])){
            echo"<strong>Available commands:</strong><br>";
            echo "count-members<br>";
        }
	}

	public function validUrl(){
        if(isset($_GET['key'])){
        	$api = new API;
            if($api->checkKey()){
                if(isset($_GET['cmd'])) $api->runCmd();
                else $this->jsonError("Missing command");
            }
            else $this->jsonError("Invalid API key");
        }
    }
}

?>