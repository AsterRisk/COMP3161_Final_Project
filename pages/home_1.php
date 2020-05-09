<!DOCTYPE html>
<html>
<?php
    include 'sql_setup.php';
    $sql = "select * from users where user_id = " . $_SESSION['id'] . ";";
    $conn->prepare($sql);
    $user_data = $conn->query($sql)->fetch_assoc();
    //$_SESSION['id'] = 1001;
?>
<title><?php echo $user_data['first_name'] . " " . $user_data['last_name']; ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
</style>
<body class="w3-theme-l5">

<!-- Navbar -->
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Logo</a>
    <button class="w3-button w3-padding-large" title="Notifications"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">3</span></button>
     <?php
        $ppa = $user_data['profile_pic_address'];
        if(($ppa === NULL) || (strcasecmp($ppa, "null") == 0))
        {
            $ppa = "../assets/default_imgs/default_profile_picture.png";
        }
        $img = "<img src='". $ppa . "' class=\"w3-circle\" style=\"height:37px;width:37px;float:right;margins:10px;\" alt=\"Avatar\">";
        echo "<span style = 'float:right;'>".$user_data['first_name'] . " " . $user_data['last_name'] . "        " .$img . "</span>";
    ?>
    <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
      <a href="#" class="w3-bar-item w3-button">One new friend request</a>
    </div>
  </div>
  <a href="#" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
  </a>
 </div>
</div>

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
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center">My Profile</h4>
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
         <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> 
            <?php
                echo $user_data['dob'];
             ?>
        </p>
        <p>
            <button style = "height=23px;width=23px;float:center;" onclick="window.location.href='login.php'"><img src = "../assets/default_imgs/logout_x.png" style = "height=23px;width=23px;" >         Logout</button>    
        </p>
        </div>
      </div>
      <br>
      
      <!-- Accordion -->
      <div class="w3-card w3-round">
        <div class="w3-white">
          <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> My Groups</button>
          <div id="Demo1" class="w3-hide w3-container">
            <p>Some text..</p>
          </div>
          <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> My Photos</button>
          <div id="Demo3" class="w3-hide w3-container">
         <div class="w3-row-padding">
         <br>
           <div class="w3-half">
             <img src="/w3images/lights.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/mountains.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/forest.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/snow.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
         </div>
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
    
        <?php
            $sql = "select post_id, posts.user_id, text_content, media_link, fgroup from posts join friends where posts.user_id = friends.friend_id and friends.user_id =". $_SESSION['id']." order by post_id desc;";
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
                        $img = "<img src='" . $fppa . "' alt=\"Avatar\" class=\"w3-left w3-circle w3-margin-right\" style=\"width:60px\">";
                        echo $img;
                    ?>
                    <h4><?php echo $friend_data['first_name'] . " " . $friend_data['last_name'];?></h4>
                    <hr class="w3-clear">
                    <p><?php echo $post['text_content'];  ?></p>
                    <div class="w3-row-padding" style="margin:0 -16px">
                        <div class="w3-half">
                            <?php
                                if(($post['media_link'] == NULL) || ((strcasecmp($post['media_link'], "NULL")) == 0))
                                {
                                    
                                }
                                else
                                {
                                    $img = "<img src=\"". $post['media_link']."\" style=\"width:100%\" alt=\"IMAGE.PNG\" class=\"w3-margin-bottom\">";
                                    echo $img;
                                }
                            ?>
                            <form method = 'post' class = 'commenting' action = 'comment.php'>
                            <?php
                                $sql = "select first_name, last_name, text_content, media_link from users join comments where users.user_id = comments.user_id and comments.post_id = ".$post['post_id'].";";
                                $conn->prepare($sql);
                                $comments = $conn->query($sql);
                                echo "<h5>Comments:</h5><hr class=\"w3-clear\">\n";
                                if($comments->num_rows == 0)
                                {
                                    echo "<h5 class=\"w3-opacity\">No comments yet...</h5>";
                                }
                                else
                                {
                                    foreach($comments as $comm)
                                    {
                                        echo "<b>".$comm['first_name'] . " " . $comm['last_name'] .    ":</b> " . $comm['text_content'] . "<br>\n";
                                    }
                                }
                                $comment = "<br><input type = 'text' id = 'comment|". $post['post_id'] ."' class = 'comment' name = 'comment' placeholder = 'Write a comment...' rows = 100>\n\n <input type = 'text' id = 'hidden|". $post['post_id'] ."' class = 'post_identifier' name = 'hidden_val' hidden = 'true' value = ". $post['post_id'] .">";
                                echo $comment;
                            ?>
                                <button type="submit" class="w3-button w3-theme-d2 w3-margin-bottom">Comment <i class="fa fa-comment"></i></button> 
                            </form>
                        </div>
                    </div>
                </div>
        <?php
                
            }

        ?>
        
    <!-- End Middle Column -->
    </div>
    
    <!-- Right Column -->
    <div class="w3-col m2">
      <br>
      
      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container">
          <p>Friend Request</p>
          <img src="/w3images/avatar6.png" alt="Avatar" style="width:50%"><br>
          <span>Jane Doe</span>
          <div class="w3-row w3-opacity">
            <div class="w3-half">
              <button class="w3-button w3-block w3-green w3-section" title="Accept"><i class="fa fa-check"></i></button>
            </div>
            <div class="w3-half">
              <button class="w3-button w3-block w3-red w3-section" title="Decline"><i class="fa fa-remove"></i></button>
            </div>
          </div>
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

<!-- Footer -->
<footer class="w3-container w3-theme-d3 w3-padding-16">
  <h5>Footer</h5>
</footer>

<footer class="w3-container w3-theme-d5">
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>
 
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

</body>
</html> 
