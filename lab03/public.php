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
    <h2>News</h2>
    <table>
        <thead>
            <tr>
                <td>Date</td>
                <td>Title</td>
                <td>Article</td>
                <td>Comments</td>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($dbo->query('SELECT news.*,count(comments.comment_id) as commentsCount from news left outer join comments on comments.news_id = news.news_id and comments.approved = 1 group by news.news_id order by `date` limit 5') as $row) {
                    echo "<tr>";
                    echo "<td>".$row['date']."</td>";
                    echo "<td>".substr($row['news_title'], 0, 100)."</td>";
                    echo "<td><a>".$row['full_text']."</td>";
                    echo "<td><a href='comments.php?news=".$row['news_id']."'>".$row['commentsCount']." comments </a></td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>