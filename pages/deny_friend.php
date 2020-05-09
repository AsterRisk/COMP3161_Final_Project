<?php
    include 'sql_setup.php';
    $sql = "call denyFriendRequest(". $_POST['requesting'] . ", " . $_POST['requested'] . ");";
    $conn->prepare($sql);
    $conn->query($sql);
    echo $sql;
    unset($sql);
    header("Location: home.php");
?>