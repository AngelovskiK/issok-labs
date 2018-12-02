<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lab 03</title>
    <?php
        include_once 'connection.php';
    ?>
</head>
<body>
    <a href="public.php">Go back </a>
    <?php 

        if(isset($_GET['news'])&&!is_nan($_GET['news'])){
            $id = $_GET['news'];        
            if(isset($_POST['author'])&&isset($_POST['comment'])){
                $query = 'INSERT INTO comments(news_id, author, comment, approved) values(?, ?, ?, 0)';
                $stmt = $dbo->prepare($query);
                $stmt->bindParam(1, $id);
                $stmt->bindParam(2, $_POST['author']);
                $stmt->bindParam(3, $_POST['comment']);
                if($stmt->execute()) {
                    echo "Succesfully posted comment!<br/>";
                }else {
                    echo "There was a problem, please try again!<br/>";
                }
            }
    ?>
    <h2>Comments</h2>
    <table>
        <thead>
            <tr>
                <td>Author</td>
                <td>Comment</td>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = "select * from comments where news_id = ?";
                $stmt = $dbo -> prepare($query);
                $stmt->bindParam(1, $id);
                $stmt->execute();
                while($row = $stmt->fetch())
                {
                    echo "<tr>";
                    echo "<td>".substr($row['author'], 0, 100)."</td>";
                    echo "<td><a>".$row['comment']."</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
    <h3>Add new comment</h3>
    <?php 
        echo "<form action='comments.php?news=".$id."' method='post'>Author: <input type='text' name='author' required/><br/> Comment: <input type='text' name='comment'/><br/><input type='submit'/></form>";
        } else {
            echo "No news provided";
        }
    ?>
</body>
</html>