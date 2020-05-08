<?php
    include 'sql_setup.php';
    $sql = "call acceptFriendRequest(". $_POST['requesting'] . ", " . $_POST['requested'] . ");";
    $conn->prepare($sql);
    $conn->query($sql);
    echo $sql;
    header("Location: home.php");
?>