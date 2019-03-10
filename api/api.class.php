<?php

class API extends USN{
    protected function runCmd(){
        switch($_GET['cmd']){
            case 'count-members': $this->countMembers(); break;
            case 'my-data': $this->getUserData(); break;
            case 'register': $this->newUser(); break;
            case 'login': $this->userLogin(); break;
            default: $this->jsonError("Unknown command"); break;
        }
    }

    protected function checkKey(){
        $query = $this->sql->selectWithData("brukere", "apikey", $_GET["key"]);
        if($query->rowCount() == 1) return true;
        else return false;        
    }

    private function countMembers(){
        $query = $this->sql->selectNoData("brukere");
        $data = array(
            'success' => true,
            'data' => array('members' => $query->rowCount())
        );
        $this->json($data);
    }

    private function getUserData(){
        $query = $this->sql->selectWithData("brukere", "apikey", $_GET["key"]);
        if($query->rowCount() == 1){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $data = array(
                'success' => true,
                'data' => array(
                    'id' => intval($row['id']),
                    'navn' => $row['navn'],
                    'epost' => $row['epost'],
                    'studnr' => $row['studnr']
                )
            );
            $this->json($data);
        }
        else $this->jsonError("No user found");
    }

    private function newUser(){
        //
    }

    private function userLogin(){
        //
    }
}

?>
