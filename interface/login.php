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
            $sql = "select*from logins where email = '".htmlspecialchars($_POST['user_email'])."';";
            $conn->prepare($sql);
            $results = $conn->query($sql);
            if($results->num_rows > 0)
            {
                $row = $results->fetch_assoc();
                $salt = $row['salt'];
                $pass_digest = $row['pass_digest'];
                $test_pass = htmlspecialchars($_POST['user_password']) . $salt;
                
                if($_POST['user_email'] === "admin@admin.com")
                {
                    header ("Location: admin.php");
                    exit();
                }
                
                if (hash("sha256", $test_pass) === $pass_digest)
                {
                    session_start();
                    ob_start();
                    $_SESSION['valid'] = true;
                    $_SESSION['timeout'] = time();
                    $_SESSION['username'] = $row['email'];
                    $_SESSION['id'] = $row['user_id'];
                    header ("Location: home_page.php");
                    exit();
                }
                else
                {
                    echo "Incorrect Password<br>";
                    
                }
            }
            else
            {
                //echo "<h1>USERNAME NOT FOUND!</h1>";
            }
            
        ?>
    </body>
</html>