<!DOCTYPE html>
<html>
<head>
    <title>Login to SocialBook</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php
        include 'sql_setup.php';
        $sql = "select*from logins where email = '".htmlspecialchars($_POST['register_email'])."';";
        $conn->prepare($sql);
        $results = $conn->query($sql);
        if($results->num_rows > 0)
        {
            //$_SESSION['err_flag'] = 1;
            header("Location: registration_error.php");
        }
        else
        {
            
            $newID = "(select count(user_id) from users as num_users)";
            $conn->prepare($newID);
            $ID = $conn->query($newID)->fetch_assoc()['count(user_id)'];
            $email = $_POST['register_email'];
            $pass = $_POST['register_password'];
            $pass2 = $_POST['double_register_password'];
            $fName = $_POST['first_name'];
            $lName = $_POST['last_name'];
            $tele = $_POST['register_tele'];
            $addr = $_POST['address'];
            $salt = rand(1, 10000);
            $dates = explode("-", $_POST['register_birthday']);
            $birthday = $dates[0] . "/" . $dates[1] . "/" . $dates[2];
           
            
        }

        $target_dir = "../assets/".$ID."/";
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
        if($pass !== $pass2)
        {
            echo "Problem";
            echo "<br>Pass 1: " . $pass;
            echo "<br>Pass 2: " . $pass2;
            //header("Location: registration_error_2.php");
        }
        else
        {
            $pass = $pass . $salt;
            $pass_digest = hash("sha256", $pass);
            $sql = "insert into users (user_id, first_name, last_name, email, home_address, tele_num, dob, profile_pic_address, clearance) values (". $ID . ", '" . $fName . "', '" . $lName . "', '" . $email . "', '" . $addr . "', '" . $tele . "', '" . $birthday . "', '" . $target_file . "', 2);"; 
            $sql2 = "insert into logins (user_id, email, pass_digest, salt) values (" . $ID . ", '" . $email . "', '" . $pass_digest . "', " . $salt .");";
            
            echo "SQL1: " . $sql;
            echo "<br>SQL2: " . $sql2;
            $conn->prepare($sql);
            $conn->query($sql);
            $conn->prepare($sql2);
            $conn->query($sql2);
            //$ID = $conn->query($newID)->fetch_assoc();
            $_SESSION['id'] = $ID;
            unset($sql);
            header("Location: home.php");
        }  
        
        
    ?>
    </body>
</html>