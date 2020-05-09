<?php
    include 'header.php';
    $sql = 'call requestFriend(' .$_SESSION['id'] .', '.$_POST['requested_user'] .');';
    $conn->prepare($sql);
    $conn->query($sql);
    header("Location: view_friend.php?friend_id=" . $_POST['requested_user']);
?>