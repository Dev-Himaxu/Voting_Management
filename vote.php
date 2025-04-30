<?php
session_start();
include 'db.php';

$votes =$_POST['gvotes'];
$total_votes = $votes + 1;
$gid = $_POST['gid'];
$uid = $_SESSION['userdata']['id'];

$update_votes = mysqli_query($conn, "UPDATE user SET votes='$total_votes' WHERE id='$gid'");

$update_status = mysqli_query($conn, "UPDATE user SET status='1' WHERE id='$uid'");

if ($update_votes && $update_status) {
    $groups = mysqli_query($conn, "SELECT id, name, votes, photo FROM user WHERE role=2");
    $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);
    $_SESSION['userdata']['status'] = 1;
    $_SESSION['groupsdata'] = $groupsdata;
    echo "<script>alert('Vote Successful');</script>";
    header("Location: dashboard.php");
} else {
    echo "<script>alert('Some error occured');</script>";
    header("Location: dashboard.php");
    }

?>