<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
</head>
<body>
    <?php
        include 'sql_setup.php';
        //echo $_SESSION['id'];

        //echo($_SESSION['id']);
        $sql = "insert into comments (comment_id, user_id, post_id, text_content, media_link) values ((select count(comment_id) from comments as num_comments)+1, ".$_SESSION['id']." ,".$_POST['hidden_val'] .", \"".$_POST['comment']."\", 'null');";
        if (empty($_POST['text_content']) && ($uploadOk == 0))
        {
            header("Location: home.php");
        }
        else
        {
            $conn->prepare($sql);
            $conn->query($sql);
            echo "<br> ". $target_file;
            header("Location: home.php");
        }
    ?>  
    </body>
</html>
    