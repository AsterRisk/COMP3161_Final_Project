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
    <form id = "search" method = "POST" action = "search.php">
        <input type = "text" id = "search-bar" name = "search-bar" placeholder = "Search...">
            <img src = "../assets/default_imgs/magnifying_glass.png" height = 30px width = 30px>
        <input type = 'submit' value = ''>
    </form>
    <h3>Tell us what's happening!</h3>
    <form id = 'post_to_wall' method = 'POST' action = "posting.php" enctype="multipart/form-data">
        <textarea id = 'text_content' name = 'text_content' rows = '5' cols = '60'></textarea>
        <br>
        Upload an image!
        <br>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <!--<input type="submit" value="Upload Image" name="submit">-->
        <input type = 'submit' value = 'Post!'>
    </form>
    <div id = "timeline">
    <a href = "friends.php">View Friends List</a>
    <br>
    <a href = "index.php">Logout</a>
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
            echo "<b>".$names['first_name'] . " " . $names['last_name'] . "</b><br>\n";
            echo "<pre>      " . $post['text_content'] . "</pre>\n";

            $sql = "select first_name, last_name, text_content, media_link from users join comments where users.user_id = comments.user_id and comments.post_id = ".$post['post_id'].";";
            if((strcasecmp($post['media_link'], "") != 0) && (strcasecmp($post['media_link'], "NULL") != 0))
            {
                echo "<img src = '". $post['media_link'] . "' height = '300px' width = '400px'>\n<br>\n";
            }
            $conn->prepare($sql);
            $comments = $conn->query($sql);
            echo "Comments: <br>\n";
            foreach($comments as $comm)
            {
                echo "<b>".$comm['first_name'] . " " . $comm['last_name'] .    ":</b> " . $comm['text_content'] . "<br>\n";
            }
            echo "<form method = 'post' class = 'commenting' action = 'comment.php'>\n";
            echo "<input type = 'text' id = 'comment|". $post['post_id'] ."' class = 'comment' name = 'comment' placeholder = 'Write a comment...'>\n<input type = 'submit' value = 'Comment' id = 'comment-button'>\n <input type = 'text' id = 'hidden|". $post['post_id'] ."' class = 'post_identifier' name = 'hidden_val' hidden = 'true' value = ". $post['post_id'] ."></form><br><br><br>\n";

        }
    ?>
    </div>
</body>