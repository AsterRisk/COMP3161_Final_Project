<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
</head>
<body>
    <?php
            include 'sql_setup.php';
            //echo $_SESSION['id'];
            
            //echo($sql);
    ?>  
            <h3>Tell us what's happening!</h3>
            <form id = 'post_to_wall' method = 'POST' action = "posting.php">
                <textarea id = 'text_content' name = 'text_content' rows = '5' cols = '60'></textarea>
                <br>
                <input type = 'submit' value = 'Post!'>
            </form>
            <h1>TIMELINE</h1>
            <br>
            <br>
            
    <?php
            
            $sql = "select post_id, posts.user_id, text_content, media_link, fgroup from posts join friends where posts.user_id = friends.friend_id and friends.user_id =". $_SESSION['id']." order by post_id desc;";
    
            //echo $sql;
            $conn->prepare($sql);
            $results = $conn->query($sql);
            foreach($results as $post)
            {
                $sql = "select first_name, last_name from users where user_id = " .$post['user_id'];
                $conn->prepare($sql);
                $names = $conn->query($sql)->fetch_assoc();
                echo "<b>".$names['first_name'] . " " . $names['last_name'] . "</b><br>";
                echo "<pre>      " . $post['text_content'] . "</pre>";
                echo "<form method = 'post' class = 'commenting' action = 'comment.php'>";
                echo "<input type = 'text' id = 'comment". $post['post_id'] ."' class = 'comment' name = 'comment' placeholder = 'Write a comment...'><input type = 'submit' value = 'Comment' id = 'comment-button'><br><br><br>";
            }
    ?>
</body>