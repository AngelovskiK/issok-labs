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
    <a href="index.php">Go back </a>
    <?php 

        if(isset($_GET['news'])&&!is_nan($_GET['news'])){
            $id = $_GET['news'];        
            if(isset($_GET['approve'])&&!is_nan($_GET['approve'])){
                $query = 'update comments set approved = 1 where comment_id = ?';
                $stmt = $dbo->prepare($query);
                $stmt->bindParam(1, $_GET['approve']);
                if($stmt->execute()) {
                    echo "Succesfully approved comment! <br/>";
                }else {
                    echo "There was a problem, please try again! <br/>";
                }
            }      
            if(isset($_GET['reject'])&&!is_nan($_GET['reject'])){
                $query = 'delete from comments where comment_id = ?';
                $stmt = $dbo->prepare($query);
                $stmt->bindParam(1, $_GET['reject']);
                if($stmt->execute()) {
                    echo "Succesfully deleted comment! <br/>";
                }else {
                    echo "There was a problem, please try again! <br/>";
                }
            }    
    ?>
    <h2>Comments</h2>
    <table>
        <thead>
            <tr>
                <td>Author</td>
                <td>Comment</td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = "select * from comments where news_id = ? and approved = 0";
                $stmt = $dbo -> prepare($query);
                $stmt->bindParam(1, $id);
                $stmt->execute();
                while($row = $stmt->fetch())
                {
                    echo "<tr>";
                    echo "<td>".substr($row['author'], 0, 100)."</td>";
                    echo "<td><a>".$row['comment']."</td>";
                    echo "<td><a href='managecomments.php?news=".$id."&approve=".$row['comment_id']."'>Approve</a></td>";
                    echo "<td><a href='managecomments.php?news=".$id."&reject=".$row['comment_id']."'>Reject</a></td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
    <h3>Add new comment</h3>
    <?php 
        } else {
            echo "No news provided";
        }
    ?>
</body>
</html>