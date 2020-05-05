<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
</head>
<body>
    <?php
        include 'sql_setup.php';
        //echo $_SESSION['id'];

        echo($_SESSION['id']);
        $sql = "insert into posts (post_id, user_id, text_content, media_link) values ((select count(post_id) from posts as num_posts)+1, ". $_SESSION['id'].", '".$_POST['text_content']."', 'NULL');";
        //echo $sql;
        $conn->prepare($sql);
        $conn->query($sql);
        header("Location: home_page.php")
    ?>  
    </body>
</html>
    