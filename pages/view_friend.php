<html>
<head>
    <link rel="icon" href="../assets/default_imgs/logo.png">
    <link rel="shortcut icon" href="../assets/default_imgs/logo.png">
    <?php
        include 'sql_setup.php';
        
        include 'header.php';
        $sql = "select * from users where user_id = " . $_GET['friend_id'] . ";";
        $conn->prepare($sql);
        $conn->query($sql);
        $user_data = $conn->query($sql)->fetch_assoc();
    ?>
    <title><?php echo $user_data['first_name'] . " " . $user_data['last_name'];?></title>
</head>
<body>
<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large"></a>
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
         <h4 class="w3-center"><?php echo $user_data['first_name'] . " " . $user_data['last_name']; ?></h4>
         <p class="w3-center">
            <?php
                $sql = "select * from friends where friends.user_id = ".$_GET['friend_id']." and friends.friend_id =" . $_SESSION['id'] . ";";
                $conn->prepare($sql);
                $isFriend = $conn->query($sql)->num_rows;
                if($user_data['profile_pic_address'])
                {
                    $img = "<img src='". $user_data['profile_pic_address'] . "' class=\"w3-circle\" style=\"height:200px;width:200px\" alt=\"Avatar\">";
                    echo $img;
                }
                else
                {
                    $img = "<img src='../assets/default_imgs/default_profile_picture.png' class=\"w3-circle\" style=\"height:200px;width:200px\" alt=\"Avatar\">";
                    echo $img;
                }
             ?>
        </p>
         <hr>
        <?php
            if($isFriend)
            {
                ?>
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
                     <p><img src = "../assets/default_imgs/phone.png" style = "height:23px;width = 23px;margin-right:10px;"> 
                        <?php
                            echo $user_data['tele_num'];
                         ?>
                    </p>
                    <hr>
                    <p><img src = "../assets/default_imgs/email.png"style = "height:23px;width = 23px;margin-right:10px;"> 
                        <?php
                            echo "<a href = 'mailto :"  . $user_data['email'] . "' target = '_blank'>". $user_data['email'] ."</a>" ;
                         ?>
                    </p>
                <?php
            }
            else
            {
                echo "<p>Add this user as a friend to view this information.</p><hr>";
            }
        ?>
         
        </div>
      </div>
      <br>
      
      <!-- Accordion -->
      <div class="w3-card w3-round">
        <div class="w3-white">
          <button onclick="window.location.href='groups.php'" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i>My Groups</button>
          <button onclick="window.location.href='friends.php'" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i>Back to My Friends</button>
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
    
      <!--<div class="w3-row-padding">
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
                <!--<input type="submit" value="Upload Image" name="submit">
                <button type="submit" class="w3-button w3-theme" value = "Post" styles = "float:right">Post! <i class="fa fa-pencil"></i></button>
                </form>
            </div>
          </div>
        </div>
      </div>-->
        <div id = "timeline" style = "width:100%;">
        <h4 class = "w3-opacity"><?php echo $user_data['first_name'] . "'s Posts:"; ?></h4>
        <?php
            if($isFriend)
            {
                $sql = "select post_id, posts.user_id, text_content, media_link from posts where posts.user_id = ". $_GET['friend_id']." order by post_id desc;";
                $conn->prepare($sql);
                $results = $conn->query($sql);
                if($results->num_rows == 0)
                {
                    echo "No posts yet :(. Add some friends and spruce up your timeline!";
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
                            $img = "<img src='" . $fppa . "' alt=\"Avatar\" class=\"w3-left w3-circle w3-margin-right\" style=\"width:75px;height:75px;\">";
                            echo $img;
                        ?>
                        <h4><?php echo strtoupper($friend_data['first_name']) . " " . strtoupper($friend_data['last_name']);?></h4>
                        <hr class="w3-clear">
                        <p><?php echo $post['text_content'];  ?></p>
                        <div class="w3-row-padding" style="margin:0 -16px">

                                <?php
                                    if(($post['media_link'] == NULL) || ((strcasecmp($post['media_link'], "NULL")) == 0))
                                    {

                                    }
                                    else
                                    {
                                        $img = "<img src=\"". $post['media_link']."\" style=\"width:100%;height:100%;max-height:200px;max-width:200px\" alt=\"IMAGE.PNG\" class=\"w3-margin-bottom\">";
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
                                    $comment = "<hr class = 'w3-clear'><div class = 'w3-container w3-card w3-white'><br><span style = \"display:inline;\"><h5 class = 'w3-opacity'>Write a comment...</h5><br><input type = 'text' id = 'comment|". $post['post_id'] ."' class = 'comment' name = 'comment' placeholder = '' style = 'width:80%'>\n\n <input type = 'text' id = 'hidden|". $post['post_id'] ."' class = 'post_identifier' name = 'hidden_val' hidden = 'true' value = ". $post['post_id'] .">";
                                    echo $comment;
                                $bttn = "<button style = 'margin-top:5px;' type=\"submit\" class=\"w3-button w3-theme-d2 w3-margin-bottom\" style = \"margin-top:5px;margin-left:5px;\">Comment <i class=\"fa fa-comment\"></i></span></button></div>"; 
                                    echo $bttn;
                                ?>
                                </form>

                        </div>
                    </div>
            <?php
                   echo "</div>"; 
                }

            
            }
            else
            {
                ?>
                    <div class="w3-container w3-card w3-white w3-round w3-margin" ><br>
                        <h3 class = "w3-opacity">Whoa there Snoopy!</h3>
                        <br>
                        <p>Only user's on this person's friend's list can view their posts. Add this user as a friend to see their posts.</p>
                    </div>
                <?php
            }
        ?>
    </div>
    <!-- End Middle Column -->
    </div>
    
    <!-- Right Column -->
    <div class="w3-col m2">
      <br>
      
      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container">
          <?php
                $sql = "select * from friend_requests where requestee_id = ". $_GET['friend_id'] ." and requester_id = " . $_SESSION['id'] . ";";
                $conn->prepare($sql);
                $isRequested = $conn->query($sql)->num_rows;
                
                if((!$isFriend) and (!$isRequested))
                {
                    ?>
                        
                    <h4 style = "margin-top:20px;"><b>Send Friend Request?</b></h4>
            
            
                    <form method = "POST" action = "requestFriend.php">
                        
                        <?php
                            echo "<input type = \"text\" style = \"display:none;\" name = \"requesting_user\" value = " . $_SESSION['id'] .">\n";
                            echo "<input type = \"text\" style = \"display:none;\" name = \"requested_user\" value = " . $_GET['friend_id'] .">\n";
                            $acceptBttn = "<button class=\"w3-button w3-block w3-green w3-section fr_accept\" title=\"Send\"><i class=\"fa fa-check\" type = \"submit\"></i></button>";
                            echo $acceptBttn;
                        ?>
                    </form>
                
         <?php   
                    
                }
                else
                {
                    if(!$isFriend)
                    {
                    ?>
                    <h4 style = "margin-top:20px;"><b>Friend Request Sent.</b></h4>
                    <?php
                    }
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
<?php
    include 'footer.php';
?>

 


</body>
</html> 
