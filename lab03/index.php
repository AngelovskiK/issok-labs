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
    <?php 
        if(isset($_GET['delete'])){
            $query = 'delete from news where news_id = ?';
            $stmt = $dbo->prepare($query);
            $stmt->bindParam(1, $_GET['delete']);
            if(!$stmt->execute()) {
                echo "Problem deleting post <br/> ";
            }
        }
    ?>
    <h2>News Admin Panel</h2>
    <a href="new.php">Add new news</a>
    <table>
        <thead>
            <tr>
                <td>ID</td>
                <td>Date</td>
                <td>Title</td>
                <td>Article</td>
                <td>Comments</td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($dbo->query('SELECT news.*,count(comments.comment_id) as commentsCount from news left outer join comments on comments.news_id = news.news_id and comments.approved = 0 group by news.news_id') as $row) {
                    echo "<tr>";
                    echo "<td>".$row['news_id']."</td>";
                    echo "<td>".$row['date']."</td>";
                    echo "<td>".$row['news_title']."</td>";
                    echo "<td>".$row['full_text']."</td>";
                    echo "<td><a href='managecomments.php?news=".$row['news_id']."'>".$row['commentsCount']." new comments </a></td>";
                    echo "<td><a href='edit.php?id=".$row['news_id']."'>Edit</a></td>";
                    echo "<td><a href='index.php?delete=".$row['news_id']."'>Delete</a></td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>