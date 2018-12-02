<?php 
    $target_file = "upload.txt";
    if(isset($_FILES['file'])){    
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.<br/>";
        } else {
            echo "Sorry, there was an error uploading your file.";
            die();
        }
    }

    if (!file_exists($target_file)) {
        echo "Sorry, file doesn't exist.";
        die();
    }
    
    echo "<a href='process.php?action=print'>Print uploaded contacts</a><a href='process.php?action=validate'>Validate uploaded contacts</a>";

    if(isset($_GET['action'])){
        $file = fopen($target_file, "r") or die("Unable to open file!");
        
        $action = $_GET['action'];

        if($action == "print") {
            echo "<table><tbody>";
            while (($line = fgets($file)) !== false) {
                $arr = explode(";", $line);
                echo "<tr>";
                foreach($arr as $part) {
                    echo "<td>".$part."</td>";
                }
                echo "</tr>";
            }        
            echo "</tbody></table>";
        } else if($action == "validate") {
            $log = fopen("log.txt", "w") or die("Unable to open file log.txt!");
            $i = 1;
            $allgood = true;
            while (($line = fgets($file)) !== false) {
                $arr = explode(";", $line);
                if(sizeof($arr) == 4) {
                    try{
                        $a = new Contact($arr[0], $arr[1], $arr[2], $arr[3]);
                    }catch (Exception $e) {
                        fwrite($log, "Error on line $i. ".$e->getMessage())."\n";
                        $allgood = false;
                    }
                }else {
                    fwrite($log, "Error on line $i. Invalid number of parameters.")."\n";
                    $allgood = false;
                }
                $i++;
            }      
            echo "<h3>".($allgood ? "All is ok" : "There were errors, check <a href='log.txt'>log.txt</a>")."</h3>";
        }
    }

    class Contact {
        public $ime;
        public $broj;
        public $email;
        public $adresa;
        function __construct($ime, $broj, $email, $adresa) {
            $this->$ime = $ime;
            if(preg_match("/^\d{3}\s\d{3}\s\d{3}$/", $broj) == 0) {
                throw new Exception("Invalid phone number.");
            }
            $this->$broj = $broj;
            if(preg_match("/^[a-zA-Z0-9]@[a-zA-Z0-9]+\.[a-zA-Z0-9]{2,4}$/", $email) == 0) {
                throw new Exception("Invalid email adress.");
            }
            $this->$email = $email;
            $this->$adresa = $adresa;
        }
    }