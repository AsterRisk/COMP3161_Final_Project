<?php
    include 'sql_setup.php';
    //include 'header.php';
    $sql = "select * from logins where user_id = " . $_SESSION['id'] .";";
    $conn->prepare($sql);
    $loginData = $conn->query($sql)->fetch_assoc();
    $entered_pass_digest = (hash("sha256", ($_POST['pass'] . $loginData['salt'])));
    if(strcmp($entered_pass_digest, $loginData['pass_digest']) == 0)
    {
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
            $target_file = '../assets/default_imgs/default_profile_picture.png';
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
        echo "password matches, commencing update";
        $sql = "update users set email = '" . $_POST['new_email'] . "' , tele_num = '" . $_POST['new_tele'] . "', first_name = '" . $_POST['new_f_name'] . "', last_name = '" . $_POST['new_l_name'] . "', dob = '" . $_POST['new_dob'] . "', home_address = '" . $_POST['new_address'] . "', profile_pic_address = '" . $target_file . "' where user_id = " . $_SESSION['id'] .";";
        echo "<br>" . $sql;
    
    
        $conn->prepare($sql);
        $success1 = $conn->query($sql);
        $sql = "update logins set email = '" . $_POST['new_email'] . "' where user_id = " . $_SESSION['id'] . ";";
        $conn->prepare($sql);
        $success2 = $conn->query($sql);
        if($success and $success2)
        {
            echo "successful update.";
            header ("Location: modify_profile.php");
        }
        else
        {
            ?>
            <script>
                alert("Error, Making this change would cause duplicate values. Try something else.");
                window.location.replace("modify_profile.php");
            </script>
<?php
        }
    }
    else
    {
        ?>
        <script>
            alert("Error, passwords do not match. Please re-enter.");
            window.location.replace("modify_profile.php");
        </script>
<?php
    }

    ?>