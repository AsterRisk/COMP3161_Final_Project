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
        $sql = "insert into group_comments (g_comment_id, member_id, g_post_id, text_content) values ((select count(g_comment_id) from group_comments as num_comments)+1, ".$_SESSION['id']." ,".$_POST['g_post_id'] .", \"".$_POST['comment']."\");";
        if (empty($_POST['comment']))
        {
            header("Location: view_group.php?group_id=" . $_POST['group_id']);
        }
        else
        {
            echo $sql;
            $conn->prepare($sql);
            $conn->query($sql);
            //echo "<br> ". $target_file;
            header("Location: view_group.php?group_id=" . $_POST['group_id']);
            echo "<br>SQL: " . $sql;
        }
        
    ?>  
    </body>
</html>