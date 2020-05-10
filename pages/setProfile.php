<?php
    include 'sql_setup.php';
    $sql = "update users set profile_pic_address = '" . $_POST['new_dp_link'] ."' where user_id = " . $_SESSION['id'] . ";";
    echo $sql;
    $conn->prepare($sql);
    $conn->query($sql);
    header("Location: photos.php");
?>