<?php
include_once 'app/functions.php';
sess_start('hfgh2dd2aa');
if (isset($_SESSION['uid']) && !empty($_SESSION['uid']) && is_numeric($_SESSION['uid'])) {
    header('location:blog.php');
}
define("UPLOAD_MAX_SIZE", 1024 * 1024 * 20);
$ex = ["jpg", "jpeg", "png", "gif", "bmp", "pdf"];
$err = "";
if (isset($_POST['submit'])) {
    if ($_POST['csrf'] === $_SESSION['csrf']) {
        $valid = true;
        if (empty($_POST['email'])) {
            $err .= "email field is not valid <br>";
            $valid = false;
        }
        $link = dbConnect();
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
        $email = mysqli_real_escape_string($link, $email);


        if (email_exist($link, $email)) {
            $err .= "This email is already taken <br>";
            $valid = false;
        }

        if (empty($_POST['pwd'])) {
            $err .= "password field is not valid <br>";
            $valid = false;
        } elseif (strlen($_POST['pwd']) < 6) {
            $err .= "min 6 chars for password <br>";
            $valid = false;
        }

        if (empty($_POST['name'])) {
            $err .= "Name field is not valid <br>";
            $valid = false;
        } elseif (strlen($_POST['name']) < 2) {
            $err .= "min 6 chars for password <br>";
            $valid = false;
        }


        if ($valid) {
            $pwd =  trim(filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING));;
            $name =  trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));;


            $pwd = mysqli_real_escape_string($link, $pwd);
            $pwd = password_hash($pwd, PASSWORD_BCRYPT);
            $name = mysqli_real_escape_string($link, $name);
            /*   print_r($_FILES['image']);
            die; */

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

                                $sql = "insert into users values (null,'$email','$pwd','$name','$fileName',7)";

                                $result = mysqli_query($link, $sql);

                                if ($result && mysqli_affected_rows($link) > 0) {
                                    header("location: sign_in.php?sm=you signup , now you can login with your account");
                                } else {
                                    $err .= "an error occured";
                                }
                            }
                        }
                    }
                }
            } else {
                echo $sql = "insert into `users` values (null,'$email','$pwd','$name','',7)";
                $result = mysqli_query($link, $sql);
                if ($result && mysqli_affected_rows($link) > 0) {
                    header("location: sign_in.php?sm=you signup , now you can login with your account");
                }
            }
        }
    }
}



$csrf = csrf_token();

include 'template/header.php';

?>


<!-- <style>
    html,
    body {
        height: 100%;
    }

    main {
        margin: 0 auto;
    }

    body {
        display: -ms-flexbox;
        display: -webkit-box;
        display: flex;
        -ms-flex-align: center;
        -ms-flex-pack: center;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: center;
        justify-content: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #efeeb4;

    }

    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
    }

    .form-signin .checkbox {
        font-weight: 400;
    }

    .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
    }

    .form-signin .form-control:focus {
        z-index: 2;
    }

    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style> -->

<?php if (!empty($err)) : ?>
    <div class="alert alert-danger" role="alert">
        <?= $err; ?>
    </div>
<?php endif; ?>
<form class="form-signin" action="" method="post" enctype="multipart/form-data">

    <h1 class="h3 mb-3 font-weight-normal">Please Signup</h1>
    <label for="Name" class="sr-only">Full Name</label>
    <input name="name" type="text" id="inputName" class="form-control" placeholder="Full Name"><br>
    <label for="Email" class="sr-only">Email address</label>
    <input name="email" type="text" id="inputEmail" class="form-control" placeholder="Email address"><br>
    <input name="pwd" type="password" id="inputPassword" class="form-control" placeholder="Password"><br>
    <input name="image" type="file" class="form-control"><br>

    <input name="csrf" type="hidden" value="<?= $csrf; ?>">
    <input type="submit" class="btn btn-lg btn-outline-dark btn-block" name="submit" value="Signup">


</form>



<?php
include 'template/footer.php';

?>