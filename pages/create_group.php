
<html>
    <head>
        <?php
            include 'header.php';
        ?>
    </head>
    <body>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">


        <div class="container">
        <br>  <p class="text-center">More bootstrap 4 components on <a href="http://bootstrap-ecommerce.com/"> Bootstrap-ecommerce.com</a></p>
        <hr>





        <div class="card bg-light">
        <article class="card-body mx-auto" style="max-width: 400px;">
            <h4 class="card-title mt-3 text-center">Create Group</h4>
            <form method = "POST" action = "groupCreate.php" enctype="multipart/form-data">
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                 </div>
                <input name="group_name" class="form-control" placeholder="Group Name" type="text">
            </div> <!-- form-group// -->    
            <div class = "form-group input-group">
                <br>
                <label for = "fileToUpload">Choose a group photo:</label>
                <input type="file" name="fileToUpload" id="fileToUpload">
            <br>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block"> Create Group  </button>
            </div>
        </form>
        </article>
        </div> <!-- card.// -->

        </div> 
        <!--container end.//-->

        <br><br>
        <?php
            include 'footer.php';
        ?>
    </body>
</html>