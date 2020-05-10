<?php
    include 'sql_setup.php';
    include 'header.php';
?>
<body>
<script src = "../js/modify_user.js"></script>
    <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div id = "profile info" style = "position:fixed;width:20%;">
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center" style = "margin-top:15px;">My Profile</h4>
         <p class="w3-center">
            <?php
                if(strcmp($ppa, '..assets/default_imgs/default_profile_picture.png') != 0)
                    {
                        $img = "<a href = \"home.php\"><img src='". $ppa . "' class=\"w3-circle\" style=\"height:200px;width:200px\" alt=\"Avatar\" title = 'Back to Home'></a>";
                    }
                    else
                    {
                        $img = "<a href = \"modify_profile.php\"><img src='..assets/default_imgs/default_profile_picture.png' class=\"w3-circle\" style=\"height:200px;width:200px\" alt=\"Avatar\" tooltip = 'Back to Home'></a>";
                    }
                    echo $img;
             ?>
        </p>
         <hr>
         <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> 
            <?php
                echo $user_data['home_address'];
             ?>
            </p>
        <hr>
         <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> 
            <?php
                echo $user_data['dob'];
             ?>
        </p>
        <hr>
        <p style = "text-align:center;">
            <button style = "height=23px;width=23px;float:center;" onclick="window.location.href='logout.php'"><img src = "../assets/default_imgs/logout_x.png" style = "height=23px;width=23px;" >Logout</button>    
        </p>
        </div>
      </div>
      <br>
      
      <!-- Accordion -->
      <div class="w3-card w3-round">
        <div class="w3-white">
          <button onclick="window.location.href='groups.php'" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> My Groups</button>
          <button onclick="window.location.href='create_group.php'" class="w3-button w3-block w3-theme-l1 w3-left-align"><img src = "../assets/default_imgs/plus_sign.png" style = "margin-right:20px;height:20px;width:20px;">Create Group</button>
          <button onclick="window.location.href='friends.php'" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i>My Friends</button>
          <button onclick="myFunction('searchBar')" class="w3-button w3-block w3-theme-l1 w3-left-align"><img src = "../assets/default_imgs/magnifying_glass.png" style = "margin-right:20px;height:20px;width:20px;">Search For Users</button>
          <div id = "searchBar" class = "w3-container w3-hide">
            <span>
                <form id = "searchBox" method = "GET" action = "search.php">
                    <input type = "text" placeholder = "Search for users..." style = "width:87%" name = "searchVal">
                    <button type = "submit"><img src = "../assets/default_imgs/magnifying_glass.png" style = "height:15px;width:15px;"></button>
                </form>
            </span>
          </div>
         <button onclick="myFunction('searchBar1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><img src = "../assets/default_imgs/magnifying_glass.png" style = "margin-right:20px;height:20px;width:20px;">Search For Groups</button>
          <div id = "searchBar1" class = "w3-container w3-hide">
            <span>
                <form id = "searchBox" method = "GET" action = "search_groups.php">
                    <input type = "text" placeholder = "Search for groups..." style = "width:87%" name = "searchVal">
                    <button type = "submit"><img src = "../assets/default_imgs/magnifying_glass.png" style = "height:15px;width:15px;"></button>
                </form>
            </span>
          </div>
          <button onclick="window.location.href='photos.php'" class="w3-button w3-block w3-theme-l1 w3-left-align"><img src = "../assets/default_imgs/photos.png" style = "margin-right:20px;height:20px;width:20px;">My Photos</button>
          
        </div> 
      </div>
    </div>
      <br>
      <br>
      
      <!-- Alert Box -->
    <!-- End Left Column -->
    </div>
        <!--Middle-->
       <div class="w3-col m7">
          <div class="w3-container w3-card w3-white w3-round w3-margin" ><br>
            <h3 class = "w3-opacity">Modify Profile</h3>
            <br>
              <br>
           </div>
              <div id = "profile info" style = "width:90%;margin-left:40px;">
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <form method = "POST" action = "modify_user.php" enctype = "multipart/form-data">
            <h4 class="w3-center" style = "margin-top:15px;"><?php echo $user_data['first_name'] . " " . $user_data['last_name'];?></h4>
             <p class="w3-center">
                <?php
                    if(strcmp($ppa, '..assets/default_imgs/default_profile_picture.png') != 0)
                        {
                            $img = "<img src='". $ppa . "' class=\"w3-circle\" style=\"height:200px;width:200px\" alt=\"Avatar\" >";
                        }
                        else
                        {
                            $img = "<img src='..assets/default_imgs/default_profile_picture.png' class=\"w3-circle\" style=\"height:200px;width:200px\" alt=\"Avatar\" tooltip = 'Modify my Profile'>";
                        }
                        echo $img;
                 ?>
                 
            </p>
             
             <h5 class = "w3-opacity">Change Profile Picture</h5>
                    
                <input type="file" name="fileToUpload" id="fileToUpload">
                    <br>
                    <br>
             <hr>
             <label for = "new_f_name" class = "w3-opacity">Change First Name:</label>
                <?php
                    echo '<input class = "user_data" type = "text" name = "new_f_name" value = "'.$user_data['first_name'] . '" style = "margin-left:35px;width:90%;" >';
                 ?>
            <hr>
             <label for = "new_l_name" class = "w3-opacity">Change Last Name:</label>
                <?php
                    echo '<input class = "user_data" type = "text" name = "new_l_name" value = "'.$user_data['last_name'] . '" style = "margin-left:35px;width:90%;" >';
                 ?>
            <hr>
             <label for = "new_address" class = "w3-opacity">Change Address:</label>
             <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme title = 'Change Address'"></i>
             
                <?php
                    echo '<input class = "user_data" type = "text" name = "new_address" value = "'.$user_data['home_address'] . '" style = "width:90%;" >';
                 ?>
                </p>
            <hr>
             <label for = "new_dob" class = "w3-opacity">Change Birthday:</label>
             <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> 
                <?php
                    echo '<input id = "change_dob" class = "user_data" type = "date" name = "new_dob" value = "'.$user_data['dob'] . '" style = "width:90%;" >';
                 ?>
            </p>
             <hr>
             <label for = "new_tele" class = "w3-opacity">Change Telephone:</label>
                <?php
                    echo '<input id = "change_tele" class = "user_data" type = "text" name = "new_tele" value = "'.$user_data['tele_num'] . '" style = "margin-left:35px;width:90%;" >';
                 ?>
             <hr>
             <label for = "new_email" class = "w3-opacity">Change Email:</label>
                <?php
                    echo '<input id = "change_email" class = "user_data" type = "text" name = "new_email" value = "'.$user_data['email'] . '" style = "margin-left:35px;width:90%;" >';
                 ?>
             <hr>
             <label for = "pass" class = "w3-opacity">Enter Password to confirm changes:</label>
                <?php
                    echo '<input type = "password" name = "pass" placeholder = "Enter password..." style = "margin-left:35px;width:90%;" >';
                 ?>
             <hr>
             <button id = "makeChanges" type = "submit" class = "w3-button w3-block w3-green w3-section fr_accept"><i class="fa fa-check"></i></button>
            <!--GET STUFF FOR THE OTHER ATTRIBUTES (EMAIL, TELEPHONE, NAMES) -->
         </form>
            
        </div>
      </div>
      <br>
    </div>
           </div>
       </div>
    </div>
    <br>
    <br>
    <br>

    
</body>
<?php
    include 'footer.php';
?>