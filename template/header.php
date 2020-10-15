<?php
include_once 'app/functions.php';
if (user_verify()) {
  $link = dbConnect();
  $user = $_SESSION['uid'];
  $sql = "select *  FROM `users` where id = $user";
  $result = mysqli_query($link, $sql);
  if ($result && mysqli_num_rows($result) == 1) {
    $prfl = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $prfl = $prfl[0];
  }
}


?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.0.1">
  <title>Directory Of Art</title>



  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <meta name="theme-color">


  <style>
    body,
    .headline,
    .container {

      background-color: #efeeb4;

    }

    .prfl {
      border-radius: 100%;
      width: 50px;
    }

    .prf {

      border-radius: 100%;
      width: 100% !important;
      height: 100% !important;


    }



    .top {
      padding: 100px;
      padding-bottom: 0;
    }

    .note-editor.note-frame .note-editing-area {

      background-color: white;
    }


    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- Custom styles for this template -->

  <link href="css/carousel.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top ">
      <a class="logo navbar-brand" href="blog.php">
        <img class="navbar-brand" src="image/Asset.png" width="16%" height="16%" alt="">
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about_us.php">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="contact_us.php">Contact Us</a>
          </li>
        </ul>
        <form class="form-inline mt-2 mt-md-0">
          <a class="nav-link btn-outline" href="sign_in.php">
            <input type="button" class="btn btn-outline-dark" value="Login">
          </a>
          <a class="nav-link btn-outline" href="logout.php">
            <input type="button" class="btn btn-outline-dark" value="Logout">
          </a>
          <a class="nav-link btn-outline" href="sign_up.php">
            <input type="button" class="btn btn-outline-dark" value="sign up">
          </a>
          <?php if (user_verify()) : ?>
            <a class="prfl" name="disp" href="edit_profile.php">

              <img class="navbar-brand prf" src="image/profileimg/<?= $prfl['profilepic'] ? $prfl['profilepic'] : 'defaultImage.jpg' ?>">

            </a>
          <?php endif; ?>
        </form>

      </div>
    </nav>
  </header>
  <main role=" main">
    <script src="https://kit.fontawesome.com/826530e5ef.js" crossorigin="anonymous"></script>