<!DOCTYPE html>
<html>
    <head>
        <title>Login to SocialBook</title>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src = "../js/index.js"></script>
    </head>
    <body>
    <form method = "POST" action = "login.php" id = "login">
        <label for = "user_email">Email: </label>
        <input type = "text" id = "user_email" name = "user_email">
        <br>
        <label for = "user_pass">Password: </label>
        <input type = "password" id = "user_password" name = "user_password">
        <input type = "submit" value = "Login">
    </form>
    </body>
</html>