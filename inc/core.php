<?php

class USN{
    public $name, $contact;
    protected $sql;

    function __construct(){
        $this->name = "USNTime";
        $this->contact = "admin@siratech.no";
        $this->sql = new sqlDB;
    }

    public function getIP(){
        return $_SERVER['REMOTE_ADDR'];
    }

    public function getTimezone(){
        return date_default_timezone_set('Europe/Amsterdam');
        return setlocale (LC_ALL, "no_NO.utf8");
    }

    public function getDate(){
        return date('Y-m-d');
    }

    public function getDateTime(){
        return date('m/d/Y (H:i)');
    }

    public function getPrettyDate($date){
        return date("j. M Y", strtotime($date));
    }

    public function validPage(){
        if(!isset($_GET['page'])) header("Location: /?page=login");
    }

    public function pageName(){
        return $_GET['page'];
    }

    public function getId(){
        return $_GET['id'];
    }

    public function loginState(){
        if($this->pageName() == "login" && isset($_SESSION['UID'])) header("Location: /?page=home");
        else if($this->pageName() == "register" && isset($_SESSION['UID'])) header("Location: /?page=home");
        else if($this->pageName() != "login" && $this->pageName() != "register" && !isset($_SESSION['UID'])) header("Location: /?page=login");
    }

    public function pageTitle($title){
        include($_SERVER['DOCUMENT_ROOT'].'/pages/include/header.php');
        echo "<title>$title - ".$this->name."</title>";
    }

    public function activePage($page){
        if($this->pageName() == $page) echo "nav-item active";
        else echo "nav-item";
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

    public function userRegister(){
        $usr = new user;
        $usr->register();
    }

    public function listSubjects(){
        $usr = new user;
        $usr->loadSubjects();
    }

    public function listAttendance(){
        $usr = new user;
        $usr->loadAttendance();
    }

    public function newSubject(){
        $usr = new user;
        $usr->addSubject();
    }

    public function getSubjectName($id){
        $usr = new user;
        $usr->subjectName($id);
    }

    public function newAttendance(){
        $usr = new user;
        $usr->registerAttendance();
    }

    public function listStudents(){
        $usr = new user;
        $usr->loadStudents();
    }
}

?>