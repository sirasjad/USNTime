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

    public function validPage(){
        if(!isset($_GET['page'])) header("Location: /?page=login");
    }

    public function pageName(){
        return $_GET['page'];
    }

    public function loginState(){
        if($this->pageName() == "login" && isset($_SESSION['UID'])) header("Location: /?page=home");
        else if($this->pageName() != "login" && !isset($_SESSION['UID'])) header("Location: /?page=login");
    }

    public function setId(){
        if(isset($_SESSION['UID'])) $UID = $_SESSION['UID'];
    }

    public function pageTitle($title){
        include($_SERVER['DOCUMENT_ROOT'].'/pages/include/header.php');
        echo "<title>$title - ".$this->name."</title>";
    }

    public function getNavbar(){
        include($_SERVER['DOCUMENT_ROOT'].'/pages/include/navbar.php');
    }

    public function getFooter(){
        include($_SERVER['DOCUMENT_ROOT'].'/pages/include/footer.php');
    }

    public function successMsg($title, $text){
        echo "<div class='alert alert-success' id='message'><strong>$title</strong> $text</div>";
    }

    public function errorMsg($title, $text){
        echo "<div class='alert alert-danger' id='message'><strong>$title</strong> $text</div>";
    }

    public function userLogin(){
        $usr = new user;
        $usr->login();
    }

    public function userLogout(){
        $_SESSION['UID'] = 0;
        session_destroy();
        header("Location: /?page=login");
    }
}

?>