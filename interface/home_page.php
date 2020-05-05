<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
</head>
<body>
    <?php
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
            $sql = "select users.user_id, first_name, last_name, fgroup from users join friends where ((users.user_id = friends.friend_id) and friends.user_id = ".$_SESSION['id'].");";
            //echo $sql;
            $conn->prepare($sql);
            $results = $conn->query($sql);
            //var_dump($results);
            //echo($sql);
    ?>
            <h1>FRIENDS LIST:</h1>
            <br>
            <br>
            <table>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Group</th>
                </tr>
    <?php
            
            foreach($results as $row)
            {
                $text = "<tr> ". "<td> ". $row['first_name'] ." </td>". " <td> ". $row['last_name'] ." </td><td> ". $row['fgroup'] ." </td></tr> ";
                echo $text; 
            }
        }
    ?>
    </table>
</body>