<?php
include 'app/functions.php';
sess_start('hfgh2dd2aa');
if (!user_verify()) {
    header('location:sign_in.php');
}
$link = dbConnect();

$pid = trim(filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING));
$pid = mysqli_real_escape_string($link, $pid);
if ($pid && is_numeric($pid)) {
    $uid = $_SESSION['uid'];
    $sql = "delete from posts where id = $pid and uid = $uid";
    $result = mysqli_query($link, $sql);

    if ($result && mysqli_affected_rows($link) == 1) {
        header("location: blog.php?sm=your post has been deleted");
        exit;
    }
}


header("location: blog.php");
exit;
