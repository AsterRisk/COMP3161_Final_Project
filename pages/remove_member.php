<?php
  include 'sql_setup.php';

  $id = $_POST['member_id'];
  $groupid = $_POST['group_id'];

  $sql = "delete from members where member_id=". $id ." and group_id=". $groupid .";";
  $conn->prepare($sql);
  $results = $conn->query($sql);

  header("Location: view_members.php?group_id=".$groupid);
?>
