<?php
include 'app/functions.php';

sess_start('hfgh2dd2aa');
session_destroy();
header('location:sign_in.php');
exit;
