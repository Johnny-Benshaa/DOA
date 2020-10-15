<?php
include 'app/functions.php';
sess_start('hfgh2dd2aa');
if (!user_verify()) {
    header('location:sign_in.php');
}

$err = '';
if (isset($_POST['submit'])) {
    $valid = true;
    if (empty($_POST['uemail'])) {
        $err .= "email field is not valid <br>";
        $valid = false;
    }
    $link = dbConnect();
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
    $email = mysqli_real_escape_string($link, $email);

    if (empty($_POST['fname'])) {
        $err .= "Name field is not valid <br>";
        $valid = false;
    } elseif (strlen($_POST['fname']) < 2) {
        $err .= "min 2 chars for name <br>";
        $valid = false;
    }
    if (empty($_POST['lname'])) {
        $err .= "Name field is not valid <br>";
        $valid = false;
    } elseif (strlen($_POST['lname']) < 2) {
        $err .= "min 2 chars for last name <br>";
        $valid = false;
    }
    if ($valid) {
        $link = dbConnect();
        $fname =  trim(filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING));
        $lname =  trim(filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING));

        $fname = mysqli_real_escape_string($link, $fname);
        $lfname = mysqli_real_escape_string($link, $lname);
        $name = mysqli_real_escape_string($link, $fname, $lname);


        $sql = "insert into contact_us values ('$fname','$lname','$email','$write_to_us')";
        $result = mysqli_query($link, $sql);
        if ($result && mysqli_affected_rows($link) > 0) {
            header("location: blog.php?sm=you signup , now you can login with your account");
        } else {
            $err .= "email or password are invalid";
        }
    }
}

include 'template/header.php';
?>

<style>
    .form-contact {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;

    }

    .form-contact .checkbox {
        font-weight: 400;

    }

    .form-contact .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
    }

    .submit-contact {
        max-width: 200px;
        padding: 15px;
        margin: 0 auto;
    }
</style>


<div role="main">
    <section class="top text-center">
        <?php if (isset($_GET['sm'])) : ?>
            <div class="alert alert-success sm-box">
                <?= $_GET['sm']; ?>
            </div>
        <?php endif; ?>
        <div class="container ">
            <h1>Hi! <?= $_SESSION['uname']; ?> welcome to the Directory Of Art blog Contact page !</h1>
            <p class="lead text-muted">Here you can contact us with any question you may have.</p>

        </div>
    </section>
    <div class="album  ">
        <div class="container ">

            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <?php if (!empty($err)) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $err; ?>
                        </div>
                    <?php endif; ?>
                    <form class="form-contact  shadow-sm" action="">
                        <label class="lab" for="title">Full Name</label>
                        <input name="fname" type="text" class="form-control"><br>
                        <label class="lab" for="title">Email</label>
                        <input name="email" type="text" class="form-control"><br>
                        <label class="lab" for="content">Message Content</label>
                        <textarea class="form-control " name="content" rows="5"></textarea><br>
                        <input name="csrf" type="hidden" value="<?= $csrf; ?>"><br>
                        <input type="submit" class="btn submit-contact btn-lg btn-outline-dark btn-block" name="submit" value="submit">
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>





<?php
include 'template/footer.php';
?>