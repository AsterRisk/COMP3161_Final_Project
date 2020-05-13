<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="../assets/default_imgs/logo.png">
        <link rel="shortcut icon" href="../assets/default_imgs/logo.png">
        <?php include 'header.php';
                $sql = "select member_id from members where group_id = " . $_GET['group_id'] ." and member_id = " . $_SESSION['id'] . ";";
                $conn->prepare($sql);
                $isMember = $conn->query($sql)->num_rows;;
        ?>
        
    </head>
    <body>
        <?php
            $sql = "select group_name, groups.group_id, member_id, role from members join groups on members.group_id = groups.group_id where member_id = " . $_SESSION['id'] . " and groups.group_id = ". $_GET['group_id'] . ";";
            $conn->prepare($sql);
            $member_data = $conn->query($sql)->fetch_assoc();
            $sql = "select * from group_posts where group_id = " . $_GET['group_id'] . " order by g_post_id desc;";
            //echo "<br><br><br><br><br><br><br><br><br><br>" . $sql;
            $conn->prepare($sql);
            $g_posts = $conn->query($sql);
            $sql = "select * from groups where group_id = " . $_GET['group_id'] . ";";
            $conn->prepare($sql);
            $group_data = $conn->query($sql)->fetch_assoc();
            $sql = "select * from users join groups where user_id = owner_id and group_id = " . $_GET['group_id'] .";";
            $conn->prepare($sql);
            $owner_data = $conn->query($sql)->fetch_assoc();
        ?>
        <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div id = "group info" style = "position:fixed;width:20%;">
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center" style= "margin-top:20px;"><?php echo $group_data['group_name']; ?></h4>
         <p class="w3-center">
            <?php
                $img = "<img src='". $group_data['group_dp_location'] . "' class=\"w3-circle\" style=\"height:200px;width:200px\" alt=\"Avatar\">";
                echo $img;
             ?>
        </p>
         <hr>
        <p class = "w3-center">
            <?php
                $name = $owner_data['first_name'] . " " . $owner_data['last_name'];
                echo "Owned by: " . $name;
             ?> 
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
          <button onclick="window.location.href='photos.php'" class="w3-button w3-block w3-theme-l1 w3-left-align"><img src = "../assets/default_imgs/photos.png" style = "margin-right:20px;height:20px;width:20px;">My Photos</button>
          <form method = "GET" action = "view_members.php">
              <button type = "submit" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i>View Members<input type = "text" name = "group_id" style = "display:none;" value = <?php echo $_GET['group_id'] ?>></button>
          </form>
          
        </div>      
      </div>
    </div>
    <br>
        <br>
      </div>
        <div class="w3-col m7">
            <?php
                if((strcasecmp($member_data['role'], "member") != 0) && (strcasecmp($member_data['role'], "") != 0))
                {
                    ?>
                      <div class="w3-row-padding">
                        <div class="w3-col m12">
                          <div class="w3-card w3-round w3-white">
                            <div class="w3-container w3-padding">
                              <h4 class="w3-opacity">Tell the group what's happening!</h4>
                                <form id = 'post_to_wall' method = 'POST' action = "group_posting.php" enctype="multipart/form-data" >
                                <textarea id = 'text_content' name = 'text_content' rows = '5' cols = 89 width = '100%' placeholder = 'Tell us about your day!'></textarea>
                                <input type = "text" style = "display:none;" value = <?php echo $_GET['group_id'];?> name = "group_id">
                                <br>
                                <h6 class = "w3-opacity">Upload an image!</h6>
                                    
                                <input type="file" name="fileToUpload" id="fileToUpload">
                                <!--<input type="submit" value="Upload Image" name="submit">-->
                                <button type="submit" class="w3-button w3-theme pull-right" value = "Post" styles = "float:right">Post! <i class="fa fa-pencil"></i></button>
                                </form>
                            </div>
                          </div>
                        </div>
                      </div>
            <?php 
                    }
                  else
                  {
                      ?>
                        <div class="w3-container w3-card w3-white w3-round w3-margin" ><br>
                            <h4 class = "w3-opacity">You don't have authority to post in this group.</h4>
                            <br>
                            <p>Only content editors and group owners are allowed to post in groups. Talk to the owner about increasing your privelege.</p>
                        </div>
            <?php
                  }
            ?>
            <div id = "timeline" style = "width:100%;">
            <?php
                if($g_posts->num_rows == 0)
                {
                    ?>
                        <div class="w3-container w3-card w3-white w3-round w3-margin" ><br>
                            <h4 class = "w3-opacity">This group has no posts.</h4>
                            <br>
                        </div>
                <?php
                }
                foreach($g_posts as $gp)
                {
                    $sql = "select * from users join members on user_id = member_id where group_id = ".$_GET['group_id']." and user_id = ". $gp['user_id'] .";";
                    $conn->prepare($sql);
                    $poster_data = $conn->query($sql)->fetch_assoc();
                    ?>
                    <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
                     <?php
                        $pppa = $poster_data['profile_pic_address'];
                        if(($pppa === NULL) || (strcasecmp($pppa, "null") == 0))
                        {
                            $pppa = "../assets/default_imgs/default_profile_picture.png";
                        }
                        $img = "<img src='" . $pppa . "' alt=\"Avatar\" class=\"w3-left w3-circle w3-margin-right\" style=\"width:60px;height:60px;\">";
                        echo $img;
                    ?>
                    <h4><?php echo strtoupper($poster_data['first_name']) . " " . strtoupper($poster_data['last_name']) . " (" . $poster_data['role'] .")";?></h4>
                    <hr class="w3-clear">
                    <br>
                    <p><?php echo $gp['text_content'];  ?></p>
                    <div class="w3-row-padding" style="margin:0 -16px">
                        
                            <?php
                                if(($gp['media_link'] == NULL) || ((strcasecmp($gp['media_link'], "NULL")) == 0))
                                {
                                    
                                }
                                else
                                {
                                    $img = "<img src=\"". $gp['media_link']."\" style=\"width:100%\" alt=\"IMAGE.PNG\" class=\"w3-margin-bottom\">";
                                    echo $img;
                                }
                            ?>
                            <?php
                                $sql = "select first_name, last_name, text_content, profile_pic_address from users join group_comments where users.user_id = group_comments.member_id and group_comments.g_post_id = ".$gp['g_post_id'].";";
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
                                
                            ?>
                            <form method = 'post' class = 'commenting' action = 'group_comment.php'>
                            <?php
                                
                                if($isMember)
                                {
                                    $comment = "<hr class = 'w3-clear'>\n<div class = 'w3-container w3-padding w3-card w3-white' style = 'margin-bottom:10px;margin-top:10px;'>\n<br>\n<span style = \"display:inline;\"><h5 class = 'w3-opacity'>Write a comment...</h5>\n\n<input type = 'text' id = 'comment|". $gp['group_id'] ."' class = 'w3-padding w3-border comment' name = 'comment'  style = 'width:80%'>" . "<input type = 'text' id = 'hidden|". $gp['group_id'] ."' class = 'post_identifier' name = 'group_id' hidden = 'true' value = ". $gp['group_id'] .">\n<input type = 'text' id = 'hidden|". $gp['g_post_id'] ."' class = 'post_identifier' name = 'g_post_id' hidden = 'true' value = ". $gp['g_post_id'] .">";
                                    echo $comment;
                                
                            
                                $bttn = "<button style = 'margin-top:5px;' type=\"submit\" class=\"w3-button w3-theme-d2 w3-margin-bottom\" style = \"margin-top:5px;margin-left:5px;\">Comment <i class=\"fa fa-comment\"></i></span></button></div>"; 
                                echo $bttn;
                            ?>
                            <?php } ?>
                            </form>
                        
                    </div>
                </div>
            <?php
                    echo "</div>";
                }
            ?>
            
        </div>
        </div>
        <div class="w3-col m2">
      <br>
      
      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container" style = "margin-top:-18px;">
          
            <?php
                //echo $isMember;
                if(!$isMember)
                {
                    echo '<h4 style = "margin-top:6px;"><b>Join Group?</b></h4>';
                    echo "<form class = 'group_join' method = 'POST' action = 'join_group.php'>";
                    echo "<input type = \"text\" value = " . $_GET['group_id'] . " name = 'group_id' hidden = true>";
                    
                    echo "<button class=\"w3-button w3-block w3-green w3-section fr_accept\" title=\"Join this group\"><i class=\"fa fa-check\" type = \"submit\"></i></button>";
                    echo "</form>";
                }
                
                
                
            ?>
            </div>
                         
        </div>
                     
        </div>
      </div>
      <br>
      
    <!-- End Right Column -->
    </div>
    </body>
    <footer>
        unset($sql);
        <?php include 'footer.php'; ?>
    </footer>
</html>