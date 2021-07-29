<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=URL?>/css/bootstrap.css">
    <title><?=$data['title']?></title>
</head>
<body>

<!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="<?=URL?>">PHP MVC</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link <?php if($data['active'] === 'active home'){echo $data['active'];}?>" aria-current="page" href="<?=URL?>">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($data['active'] === 'active about'){echo $data['active'];}?>" href="<?=URL?>/about">About</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->