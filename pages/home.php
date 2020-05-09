<!DOCTYPE html>
<html>

<head>
    <link rel="icon" href="../assets/default_imgs/logo.png">
    <link rel="shortcut icon" href="../assets/default_imgs/logo.png">
    <?php
        include 'header.php';
    ?>
</head>
<body>
<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
</div>

<!-- Page Container -->
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
                $img = "<img src='". $ppa . "' class=\"w3-circle\" style=\"height:200px;width:200px\" alt=\"Avatar\">";
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
    
    <!-- Middle Column -->
    <div class="w3-col m7">
    
      <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
              <h4 class="w3-opacity">Tell us what's happening!</h4>
                <form id = 'post_to_wall' method = 'POST' action = "posting.php" enctype="multipart/form-data" >
                <textarea id = 'text_content' name = 'text_content' rows = '5' cols = 89 width = '100%' placeholder = 'Tell us about your day!'></textarea>
                <br>
                <h6 class = "w3-opacity">Upload an image!</h6>
                    
                <input type="file" name="fileToUpload" id="fileToUpload">
                    <br>
                    <br>
                <!--<input type="submit" value="Upload Image" name="submit">-->
                <button type="submit" class="w3-button w3-theme" value = "Post" styles = "float:right">Post! <i class="fa fa-pencil"></i></button>
                </form>
            </div>
          </div>
        </div>
      </div>
        <div id = "timeline" style = "width:100%;">
        <?php
            $sql = "select post_id, posts.user_id, text_content, media_link, fgroup from posts join friends where friends.friend_id != 0 and posts.user_id = friends.friend_id and friends.user_id =". $_SESSION['id']." order by post_id desc;";
            $conn->prepare($sql);
            $results = $conn->query($sql);
            if($results->num_rows == 0)
            {
                ?>
                <div class="w3-container w3-card w3-white w3-round w3-margin" ><br>
                    <h4 class = "w3-opacity">No posts yet :(</h4>
                    <br>
                    <p>Add some friends to spruce up your timeline!</p>
                </div>
                <?php
            }
            foreach($results as $post)
            {
                //echo"Hi!";
                $sql = "select profile_pic_address, first_name, last_name from users where user_id = " .$post['user_id'];
                $conn->prepare($sql);
                $friend_data = $conn->query($sql)->fetch_assoc();
                ?>
                <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
                     <?php
                        $fppa = $friend_data['profile_pic_address'];
                        if(($fppa === NULL) || (strcasecmp($fppa, "null") == 0))
                        {
                            $fppa = "../assets/default_imgs/default_profile_picture.png";
                        }
                        $img = "<img src='" . $fppa . "' alt=\"Avatar\" class=\"w3-left w3-circle w3-margin-right\" style=\"width:70px;height:70px;\">";
                        echo $img;
                    ?>
                    <h4><?php echo strtoupper($friend_data['first_name']) . " " . strtoupper($friend_data['last_name']);?></h4>
                    <hr class="w3-clear">
                    <br>
                    <p><?php echo $post['text_content'];  ?></p>
                    <div class="w3-row-padding" style="margin:0 -16px">
                        
                            <?php
                                if(($post['media_link'] == NULL) || ((strcasecmp($post['media_link'], "NULL")) == 0))
                                {
                                    
                                }
                                else
                                {
                                    $img = "<img src=\"". $post['media_link']."\" style=\"width:100%;max-width:200px;height:100%;max-height:200px;\" alt=\"IMAGE.PNG\" class=\"w3-margin-bottom\">";
                                    echo $img;
                                }
                            ?>
                            <form method = 'post' class = 'commenting' action = 'comment.php'>
                            <?php
                                $sql = "select first_name, last_name, text_content, media_link from users join comments where users.user_id = comments.user_id and comments.post_id = ".$post['post_id'].";";
                                $conn->prepare($sql);
                                $comments = $conn->query($sql);
                                echo "<div style = \"width = 100%;\"><h5>Comments:</h5><hr class=\"w3-clear\">\n";
                                if($comments->num_rows == 0)
                                {
                                    echo "<h5 class=\"w3-opacity\">No comments yet...</h5>";
                                }
                                else
                                {
                                    foreach($comments as $comm)
                                    {
                                        echo "<b>".strtoupper($comm['first_name']) . " " . strtoupper($comm['last_name']) .    ":</b> " . $comm['text_content'] . "<br>\n";
                                    }
                                }
                                $comment = "<hr class = 'w3-clear'>\n<div class = 'w3-container w3-padding w3-card w3-white' style = 'margin-bottom:10px;margin-top:10px;'>\n<br>\n<span style = \"display:inline;\"><h5 class = 'w3-opacity'>Write a comment...</h5><input type = 'text' id = 'comment|". $post['post_id'] ."' class = 'w3-padding w3-border comment' name = 'comment' placeholder = '' style = 'width:80%'>\n\n <input type = 'text' id = 'hidden|". $post['post_id'] ."' class = 'post_identifier' name = 'hidden_val' hidden = 'true' value = ". $post['post_id'] .">";
                                echo $comment;
                            
                                $bttn = "<button style = 'margin-top:5px;' type=\"submit\" class=\"w3-button w3-theme-d2 w3-margin-bottom\" style = \"margin-top:5px;\">Comment <i class=\"fa fa-comment\"></i></span></button></div>"; 
                                echo $bttn;
                            ?>
                            </form>
                        
                    </div>
                </div>
        <?php
               echo "</div>"; 
            }

        ?>
    </div>
    <!-- End Middle Column -->
    </div>
    
    <!-- Right Column -->
    <div class="w3-col m2">
      <br>
      
      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container" style = "margin-top:-18px;">
          <h4 style = "margin-top:6px;"><b>Friend Requests:</b></h4>
            <?php
                $sql = "select user_id, first_name, last_name, profile_pic_address, requester_id, requestee_id from users join friend_requests where user_id = requester_id and requestee_id = " . $_SESSION['id'] . ";";
                $conn->prepare($sql);
                $friendReqs = $conn->query($sql);
                foreach($friendReqs as $request)
                {
                    if(($post['media_link'] != NULL) && ((strcasecmp($post['media_link'], "NULL")) != 0))
                    {
                        $img = "<img src=\"". $request['profile_pic_address']."\" style=\"width:30%;height:40%\" alt=\"IMAGE.PNG\" class=\"w3-margin-bottom\">";
                        echo $img;
                    }
                    else
                    {
                        $img = "<img src=\"../assets/default_imgs/default_profile_picture.png \" style=\"width:30%;height:40%\" alt=\"IMAGE.PNG\" class=\"w3-margin-bottom\">";
                        echo $img;
                    }
                    $span = "<br><span>". strtoupper($request['first_name']) . " " . strtoupper($request['last_name'])."</span>\n";
                    echo $span;
                    ?>
                    
                    <div class="w3-row w3-opacity">
                        <div class="w3-half">
                            
                            <?php
                                echo "<form class = 'friend_Accept' method = 'POST' action = 'accept_friend.php'>";
                                $acceptBttn = "<button class=\"w3-button w3-block w3-green w3-section fr_accept\" title=\"Accept\" id = 'a:".$request['requester_id']."|".$request['requestee_id'] ."'><i class=\"fa fa-check\" type = \"submit\"></i></button>";
                                $requesterInfo = "<input type=\"text\" style = \"display: none;\" value = '".$request['requester_id'] . "' name = \"requesting\">\n";
                                $requesteeInfo = "<input type=\"text\" style = \"display: none;\" value = '".$request['requestee_id'] . "' name = \"requested\">\n";   
                                   
                                echo $requesterInfo;
                                echo $requesteeInfo;
                                echo $acceptBttn;
                                echo "</form>";
                            ?>
                        </div>
                        <div class="w3-half">
                            <?php
                                echo "<form class = 'friend_Deny' method = 'POST' action = 'deny_friend.php'>";
                                $denyBttn = "<button class=\"w3-button w3-block w3-red w3-section fr_deny\" title=\"Decline\" id = 'd:".$request['requester_id']."|".$request['requestee_id'] ."'><i class=\"fa fa-remove\" type = \"submit\"></i></button>\n\n";
                                $requesterInfo = "<input type=\"text\" style = \"display: none;\" value = '".$request['requester_id'] . "' name = \"requesting\">\n";
                                $requesteeInfo = "<input type=\"text\" style = \"display: none;\" value = '".$request['requestee_id'] . "' name = \"requested\">\n";   
                                    
                                echo $requesterInfo;
                                echo $requesteeInfo;
                                echo $denyBttn;
                    
                                echo "</form>";
                            ?>
                          
                        </div>  
                    </div>
                    
            <?php
                }
            ?>   
        </div>
      </div>
      <br>
      
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>
<script>
// Accordion
function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-theme-d1";
  } else { 
    x.className = x.className.replace("w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-theme-d1", "");
  }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
    
</script>
<!-- Footer -->
<?php
    unset($sql);
    unset($results);
    unset($fppa);
    unset($comments);
    unset($bttn);
    include 'footer.php';
?>
 


</body>
</html> 
