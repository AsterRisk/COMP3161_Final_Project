<?php
    if(!isset($_SESSION))
    {
        session_start();
        //include 'login.php';
        $servername = "localhost";
        $username = "root";
        $password = "";
        
        $conn = new mysqli($servername, $username, $password);
        if ($conn->connect_error)
        {
            die("Connection to database failed: " . $conn->connect_error);
        }
        else
        {
            //echo $_SESSION['id'];
            $sql = "use final_proj_3161;";
            $conn->prepare($sql);
            $conn->query($sql);
        }
    }
?>