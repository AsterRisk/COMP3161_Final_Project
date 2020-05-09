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
            $sql2 = 'call searchGroup("%'. $_GET['searchVal'] . '%");';
            $conn->prepare($sql2);
            $found_groups = $conn->query($sql2);
        ?>
        <br>
        <br>

        <div class="w3-container w3-card w3-white w3-round w3-margin">

                <?php
                    echo "<h4 class = \"w3-opacity\" style = 'margin-top:20px;'>";
                    echo $found_groups->num_rows . " group(s) found.</h4>";
                    if($found_groups)
                    {
                ?>
                <table style = "width:100%;" class = "table">
                <thead class = "thead-dark" style = "text-align:center">
                    <tr>
                        <th>Group Picture</th>
                        <th>Group Name</th>
                        <th>Visit Page</th>
                    </tr>
                </thead>
                <?php
                        foreach ($found_groups as $row)
                        {
                           if($row['group_dp_location'] != NULL)
                           {
                               $text = "<tr style = \"text-align:center\"><td><img src = '". $row['group_dp_location'] ."' style = 'height:50px;width:50px;border-radius:50%;'></td><td> ". $row['group_name'] ." </td>";
                           }
                           else
                           {
                               $text = "<tr style = \"text-align:center\"><td><img src = '../assets/default_imgs/default_group.png' style = 'height:50px;width:50px;border-radius:50%;'></td><td> ". $row['group_name'] ." </td>";
                           }

                           echo $text; 
                           ?>

                            <td>
                                <form method = "GET" action = "view_group.php">
                                    <?php
                                        $hidden = "<input type = \"text\" style = \"display:none;\" name = 'group_id' value = ".$row['group_id'].">";
                                        echo $hidden;
                                        $bttn = "<button type = 'submit' value = 'Go to ". $row['group_name'] . "'><img src = '../assets/default_imgs/left-arrow.png' style= 'height:10px;width:10px;margin-left:15px;margin-right:15px;'></button>";
                                        echo $bttn;
                                    ?>
                                </form>
                            </td>
                        <?php    

                        }
                    }
                ?>
            </table>
        </div>
    </body>
    <?php include 'footer.php'; ?>
</html>