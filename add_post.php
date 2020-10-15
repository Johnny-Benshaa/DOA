<?php
include 'app/functions.php';
sess_start('hfgh2dd2aa');
if (!isset($_SESSION['uid']) && empty($_SESSION['uid'])) {
    header('location:sign_in.php');
}
define("UPLOAD_MAX_SIZE", 1024 * 1024 * 20);
$ex = ["jpg", "jpeg", "png", "gif", "bmp", "pdf"];
$err = '';
if (isset($_POST['submit'])) {
    if ($_POST['csrf'] === $_SESSION['csrf']) {
        $valid = true;

        $content = trim($_POST['content']);
        $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));


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
                            if (move_uploaded_file($_FILES['image']['tmp_name'], 'image/' . $fileName)) {

                                $sql = "insert into posts value (null,'$uid','$title','$content','$fileName',NOW())";


                                $result = mysqli_query($link, $sql);

                                if ($result && mysqli_affected_rows($link) > 0) {
                                    header("location: blog.php?sm=your post has been saved!");
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
$csrf = csrf_token();
include 'template/header.php';

?>




<main role="main">
    <section class="top text-center ">
        <div class="container  headline">
            <h1>Hi! <?= $_SESSION['uname']; ?> you can add new post here</h1>
            <a href="blog.php" class="btn btn-outline-dark my-2"> Back to blog</a>

        </div>
    </section>

    <div class="album  ">
        <div class="container">

            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <?php if (!empty($err)) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $err; ?>
                        </div>
                    <?php endif; ?>
                    <form class="form" action="" method="post" enctype="multipart/form-data">
                        <label class="lab" for="title">Post Title</label>
                        <input name="title" type="text" class="form-control"><br>
                        <label class="lab" for="content">Post Content</label>
                        <textarea class="form-control " name="content" id="summernote" rows="5"></textarea><br>
                        <label for="image" class="sr-only">image</label>
                        <input name="image" type="file" class="form-control">
                        <input name="csrf" type="hidden" value="<?= $csrf; ?>"><br>
                        <input type="submit" class="btn btn-outline-dark  btn-block" name="submit" value="add new post">


                    </form>
                </div>

            </div>
        </div>
    </div>

</main>








<?php
include 'template/footer.php';
?>