<?php

    include_once "connection.php";

    if(isset($_POST['title'])) {
        $query = 'INSERT INTO news(news_title, full_text, `date`) values(?, ?, now())';
        $stmt = $dbo->prepare($query);
        $stmt->bindParam(1, $_POST['title']);
        $stmt->bindParam(2, $_POST['text']);
        if($stmt->execute()) {
            echo "Succesfully posted! <a href='index.php'>Go Back</a>";
            die();
        }else {
            echo "There was a problem, please try again!";
        }
    }

    echo "<a href='index.php'>Go Back</a><br/><form action='new.php' method='post'>Title: <input type='text' name='title' required/><br/><input type='submit' value='POST'/><textarea name='text'></textarea></form>";