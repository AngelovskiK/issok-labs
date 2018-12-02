<?php

    include_once "connection.php";

    if(isset($_GET['id'])&&!is_nan($_GET['id'])){
        if(isset($_POST['title'])) {
            $query = 'update news set news_title = ?, full_text = ? where news_id = ?';
            $stmt = $dbo->prepare($query);
            $stmt->bindParam(1, $_POST['title']);
            $stmt->bindParam(2, $_POST['text']);
            $stmt->bindParam(3, $_GET['id']);
            if($stmt->execute()) {
                echo "Succesfully updated post! <br/>";
            }else {
                echo "There was a problem, please try again! <br/>";
            }
        }
        $id = $_GET['id'];
        $query = 'select * from news where news_id = ?';
        $stmt = $dbo->prepare($query);
        $stmt->bindParam(1, $id);
        if($stmt->execute() && $news=$stmt->fetch()) {
            echo "<a href='index.php'>Go Back</a><br/><form action='edit.php?id=".$id."' method='post'>Title: <input type='text' name='title' value=".$news['news_title'].
            " required/><br/><input type='submit' value='POST'/><textarea name='text'>".$news['full_text']."</textarea></form>";

        }else {
            echo "Non existing post! <a href='index.php'>Go Back</a>";
        }
    }else {
        echo "Non valid post! <a href='index.php'>Go Back</a>";
    }

