<?php
  include 'sql_setup.php';

  $role = $_POST['role'];
  $id = $_POST['member_id'];


  if($role === 'Member'){
    $sql = "update members set role='Content Editor' where member_id=". $id .";";
    $conn->prepare($sql);
    $results = $conn->query($sql);
  }
  else{
    $sql = "update members set role='Member' where member_id=". $id .";";
    $conn->prepare($sql);
    $results = $conn->query($sql);
  }

  header("Location: view_members.php?group_id=".$_POST['group_id']);
?>
