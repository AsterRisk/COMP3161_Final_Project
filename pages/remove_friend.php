<?php
    include 'sql_setup.php';
    $sql = 'delete from friends where user_id = ' . $_SESSION['id'] . ' and friend_id = ' . $_POST['friend_id'] .';';
    echo $sql;
    $conn->prepare($sql);
    $conn->query($sql);
    $sql = 'delete from friends where friend_id = ' . $_SESSION['id'] . ' and user_id = ' . $_POST['friend_id'] .';';
    echo "<br>" . $sql;
    $conn->prepare($sql);
    $conn->query($sql);
header("Location: friends.php");
?>