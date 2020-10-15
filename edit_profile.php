<?php
include_once 'app/functions.php';
sess_start('hfgh2dd2aa');
if (!user_verify()) {
    header('location:sign_in.php');
}

$ex = ["jpg", "jpeg", "png", "gif", "bmp", "pdf"];
$err = "";
$link = dbConnect();
$uid = $_SESSION['uid'];
$sql = "select * from users where id = $uid";
$result = mysqli_query($link, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    $edit_user = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $edit_user = $edit_user[0];
}

if (isset($_POST['submit'])) {
    if ($_POST['csrf'] === $_SESSION['csrf']) {
        $valid = true;
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
        $email = mysqli_real_escape_string($link, $email);

        if ($valid) {
            $pwd =  trim(filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING));;
            $name =  trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));;

            $pwd = mysqli_real_escape_string($link, $pwd);

            $name = mysqli_real_escape_string($link, $name);





            $email = $email ? "email = '$email'," : "";
            $pwd = $pwd ? "pwd = '" . password_hash($pwd, PASSWORD_BCRYPT) . "'," : "";
            $name = $name ? "name = '$name'" : "";


            if (!empty($_FILES['image']['name'])) {

                $valid = uploadFile();

                if ($valid) {
                    $fileName = "profilepic = '$valid'";

                    $sql = "update users set $email $pwd $name, $fileName  where id = $uid";

                    $result = mysqli_query($link, $sql);

                    header("location: blog.php?sm=your profile has been updated!");
                } else {
                    $err;


                    header("location: blog.php?sm=something went wrong!");
                }
            } else {

                $sql = "update users set $email $pwd $name where id = $uid";

                $result = mysqli_query($link, $sql);
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

    <h1 class="h3 mb-3 font-weight-normal">Update your profile</h1>
    <label for="Name" class="sr-only">Full Name</label>
    <input name="name" type="text" id="inputName" class="form-control" value="<?= $edit_user['name']; ?>"><br>
    <label for="Email" class="sr-only">Email address</label>
    <input name="email" type="text" id="inputEmail" class="form-control" value="<?= $edit_user['email']; ?>"><br>
    <input name="pwd" type="password" id="inputPassword" class="form-control" placeholder="Password"><br>
    <input name="image" type="file" class="form-control"><br>

    <input name="csrf" type="hidden" value="<?= $csrf; ?>">
    <input type="submit" class="btn btn-lg btn-outline-dark btn-block" name="submit" value="Update">


</form>



<?php
include 'template/footer.php';

?>