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
        
        $target_dir = "../assets/".$_SESSION['id']."/";
        if(!is_dir($target_dir))
        {
            mkdir($target_dir);
        }
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        $uploadOk = 1;
        
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                //echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
            $target_file = 'NULL';
    // if everything is ok, try to upload file
        } 
        else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            } 
            else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    
        $sql = "insert into posts (post_id, user_id, text_content, media_link) values ((select count(post_id) from posts as num_posts)+1, ". $_SESSION['id'].", \"".$_POST['text_content']."\", '".$target_file."');";
        //echo $sql;
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













































    