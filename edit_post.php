<?php
include 'app/functions.php';
sess_start('hfgh2dd2aa');
if (!user_verify()) {
    header('location:sign_in.php');
}
define("UPLOAD_MAX_SIZE", 1024 * 1024 * 20);
$ex = ["jpg", "jpeg", "png", "gif", "bmp", "pdf"];
$err = '';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $link = dbConnect();
    $post_id = mysqli_real_escape_string($link, $_GET['id']);
    $uid = $_SESSION['uid'];
    $sql = "select * from posts where id ='$post_id' and uid = '$uid' ";
    $result = mysqli_query($link, $sql);
    if ($result && mysqli_num_rows($result) == 1) {
        $post = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $post = $post[0];
    }
}

if (isset($_POST['submit'])) {
    if ($_POST['csrf'] === $_SESSION['csrf']) {
        $valid = true;
        $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
        $content = trim($_POST['content']);

        if (empty($title)) {
            $err .= "must fill title field";
            $valid = false;
        }
        if (empty($content)) {
            $err .= "must fill content field";
            $valid = false;
        }

        if ($valid) {
            $link = dbConnect();
            $title = mysqli_real_escape_string($link, $title);
            $content = mysqli_real_escape_string($link, $content);
            $uid = $_SESSION['uid'];
            if (!empty($_FILES['image']['name'])) {
                if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                    if ($_FILES['image']['size'] <= UPLOAD_MAX_SIZE && $_FILES['image']['error'] == 0) {
                        $file_info = pathinfo($_FILES['image']['name']);
                        $file_ex = strtolower($file_info['extension']);
                        if (in_array($file_ex, $ex)) {
                            $fileName = time() . "_" . $_FILES['image']['name'];
                            if (move_uploaded_file($_FILES['image']['tmp_name'], 'image/' . $fileName)) {
                                $image = " image ='$fileName',";
                            } else {
                                $image = "";
                            }
                        }
                    }
                }
            } else {
                $image = "";
            }


            $sql = "update posts set title = '$title',content = '$content', $image created_at = NOW() where id = $post_id and uid = $uid";
            $result = mysqli_query($link, $sql);
            if ($result && mysqli_affected_rows($link) > 0) {
                header("location: blog.php?sm=your post has been updated!");
            }
        }
    }
}

$csrf = csrf_token();
include 'template/header.php';

?>

<main role="main">
    <section class=" top text-center pt-70">
        <div class="container headline">
            <h1>Hi! <?= $_SESSION['uname']; ?> you can edit your post here</h1>
            <a href="blog.php" class="btn btn-primary my-2"> Back to blog</a>
            </p>
        </div>
    </section>

    <div class="album py-5">
        <div class="container">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <?php if (!empty($err)) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $err; ?>
                        </div>
                    <?php endif; ?>
                    <form class="form " action="" method="post" enctype="multipart/form-data">
                        <label for="title">Post Title</label>
                        <input name="title" type="text" class="form-control" value="<?= $post['title']; ?>"><br>
                        <label for="content">Post Content</label>
                        <textarea class="form-control " name="content" id="summernote" rows="5"><?= $post['content']; ?></textarea><br> <label for="image" class="sr-only">image</label>
                        <input name="image" type="file" class="form-control">
                        <input name="csrf" type="hidden" value="<?= $csrf; ?>"><br>
                        <input type="submit" class="btn btn-lg btn-outline-dark btn-block" name="submit" value="Save changes">


                    </form>
                </div>

            </div>
        </div>
    </div>

</main>








<?php
include 'template/footer.php';
?>