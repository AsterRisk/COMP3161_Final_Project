<!DOCTYPE html>

<html>
    <head>
        <title>Search: <?php echo $_GET['searchVal']; ?></title>
        <link rel="icon" href="../assets/default_imgs/logo.png">
        <?php 
            include 'header.php';
            include 'sql_setup.php';
        ?>
    </head>
    <body>
        <?php
            $sql = 'call searchUser("%'. $_GET['searchVal'] . '%");';
            $conn->prepare($sql);
            $found_users = $conn->query($sql);
            $sql2 = 'call searchGroup("%'. $_GET['searchVal'] . '%");';
            $conn->prepare($sql2);
            $found_groups = $conn->query($sql2);
            
            
            //echo "Users: " . $found_users;
            //echo "\nGroups: " . $found_groups;
        ?>
            <br>
            <br>
            
            <div class="w3-container w3-card w3-white w3-round w3-margin">
                
                    <?php 
                        echo "<h4 class = \"w3-opacity\" style = 'margin-top:20px;'>";
                        echo $found_users->num_rows . " user(s) found.</h4>";
                    ?> 
                    
                <br>
                
            
            <?php
                if($found_users)
                {
                    ?>
                    <table style = "width:100%;" class = "table" style = "padding-left:10px;">
                    <thead class = "thead-dark" style = "text-align:center">
                    <tr>
                        <th>Profile Picture</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Visit Page</th>
                    </tr>
                    </thead>
            <?php
                    foreach ($found_users as $row)
                    {
                       if ($row['user_id'] != 0)
                       {
                           if($row['profile_pic_address'] != NULL)
                           {
                               $text = "<tr style = \"text-align:center\"><td><img src = '". $row['profile_pic_address'] ."' style = 'height:50px;width:50px;border-radius:50%;'></td><td> ". $row['first_name'] ." </td>". " <td> ". $row['last_name'] ." </td><hr>";
                           }
                           else
                           {
                               $text = "<tr style = \"text-align:center\"><td><img src = '../assets/default_imgs/default_profile_picture.png' style = 'height:50px;width:50px;border-radius:50%;'></td><td> ". $row['first_name'] ." </td>". " <td> ". $row['last_name'] ." </td>";
                           }

                           echo $text; 
                           ?>

                            <td>
                                <form method = "GET" action = "view_friend.php">
                                    <?php
                                        $hidden = "<input type = \"text\" style = \"display:none;\" name = 'friend_id' value = ".$row['user_id'].">";
                                        echo $hidden;
                                        $bttn = "<button type = 'submit' value = 'Go to ".$row['first_name'] . " " . $row['last_name'] . "'><img src = '../assets/default_imgs/left-arrow.png' style= 'height:10px;width:10px;margin-left:15px;margin-right:15px;'></button>";
                                        echo $bttn;
                                    ?>
                                </form>
                            </td>
                    <?php    

                       }
                    }
                    ?>
                    </table>
        <?php
                }
                
        ?>
    
        </div>
    </body>
    <?php include 'footer.php'; ?>
</html>
    
