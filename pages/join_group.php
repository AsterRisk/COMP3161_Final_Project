<?php

    include 'sql_setup.php';
    $sql = 'call joinGroup('.$_SESSION['id'] .', '. $_POST['group_id'] .');';
    echo $sql;
    $conn->prepare($sql);
    $conn->query($sql);
    header("Location: view_group.php?group_id=".$_POST['group_id']);
?>