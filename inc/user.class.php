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

    private function userExists($email){
        $query = $this->sql->selectFromWhere("email", "users", "email", $email);
        if($query->rowCount() == 1) return true;
        else return false;
    }

    protected function register(){
        $email = $_POST['email'];
        $studnr = $_POST['studnr'];
        $name = $_POST['name'];
        $password = $_POST['password'];
        $repeatpwd = $_POST['repeatpwd'];

        if($password == $repeatpwd){
            if(!$this->userExists($email)){
                $password = hash('whirlpool', $password);
                $password = strtoupper($password);
                
                $query = $this->sql->pdo->prepare("INSERT INTO users (name, studnr, email, password) VALUES (:name, :studnr, :email, :password)");
                $query->execute(array(':name' => $name, ':studnr' => $studnr, ':email' => $email, ':password' => $password));
                $this->successMsg("Hurra!", "Du har nå opprettet en brukerkonto. Vent litt...");
                // log

                $query = $this->sql->selectFromWhere("id", "users", "email", $email);
                $row = $query->fetch(PDO::FETCH_ASSOC);
                $_SESSION['UID'] = $row['id'];
                echo '<script>setTimeout("window.location=\'/?page=home\'",3500)</script>';
            }
            else $this->errorMsg("Oops!", "En bruker med din e-post adresse finnes allerede.");    
        }
        else $this->errorMsg("Oops!", "Passordene dine er ikke like!");
    }

    protected function addSubject(){
        if(isset($_POST['subject']) && isset($_POST['semester']) && isset($_POST['year'])){
            $subject = $_POST['subject'];
            $semester = $_POST['semester'];
            $year = $_POST['year'];

            $query = $this->sql->pdo->prepare("INSERT INTO subjects (teacher, name, semester) VALUES (:teacher, :name, :semester)");
            $query->execute(array(':teacher' => $_SESSION['UID'], ':name' => $subject, ':semester' => "$semester $year"));
            // log
        }
        else $this->errorMsg("Hey!", "Fill out all the text fields!");
    }

    protected function editSubject(){
        if(isset($_POST['subject']) && isset($_POST['semester']) && isset($_POST['year'])){
            $subject = $_POST['subject'];
            $semester = $_POST['semester'];
            $year = $_POST['year'];

            $query = $this->sql->pdo->prepare("UPDATE subjects SET name = :name, semester = :semester WHERE id = :id");
            $query->execute(array(':name' => $subject, ':semester' => "$semester $year", ':id' => $this->getId()));
            $this->successMsg("Hurra!", "Du har oppdatert dette faget.");
            // log
        }
        else $this->errorMsg("Hey!", "Fill out all the text fields!");
    }

    protected function loadSubjects(){
        $query = $this->sql->selectFromWhere("id, name, semester", "subjects", "teacher", $_SESSION['UID']);
        if($query->rowCount() != 0){
            switch($this->pageName()){
                case 'attendance':{
                    
                    echo "
                    <thead class='thead-dark'><tr>
                        <th scope='col'>Fagemne</th>
                        <th scope='col'>Semester</th>
                    </tr></thead><tbody>";
                    

                    while($row = $query->fetch(PDO::FETCH_ASSOC)){
                        echo "
                        <tr>
                            <th scope='row'><a href='/?page=register-attendance&id=".$row['id']."' style='color: #444aa2;'>".$row['name']."</a></th>
                            <td>".$row['semester']."</td>
                        </tr>";
                    }
                    echo "</tbody>";
                } break;

                case 'subjects':{
                    echo "
                    <thead><tr>
                        <th scope='col'>Fagemne</th>
                        <th scope='col'>Semester</th>
                        <th scope='col'>Antall forelesninger</th>
                        <th scope='col'>Påmeldte studenter</th>
                    </tr></thead><tbody>";

                    while($row = $query->fetch(PDO::FETCH_ASSOC)){
                        echo "
                        <tr>
                            <th scope='row'><a href='/?page=view-subject&id=".$row['id']."' style='color: #444aa2;'>".$row['name']."</a></th>
                            <td>".$row['semester']."</td>
                            <td>".$this->countLectures($row['id'])."</td>
                            <td>".$this->countEnrolledStudents($row['id'])."</td>
                        </tr>";
                    }
                    echo "</tbody>";
                } break;

                default: echo "Error: Unable to load subjects!"; break;
            }
        }
    }

    protected function loadAttendance(){
        $query = $this->sql->pdo->prepare("SELECT * FROM attendance WHERE subject = :subject GROUP BY date");
        $query->execute(array(':subject' => $_GET['id']));

        if($query->rowCount() != 0){
            echo "
            <thead><tr>
                <th scope='col'>Dato</th>
                <th scope='col'>Antall oppmøte</th>
            </tr></thead><tbody>";

            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                echo "
                <tr>
                    <th scope='row'><a href='/?page=view-lecture&id=".$this->getId()."&date=".$row['date']."' style='color: #444aa2;'>".$this->getPrettyDate($row['date'])."</a></th>
                    <td>".$this->countStudents($row['date'])."</td>
                </tr>";
            }
            echo "</tbody>";
        }
        else $this->errorMsg("Hmm!", "Ingen har registrert oppmøte i dette faget enda.");
    }

    protected function loadEnrolledStudents(){
        $query = $this->sql->selectFromWhere("studnr, name", "students", "subject", $this->getId());
        if($query->rowCount() != 0){
            echo "
            <thead><tr>
                <th scope='col'>Navn</th>
                <th scope='col'>Studentnummer</th>
            </tr></thead><tbody>";

            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                echo "
                <tr>
                    <td>".$row['name']."</td>
                    <td>".$row['studnr']."</td>
                </tr>";
            }
            echo "</tbody>";
        }
    }

    private function getStudentName($studnr){
        $query = $this->sql->selectFromWhere("name", "students", "studnr", $studnr);
        if($query->rowCount() != 0){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row['name'];
        }
        else return "Unknown student";
    }

    protected function loadAttendedStudents(){
        $query = $this->sql->pdo->prepare("SELECT studnr FROM attendance WHERE subject = :subject AND date = :date");
        $query->execute(array(':subject' => $_GET['id'], ':date' => $_GET['date']));

        if($query->rowCount() != 0){
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                echo "
                <tr>
                    <td>".$this->getStudentName($row['studnr'])."</td>
                    <td>".$row['studnr']."</td>
                </tr>";
            }
        }
        else $this->errorMsg("Hmm!", "Ingen studenter har registrert oppmøte denne dagen.");
    }

    private function countEnrolledStudents($subject){
        $query = $this->sql->pdo->prepare("SELECT * FROM students WHERE subject = :subject");
        $query->execute(array(':subject' => $subject));
        return $query->rowCount();
    }

    private function countLectures($subject){
        $query = $this->sql->pdo->prepare("SELECT * FROM attendance WHERE subject = :subject GROUP BY date");
        $query->execute(array(':subject' => $subject));
        return $query->rowCount();
    }

    private function countStudents($date){
        $query = $this->sql->pdo->prepare("SELECT * FROM attendance WHERE subject = :subject AND date = :date");
        $query->execute(array(':subject' => $this->getId(), ':date' => $date));
        return $query->rowCount();
    }

    protected function subjectName($id){
        $query = $this->sql->selectFromWhere("name", "subjects", "id", $id);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        echo $row['name'];
    }

    protected function registerAttendance(){
        if(isset($_POST['studnr'])){
            $studnr = $_POST['studnr'];
            $subject = $_GET['id'];

            $query = $this->sql->pdo->prepare("INSERT INTO attendance (subject, date, studnr) VALUES (:subject, :date, :studnr)");
            $query->execute(array(':subject' => $subject, ':date' => $this->getDate(), ':studnr' => $studnr));
            $this->successMsg("Hurra!", "Ditt oppmøte har blitt registrert ($studnr).");
            // log
        }
        else $this->errorMsg("Hey!", "You must enter your student number!");
    }

    protected function searchStudent(){
        if(isset($_POST['studnr'])){
            $studnr = $_POST['studnr'];
            $query = $this->sql->pdo->prepare("SELECT * FROM attendance WHERE studnr = :studnr AND subject = :subject GROUP BY date");
            $query->execute(array(':studnr' => $studnr, ':subject' => $this->getId()));
            
            if($query->rowCount() != 0){
                echo "
                <p class='lead'>
                    Antall registrerte forelesninger: ".$query->rowCount()."/".$this->countLectures($this->getId())."<br>
                    Status: <strong><font color='green'>Godkjent (100%)</font></strong>
                </p>";

                echo "
                <thead class='thead-dark'><tr>
                    <th scope='col'>Navn</th>
                    <th scope='col'>Studentnummer</th>
                    <th scope='col'>Dato</th>
                </tr></thead><tbody>";

                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    echo "
                    <tr>
                        <th scope='row'>".$this->getStudentName($row['studnr'])."</th>
                        <td>".$row['studnr']."</td>
                        <td>".$this->getPrettyDate($row['date'])."</td>
                    </tr>";
                }
                echo "</tbody>";
            }
            else $this->errorMsg("Oops!", "Denne studenten har ikke registrert noen oppmøte i dette faget.");
        }
        else $this->errorMsg("Hey!", "You must enter a student number!");
    }

    protected function deleteAllStudents(){
        $query = $this->sql->pdo->prepare("DELETE FROM students WHERE subject = :subject");
        $query->execute(array(':subject' => $this->getId()));
        $this->successMsg("Hurra!", "Du har slettet alle påmeldte studenter fra dette faget.");
        //log
    }

    protected function importStudentList(){
        $file = $_FILES['file']['name'];
        $tmp = explode('.', $file);
        $file_ext = strtolower(end($tmp));
        $file_formats = array('xlsx', 'csv');

        if(in_array($file_ext, $file_formats)){
            //
        }
        else $this->errorMsg("Hey!", "Du kan kun laste opp Excel dokumenter (format .xlsx og .csv)!");
    }

    protected function addNewStudent(){
        if(isset($_POST['name']) && isset($_POST['studnr'])){
            $query = $this->sql->pdo->prepare("INSERT INTO students (subject, studnr, name) VALUES (:subject, :studnr, :name)");
            $query->execute(array(':subject' => $this->getId(), ':studnr' => $_POST['studnr'], ':name' => $_POST['name']));
            $this->successMsg("Hurra!", "Du har lagt til ".$_POST['name']." som en ny student.");
            // log
        }
        else $this->errorMsg("Hey!", "Fill out all the text fields!");
    }

    protected function listLogs(){
        $query = $this->sql->selectFromWhere("text, date, ip", "logs", "user", $_SESSION['UID']);
        if($query->rowCount() != 0){
            echo "
            <thead class='thead-dark'><tr>
                <th scope='col'>Dato</th>
                <th scope='col'>IP adresse</th>
                <th scope='col'>Logg</th>
            </tr></thead><tbody>";

            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                echo "
                <tr>
                    <th scope='row'>".$row['date']."</th>
                    <td>".$row['ip']."</td>
                    <td>".$row['text']."</td>
                </tr>";
            }
            echo "</tbody>";
        }
        else $this->errorMsg("Oops!", "Det finnes ingen brukerlogg enda.");
    }
}

?>