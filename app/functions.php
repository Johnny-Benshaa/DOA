<?php
if (!function_exists("dbConnect")) {
    function dbConnect()
    {
        $link = mysqli_connect("localhost", "root", "", "blog");
        return $link;
    }
}

if (!function_exists("csrf_token")) {
    function csrf_token()
    {
        $token = sha1(rand(1, 99999) . '$$' . time()) . time();
        $_SESSION['csrf'] = $token;
        return $token;
    }
}

if (!function_exists("email_exist")) {

    function email_exist($link,  $email)
    {
        $valid = false;
        $sql = "select * from users where email = $email";
        $result = mysqli_query($link, $sql);
        if ($result && mysqli_num_rows($result) == 1) {
            $valid = true;
        }
        return $valid;
    }
}

if (!function_exists("user_verify")) {
    function user_verify()
    {
        $verify = false;
        if (isset($_SESSION['uid'])) {
            if (isset($_SESSION['user_ip']) && $_SESSION['user_ip'] == $_SERVER['REMOTE_ADDR']) {
                if (isset($_SESSION['user_agent']) && $_SESSION['user_agent'] == $_SERVER['HTTP_USER_AGENT']) {
                    $verify = true;
                }
            }
        }
        return $verify;
    }
}

if (!function_exists("sess_start")) {
    function sess_start($name = 'null')
    {
        if ($name) session_name($name);
        session_start();
        session_regenerate_id();
    }
}

if (!function_exists(("uploadFile"))) {

    function uploadFile()
    {

        define("UPLOAD_MAX_SIZE", 1024 * 1024 * 20);
        $ex = ["jpg", "jpeg", "png", "gif", "bmp", "pdf"];

        if (!empty($_FILES['image']['name'])) {

            #check that the file is not curaptted 
            if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                #check file size
                if ($_FILES['image']['size'] <= UPLOAD_MAX_SIZE && $_FILES['image']['error'] == 0) {
                    #check file extension
                    $file_info = pathinfo($_FILES['image']['name']);
                    $file_ex = strtolower($file_info['extension']);
                    if (in_array($file_ex, $ex)) {
                        # using time() to avoid overwriting the same file name
                        $fileName = time() . "_" . $_FILES['image']['name'];
                        if (move_uploaded_file($_FILES['image']['tmp_name'], 'image/profileimg/' . $fileName)) {


                            return  $fileName;
                        } else {
                            return false;
                        }
                    }
                }
            }
        }
    }
}
