<?php
include 'app/functions.php';
sess_start('hfgh2dd2aa');
if (!user_verify()) {
    header('location:sign_in.php');
}

$link = dbConnect();
$sql = "SELECT posts.*, users.name, TRIM(TRAILING ',' FROM SUBSTRING_INDEX(content, ' ', 10)) as preview  FROM `posts` join users on posts.uid = users.id";
$result = mysqli_query($link, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
}


include 'template/header.php';

?>


<main role="main">
    <section class="top text-center">
        <?php if (isset($_GET['sm'])) : ?>
            <div class="alert alert-success sm-box">
                <?= $_GET['sm']; ?>
            </div>
        <?php endif; ?>
        <div class="container headline ">
            <h1>Hi! <?= $_SESSION['uname']; ?> welcome to the Directory Of Art blog! </h1>
            <p class="lead text-muted">In this blog, we will focus on the various ways of arts and artist on their way of creation.</p>
            <p>
                <a href="add_post.php" class="btn btn-outline-dark my-2">+ Add new post</a>

            </p>
        </div>
    </section>

    <div class="album  py-5 ">
        <div class="container">
            <div class="row">
                <?php if (!isset($posts)) : ?>
                    <h2>No Posts</h2>
                <?php else : ?>
                    <?php foreach ($posts as $post) : ?>
                        <div class="col-md-4 m-10">
                            <div class="card mb-4 shadow-sm">
                                <img class="bd-placeholder-img card-img-top" width="100%" height="450px" src="image/<?php echo $post['image'] ?  $post['image'] : 'defaultImage.jpg' ?>">
                                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em"></text>
                                </img>
                                <div class="card-body outline-dark">
                                    <h4><?= htmlspecialchars($post['title']); ?></h4>
                                    <hr>
                                    <p></p>
                                    <p class="card-text"><?= $post['preview']; ?>... see more</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <?php if ($post['uid'] == $_SESSION['uid']) : ?>
                                                <a href="delete_post.php?id=<?= $post['id']; ?>">
                                                    <i class="far fa-trash-alt btn btn-sm btn-outline-secondary delete_btn space" title="Delete"></i>
                                                </a>
                                                <a href="edit_post.php?id=<?= $post['id']; ?>"><i class="far fa-edit btn btn-sm btn-outline-secondary space" value="Edit" title="Edit"></i>

                                                </a>
                                            <?php endif; ?>
                                            <a href="full_page.php?id=<?= $post['id']; ?>">
                                                <i class="far fa-eye btn btn-sm btn-outline-secondary space" value="View" title="View"></i>
                                            </a>
                                        </div>
                                        <small class="text-muted"><?= $post['created_at']; ?></small>
                                        <br>
                                        <small class="text-muted"><?= htmlspecialchars($post['name']); ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>




        </div>
    </div>

</main>








<?php
include 'template/footer.php';
?>