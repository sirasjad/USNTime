<?php

class user extends USN{
    protected function login(){
        if(isset($_POST['email']) && isset($_POST['password'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password = hash('whirlpool', $password);
            $password = strtoupper($password);

            $query = $this->sql->selectFromWhere("id, password", "users", "email", $email);
            if($query->rowCount() == 1){
                if($this->verifyPassword($password)){
                    $row = $query->fetch(PDO::FETCH_ASSOC);
                    $_SESSION['UID'] = $row['id'];
                    header("Location: /?page=home");
                    // add log
                }
                //else $this->errorMsg("Oops!", "Your password is incorrect!");
                else $this->errorMsg("Oops!", "Passordet ditt stemmer ikke!");
            }
            //else $this->errorMsg("Oops!", "Your account does not exist!");
            else $this->errorMsg("Oops!", "Kontoen din finnes ikke!");
        }
        else $this->errorMsg("Hey!", "Fill out all the text fields!");
    }

    private function verifyPassword($password){
        $query = $this->sql->selectFromWhere("password", "users", "password", $password);
        if($query->rowCount() == 1) return true;
        else return false; 
    }
}

?>