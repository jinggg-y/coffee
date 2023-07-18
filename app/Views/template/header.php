<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Coffee Sensation</title>

    <!-- Favicons -->
  <link href= <?= base_url('assets/img/logo.png') ?>  rel="icon">
  <link href= <?= base_url('assets/img/logo.png') ?> rel="apple-touch-icon" size="180x180">

  <!-- css files -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
  <link href= <?= base_url('assets/css/style.css') ?> rel="stylesheet"> 
  
  <!-- google font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

  <!-- js -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
  <script src= <?= base_url('assets/js/script.js') ?>></script>
    
</head>
<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand me-2" href="/coffee"><img src= <?= base_url('assets/img/logo.png') ?> alt="CoffeeSensation" class="me-2" width="30" height="30">CoffeeSensation</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown me-2">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Categories
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Brewing</a></li>
              <li><a class="dropdown-item" href="#">Roasting</a></li>
              <li><a class="dropdown-item" href="#">Coffee Beans</a></li>
              <li><a class="dropdown-item" href="#">Latte Art</a></li>
            </ul>
          </li>

          <?php echo form_open(base_url()."search/", ['method' => 'get']);?>
          <div class="d-flex justify-content-between" id="searchbar">
              <input class="form-control me-2" type="search" name="keyword" placeholder="Search..." aria-label="Search">
              <button class="" type="submit"><i class="bi bi-search me-2"></i></button>
          </div>
          <?php echo form_close(); ?>

        </ul>

        <ul class="navbar-nav ms-auto me-2">
          <li class="nav-item ">
            <a class="nav-link" href="/coffee/teach">My Teaching</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">My Learning</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/coffee/wishlist"><i class="bi bi-suit-heart-fill fs-5" style="color: #7B4717;"></i></a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle fs-5" style="color: #7B4717;"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
              <li><a class="dropdown-item" href="/coffee/profile">Profile</a></li>
              <li><a class="dropdown-item" href="/coffee/login">Log in</a></li>
              <li><a class="dropdown-item" href="/coffee/logout">Log out</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>    

  <?php if ($toast = session()->getFlashdata('toast')) : ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <?= $toast ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif ?>