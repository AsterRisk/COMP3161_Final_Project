<!DOCTYPE html>
<html>
<head>
    <title>Login to SocialBook</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css%22%3E">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css%22%3E">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans%27%3E">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css%22%3E">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <style>
    html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
    </style>
    <script>
      function assign(id){
        console.log(id);
      }
    </script>
</head>
<body>
  <?php
    $servername = "localhost";
    $username = "root";
    $password = "";

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    session_start();
    // include 'header.php';
    include 'sql_setup.php';
    echo "<h3>Registered SocialBook Users:</h3><br><br>";

    $sql = "use final_proj_3161;";
    $conn->prepare($sql);
    $conn->query($sql);
    $sql = "SELECT * from users;";
    $conn->prepare($sql);
    $results = $conn->query($sql);

    ?>
          <table class='table'>
              <tr>
                  <th>User ID</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email Address</th>
                  <th>View Friends</th>
              </tr>
              <?php
                  foreach ($results as $row)
                  {
                     if ($row['user_id'] != 0)
                     {
                        $text = "<tr><td> ". $row['user_id'] ." </td>" . "<td> ". $row['first_name'] ." </td>". " <td> ". $row['last_name'] ." </td><td> ". $row['email'] ." </td><td><form method='GET' action='admin_friends.php'><input type='text' style='display:none;' value=". $row['user_id'] ." name =
                        'user_id'><button id='button' onclick='assign(". $row['user_id'] .")'>+</button></form></td></tr> ";
                        echo $text;
                     }
                  }
              ?>
          </table>
    <?php
        echo "<br><br>Registered users: " . $results->num_rows;
        //include 'footer.php';
        $conn->close();
    ?>
</body>

</html>
