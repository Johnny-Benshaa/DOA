<?php
include_once 'app/functions.php';
sess_start('hfgh2dd2aa');
if (isset($_SESSION['uid']) && !empty($_SESSION['uid']) && is_numeric($_SESSION['uid'])) {
    header('location:blog.php');
}

$err = "";
if (isset($_POST['submit'])) {
    if ($_POST['csrf'] === $_SESSION['csrf']) {
        $valid = true;
        if (empty($_POST['email'])) {
            $err .= "email field is not valid <br>";
            $valid = false;
        }
        if (empty($_POST['pwd'])) {
            $err .= "password field is not valid <br>";
            $valid = false;
        }
        if ($valid) {
            $email = $_POST['email'];
            $pwd = $_POST['pwd'];


            $link = dbConnect();
            $email = mysqli_real_escape_string($link, $email);
            $pwd = mysqli_real_escape_string($link, $pwd);

            $sql = "select * from users where email = '$email' ";

            $result = mysqli_query($link, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_all($result, MYSQLI_ASSOC);
                $user = $user[0];
                echo $user['pwd'];
                echo "<hr>";
                echo $pwd;




                if (password_verify(trim($pwd), trim($user['pwd']))) {


                    $_SESSION['uid'] = $user['id'];
                    $_SESSION['uname'] = $user['name'];
                    $err = "";
                    if (isset($_POST['submit'])) {
                        $valid = true;
                        if (empty($_POST['email'])) {
                            $err .= "email field is not valid <br>";
                            $valid = false;
                        }
                        if (empty($_POST['pwd'])) {
                            $err .= "password field is not valid <br>";
                            $valid = false;
                        }
                        if ($valid) {
                            $email =  trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));;
                            $pwd =  trim(filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING));;



                            $link = dbConnect();
                            $email = mysqli_real_escape_string($link, $email);
                            $pwd = mysqli_real_escape_string($link, $pwd);

                            $sql = "select * from users where email = '$email' ";

                            $result = mysqli_query($link, $sql);
                            if ($result && mysqli_num_rows($result) > 0) {
                                $user = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                $user = $user[0];


                                if (password_verify($pwd, $user['pwd'])) {
                                    $_SESSION['uid'] = $user['id'];
                                    $_SESSION['uname'] = $user['name'];
                                    $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
                                    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];

                                    header("location: blog.php");
                                } else {
                                    $err .= "email or password are invalid";
                                }
                            }
                        }
                    }

                    header("location: blog.php");
                } else {
                    $err .= "email or password are invalid";
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
    } */


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

    } */

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
<?php if (isset($_GET['sm'])) : ?>
    <div class="alert alert-success sm-box">
        <?= $_GET['sm']; ?>
    </div>
<?php endif; ?>
<form class="form-signin" action="" method="post">

    <h1 class="h3 mb-3 font-weight-normal">Please login</h1>
    <label for="Email" class="sr-only">Email address</label>
    <input name="email" type="text" id="inputEmail" class="form-control" placeholder="Email address"><br>
    <label for="Password" class="sr-only">Password</label>
    <input name="pwd" type="password" id="inputPassword" class="form-control" placeholder="Password">
    <input name="csrf" type="hidden" value="<?= $csrf; ?>">

    <input type="submit" class="btn btn-lg btn-outline-dark btn-block" name="submit" value="Login">


</form>



<?php
include 'template/footer.php';

?>