<?php
include_once 'app/functions.php';
sess_start('hfgh2dd2aa');
$link = dbConnect();
$err = '';
if (isset($_GET['id'])) {
    $post = $_GET['id'];
    $post_id = $_GET['id'];
    $sql = "select *  FROM `posts` where id = $post_id";

    $result = mysqli_query($link, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $post = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $post = $post[0];
    }

    $sql = "select * from comments where post_id = $post_id ";
    $result = mysqli_query($link, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}

if (isset($_POST['submit'])) {
    $user = $_SESSION['uname'];
    $post_id = $_GET['id'];
    $comment = trim($_POST['comment']);
    $comment = mysqli_real_escape_string($link, $comment);
    $sql = "insert into comments value (null,'$user','$comment', NOW(), '$post_id') ";

    $result = mysqli_query($link, $sql);

    if ($result && mysqli_affected_rows($link) > 0) {
        $err .= "your comment has been added";
        header("location:full_page.php?id=$post_id");
    }
    if (!empty($comment)) {
        $name = $_SESSION['uname'];
        $uid = $_SESSION['uid'];
        echo $sql = "Select * FROM `comments` where id=$uid ";
        $result = mysqli_query($link, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $comnt = mysqli_fetch_all($result, MYSQLI_ASSOC);
            echo "<pre>";
            print_r($comnt);
            die;
        }
    };
}



include 'template/header.php'; ?>

<!-- <style>
    .container {
        margin: 0 auto;
        width: 100%;
        height: 100%;


    }

    .view-post {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 60%;
        /* height: 60%; */
    }



    .comments {
        width: 100%;
        height: 100%;
        margin-left: 200px;
    }

    .cmnt {
        padding: 60px;
        font-size: 19px;
        line-height: 1;

    }

    h2,
    h3 {
        text-align: center;
    }

    textarea {

        margin: 0 auto;
        margin-left: 25%;
        width: 50%;

    }

    .sub {
        margin-left: 45%;
    }
</style> -->


<div class="container1">
    <div>
        <div class="cmnt">
            <img class="view-post" src=" image/<?= $post['image']; ?>" alt=""><br>
            <h2><?= $post['title']; ?></h2>
            <p class="card-text d-flex justify-content-between"><?= $post['content']; ?></p>
        </div>


        <?php if (!empty($err)) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $err; ?>
            </div>
        <?php endif; ?>
        <div>

            <form action="" method="POST">
                <h3 for="textarea">Add your comment here:</h3><br>
                <textarea class="textarea" name="comment" id="" cols="10" rows="5"></textarea><br>
                <input class="btn sub" name="submit" type="submit" value="submit">

            </form>
            <?php if (!empty($comments)) : ?>
                <?php foreach ($comments as $comment) : ?>
                    <div name="viewc" class="comments ">
                        <?= "name: {$comment['name']}" ?> <br>
                        <?= "comment: {$comment['comment']}" ?><br>
                        <?= "time: {$comment['created_at']}" ?>

                    </div>
                    <hr> <br>

                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php include 'template/footer.php'; ?>