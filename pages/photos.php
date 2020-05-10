<!DOCTYPE html>
<html>
    <head>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel = "icon" href = "../assets/default_imgs/logo.png">
        <title>My Photos</title>
        <?php
            include 'header.php';
        ?>
    </head>
    <body>
        <div class="w3-col m3" style = "margin-top:60px;margin-left:30px;">
          <!-- Profile -->
          <div id = "profile info" style = "position:fixed;width:20%;">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container">
             <h4 class="w3-center" style = "margin-top:15px;">My Profile</h4>
             <p class="w3-center">
                <?php
                    if(strcmp($ppa, '..assets/default_imgs/default_profile_picture.png') != 0)
                    {
                        $img = "<a href = \"modify_profile.php\"><img src='". $ppa . "' class=\"w3-circle\" style=\"height:200px;width:200px\" alt=\"Avatar\" tooltip = 'Modify my Profile'></a>";
                    }
                    else
                    {
                        $img = "<a href = \"modify_profile.php\"><img src='..assets/default_imgs/default_profile_picture.png' class=\"w3-circle\" style=\"height:200px;width:200px\" alt=\"Avatar\" tooltip = 'Modify my Profile'></a>";
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
        </div>
        <!--End Left Column-->
        <div id = "photos" style = "margin-left:400px" class="w3-col m7">
            <div class="w3-container w3-card w3-white w3-round w3-margin" style = "margin-top:400px;"><br>
                <h4 class = "w3-opacity" >My Photos</h4>
                <hr class = "w3-clear">
                <br>
                <?php
                    $sql = "select media_link from posts where user_id = ".$_SESSION['id']." and media_link != \"NULL\" group by media_link order by post_id desc;";
                    $conn->prepare($sql);
                    $photos = $conn->query($sql);
                    $sql = "select profile_pic_address from users where user_id = ".$_SESSION['id'].";";
                    $conn->prepare($sql);
                    $profile_pic = $conn->query($sql)->fetch_assoc()['profile_pic_address'];
                    $numPhotos = $photos->num_rows;
                    $txt = "<p>". $numPhotos ." photo(s) posted.</p>";
                    echo $txt;
                    $posted_photos = array();
                ?>
                <br>
                </div>
                <?php
                    foreach($photos as $photo)
                    {
                        ?>
                        <div class = "w3-container w3-card w3-white w3-round w3-margin" style = "margin-top:15px;">
                            <?php echo "<div class = 'w3-half'>\n<img src = '" . $photo['media_link'] . "' style = 'margin:40px;height:100%;width:100%;max-height:400px;max-width:400px;'>\n</div>"; ?> 
                        
                        <div class = 'w3-half' style = "padding-left:50px;">
                            
                            <?php
                                array_push($posted_photos, $photo['media_link']);
                                if (strcmp($profile_pic, $photo['media_link']) != 0)
                                {
                                    echo "<form class = \"setProfilePhoto\" method = \"POST\" action = \"setProfile.php\"><input type = 'text' name = 'new_dp_link' value = '".$photo['media_link'] ."' hidden>\n";
                                    $acceptButton = "<h4 class = 'w3-opacity' style = 'text-align:center;margin-top:40px;'>Set as profile picture?</h4><button class=\"w3-button w3-block w3-green w3-section fr_accept\" title=\"Accept\"><i class=\"fa fa-check\" type = \"submit\"></i></button>\n</form>";
                                    echo $acceptButton;
                                    
                                }
                                else
                                {
                                     echo "<form class = \"setProfilePhoto\" method = \"POST\" action = \"setProfile.php\"><input type = 'text' name = 'new_dp_link' value = '../assets/default_imgs/default_profile_picture.png' hidden>\n";
                                    $acceptButton = "<h4 class = 'w3-opacity' style = 'text-align:center;margin-top:40px;'>Remove profile picture?</h4><button class=\"w3-button w3-block w3-red w3-section fr_deny\" title=\"Deny\"><i class=\"fa fa-remove\" type = \"submit\"></i></button>\n</form>";
                                    echo $acceptButton;
                                }
                            ?> 
                            
                        </div>
                    </div>
                <?php
                    }
                    if(($profile_pic != NULL) and (strcasecmp($profile_pic, "null") != 0) and (strcasecmp($profile_pic, "../assets/default_imgs/default_profile_picture.png") != 0) and !in_array($profile_pic, $posted_photos))
                    {
                ?>
                        <div class = "w3-container w3-card w3-white w3-round w3-margin" style = "margin-top:15px;">
                        <?php echo "<div class = 'w3-half'>\n<img src = '" . $profile_pic . "' style = 'margin:40px;height:100%;width:100%;max-height:400px;max-width:400px;'>\n</div>"; ?> 
                        <div class = 'w3-half' style = "padding-left:50px;">
                            <h4 class = 'w3-opacity' style = 'text-align:center;margin-top:40px;'>Remove profile picture?</h4>
                            <?php
                                echo "<form class = \"setProfilePhoto\" method = \"POST\" action = \"setProfile.php\"><input type = 'text' name = 'new_dp_link' value = '../assets/default_imgs/default_profile_picture.png' hidden>\n";
                                $acceptButton = "<button class=\"w3-button w3-block w3-red w3-section fr_deny\" title=\"Deny\"><i class=\"fa fa-remove\" type = \"submit\"></i></button>\n</form>";
                                echo $acceptButton;
                            ?>
                        </div> 
                <?php
                    }
                ?>
                
            
        </div>
          <br>
          <br>
        </div>
    </body>
    <?php 
        include 'footer.php';
    ?>
</html>

<!--<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->
        <!--<script>
        let modalId = $('#image-gallery');

        $(document)
          .ready(function () {

            loadGallery(true, 'a.thumbnail');

            //This function disables buttons when needed
            function disableButtons(counter_max, counter_current) {
              $('#show-previous-image, #show-next-image')
                .show();
              if (counter_max === counter_current) {
                $('#show-next-image')
                  .hide();
              } else if (counter_current === 1) {
                $('#show-previous-image')
                  .hide();
              }
            }

            /**
             *
             * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
             * @param setClickAttr  Sets the attribute for the click handler.
             */

            function loadGallery(setIDs, setClickAttr) {
              let current_image,
                selector,
                counter = 0;

              $('#show-next-image, #show-previous-image')
                .click(function () {
                  if ($(this)
                    .attr('id') === 'show-previous-image') {
                    current_image--;
                  } else {
                    current_image++;
                  }

                  selector = $('[data-image-id="' + current_image + '"]');
                  updateGallery(selector);
                });

              function updateGallery(selector) {
                let $sel = selector;
                current_image = $sel.data('image-id');
                $('#image-gallery-title')
                  .text($sel.data('title'));
                $('#image-gallery-image')
                  .attr('src', $sel.data('image'));
                disableButtons(counter, $sel.data('image-id'));
              }

              if (setIDs === true) {
                $('[data-image-id]')
                  .each(function () {
                    counter++;
                    $(this)
                      .attr('data-image-id', counter);
                  });
              }
              $(setClickAttr)
                .on('click', function () {
                  updateGallery($(this));
                });
            }
          });

        // build key actions
        $(document)
          .keydown(function (e) {
            switch (e.which) {
              case 37: // left
                if ((modalId.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
                  $('#show-previous-image')
                    .click();
                }
                break;

              case 39: // right
                if ((modalId.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
                  $('#show-next-image')
                    .click();
                }
                break;

              default:
                return; // exit this handler for other keys
            }
            e.preventDefault(); // prevent the default action (scroll / move caret)
          });

        </script>
        <style>
        .btn:focus, .btn:active, button:focus, button:active {
          outline: none !important;
          box-shadow: none !important;
        }

        #image-gallery .modal-footer{
          display: block;
        }

        .thumb{
          margin-top: 15px;
          margin-bottom: 15px;
        }
        </style>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->

        <!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <title>My Photos</title>
    </head>
    <body>
        <div class="container" style = "margin-top:40px;">
            <?php
            
            ?>
            <div class="row">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                           data-image="https://images.pexels.com/photos/853168/pexels-photo-853168.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                           data-target="#image-gallery">
                            <img class="img-thumbnail"
                                 src="https://images.pexels.com/photos/853168/pexels-photo-853168.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                 alt="Another alt text">
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                           data-image="https://images.pexels.com/photos/158971/pexels-photo-158971.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                           data-target="#image-gallery">
                            <img class="img-thumbnail"
                                 src="https://images.pexels.com/photos/158971/pexels-photo-158971.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                 alt="Another alt text">
                        </a>
                    </div>

                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                           data-image="https://images.pexels.com/photos/305070/pexels-photo-305070.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                           data-target="#image-gallery">
                            <img class="img-thumbnail"
                                 src="https://images.pexels.com/photos/305070/pexels-photo-305070.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                 alt="Another alt text">
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Test1"
                           data-image="https://images.pexels.com/photos/853168/pexels-photo-853168.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                           data-target="#image-gallery">
                            <img class="img-thumbnail"
                                 src="https://images.pexels.com/photos/853168/pexels-photo-853168.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                 alt="Another alt text">
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice"
                           data-image="https://images.pexels.com/photos/158971/pexels-photo-158971.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                           data-target="#image-gallery">
                            <img class="img-thumbnail"
                                 src="https://images.pexels.com/photos/158971/pexels-photo-158971.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                 alt="Another alt text">
                        </a>
                    </div>



                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice"
                           data-image="https://images.pexels.com/photos/305070/pexels-photo-305070.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                           data-target="#image-gallery">
                            <img class="img-thumbnail"
                                 src="https://images.pexels.com/photos/305070/pexels-photo-305070.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                 alt="Another alt text">
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice"
                           data-image="https://images.pexels.com/photos/853168/pexels-photo-853168.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                           data-target="#image-gallery">
                            <img class="img-thumbnail"
                                 src="https://images.pexels.com/photos/853168/pexels-photo-853168.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                 alt="Another alt text">
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice"
                           data-image="https://images.pexels.com/photos/158971/pexels-photo-158971.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                           data-target="#image-gallery">
                            <img class="img-thumbnail"
                                 src="https://images.pexels.com/photos/158971/pexels-photo-158971.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                 alt="Another alt text">
                        </a>
                    </div>



                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice"
                           data-image="https://images.pexels.com/photos/305070/pexels-photo-305070.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                           data-target="#image-gallery">
                            <img class="img-thumbnail"
                                 src="https://images.pexels.com/photos/305070/pexels-photo-305070.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                 alt="Another alt text">
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice"
                           data-image="https://images.pexels.com/photos/853168/pexels-photo-853168.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                           data-target="#image-gallery">
                            <img class="img-thumbnail"
                                 src="https://images.pexels.com/photos/853168/pexels-photo-853168.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                 alt="Another alt text">
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice"
                           data-image="https://images.pexels.com/photos/158971/pexels-photo-158971.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                           data-target="#image-gallery">
                            <img class="img-thumbnail"
                                 src="https://images.pexels.com/photos/158971/pexels-photo-158971.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                 alt="Another alt text">
                        </a>
                    </div>
                </div>


                <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="image-gallery-title"></h4>
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img id="image-gallery-image" class="img-responsive col-md-12" src="">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                                </button>

                                <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>-->


