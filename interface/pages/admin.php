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
            include 'sql_setup'.php;
            echo "<h3>Registered SocialBook Users:</h3><br><br>";
            
            $sql = "use final_proj_3161;";
            $conn->prepare($sql);
            $conn->query($sql);
            $sql = "SELECT * from users;";
            $conn->prepare($sql);
            $results = $conn->query($sql);
            ?>
            <table>
                <tr>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                </tr>
                <?php
                    foreach ($results as $row)
                    {
                       if ($row['user_id'] != 0)
                       {
                           $text = "<tr><td> ". $row['user_id'] ." </td>" . "<td> ". $row['first_name'] ." </td>". " <td> ". $row['last_name'] ." </td><td> ". $row['email'] ." </td></tr> ";
                            echo $text; 
                       }
                    }
                    echo "<br><br>Registered users: " . $results->num_rows;
                ?>
                
            </table>
    <?php        
        $conn->close();
    ?>
</body>