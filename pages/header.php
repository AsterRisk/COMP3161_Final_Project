<?php

        include 'sql_setup.php';
        $sql = "select * from users where user_id = " . $_SESSION['id'] . ";";
        $conn->prepare($sql);
        $user_data = $conn->query($sql)->fetch_assoc();
        echo "<title>".$user_data['first_name'] . " " . $user_data['last_name']."</title>";
        ?>
        <link rel = "icon" href = "../assets/default_imgs/logo.png">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <style>
        html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
        </style>

        <body class="w3-theme-l5">

        <!-- Navbar -->
        <div class="w3-top">
         <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
          <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
          <a href="home.php" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><!--<i class="fa fa-home w3-margin-right"></i>--><img src = "../assets/default_imgs/logo.png" style = "height:20px;width:20px;margin-bottom:7px;">OCIALbook</a>
            <button class="w3-button w3-padding-large" title="Notifications"><i class="fa fa-bell" style = "height:100%;"></i><span class="w3-badge w3-right w3-small w3-green">
                <?php
                    $sql = "select count(requester_id) from friend_requests where requestee_id = ". $_SESSION['id']. ";";
                    $conn->prepare($sql);
                    $friend_requests = $conn->query($sql)->fetch_assoc()['count(requester_id)'];
                    echo $friend_requests;
                ?></span></button>
             <?php
                $ppa = $user_data['profile_pic_address'];
                if(($ppa === NULL) || (strcasecmp($ppa, "null") == 0))
                {
                    $ppa = "../assets/default_imgs/default_profile_picture.png";
                }
                $img = "<img src='". $ppa . "' class=\"w3-circle\" style=\"height:37px;width:37px;float:right;margin-left:5px;margin-top:5px;\" alt=\"Avatar\">";
                echo "<span style = 'float:right;margin-left:5px;margin-top:10px;margin-right:5px;'>".strtoupper($user_data['first_name']) . " " . strtoupper($user_data['last_name']) . "        " . "</span>";
                echo $img;
            ?>
            <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
              <a href="#" class="w3-bar-item w3-button"><?php echo $friend_requests ?> new friend request(s)</a>
            </div>
          </div>
          <a href="#" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
          </a>
         </div>
</body>
<?php
    
    //$_SESSION['id'] = 1001;
?>
    
