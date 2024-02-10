<?php

session_start();

require("manageDB.php");

$DB = new DBmanager();


$user = !empty($_SESSION['user']) ? $_SESSION['user'] : "";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" card="ie=edge">
  <!-- CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" />
  <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.0/css/all.css" integrity="sha512-ajhUYg8JAATDFejqbeN7KbF2zyPbbqz04dgOLyGcYEk/MJD3V+HJhJLKvJ2VVlqrr4PwHeGTTWxbI+8teA7snw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Jost:wght@500&display=swap" rel="stylesheet">

  <!-- JS -->
  <script src="js/jquery.min.js" type="text/javascript" charset="utf-8"></script>

  <title>Document</title>
</head>

<body class="bg-lightgray-1 vh-100">
  <header class="p-2 m-1 bg-white shadow rounded-bottom">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand font-jost text-uppercase" href="#">Logo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse font-jost" id="navbarScroll">
          <ul class="my-2 navbar-nav me-auto my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Link
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Link</a>
            </li>
          </ul>
          <form class="d-flex">
            <input class="form-control me-2" type="search" id="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
    <div class="clearfix"></div>
  </header>

  <main>
    <div class="p-5 bg-white rounded">
      
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">

        <?php
        $DB->select("select * from brands");

        $brands = $DB->showData();

        for ($i = 0; $i < count($brands); $i++) {
          
          echo '
          <a class="hover text-decoration-none" href="' . $brands[$i]["brandSite"] . '">
              
              <div class="flex p-4 text-center rounded shadow justify-content-center text-dark responsive">
              <h4 class="mb-2">' . $brands[$i]["brandName"] . '</h4>
              <img src="' . $brands[$i]["brandLogo"] . '" class="px-2 img-fluid"/>
              </div>
              
          </a>';
                
        }

        ?>

      </div>

    </div>
  </main>



  <footer class="bottom-0 text-center rounded-top">
    <div class="p-5 bg-lightgray-2 info">...</div>
    <div class="p-3 bg-lightgray-3 about">...</div>
  </footer>

  <script src="js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
  <script src="js/script.js" type="text/javascript" charset="utf-8"></script>
</body>

</html>