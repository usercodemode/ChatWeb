<?php

session_start();

require("manageDB.php");

$DB = new DBmanager();

if (!isset($_SESSION['id'])) {
    header('location: login.php');
}
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
        <div class="container p-4 mx-auto vh-100">

            <div class="border-2 bg-light rounded-2 float-end">
            <a class="btn btn-primary" href="logout.php">
            <svg fill="#ffffff" height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 384.971 384.971" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g id="Sign_Out"> <path d="M180.455,360.91H24.061V24.061h156.394c6.641,0,12.03-5.39,12.03-12.03s-5.39-12.03-12.03-12.03H12.03 C5.39,0.001,0,5.39,0,12.031V372.94c0,6.641,5.39,12.03,12.03,12.03h168.424c6.641,0,12.03-5.39,12.03-12.03 C192.485,366.299,187.095,360.91,180.455,360.91z"></path> <path d="M381.481,184.088l-83.009-84.2c-4.704-4.752-12.319-4.74-17.011,0c-4.704,4.74-4.704,12.439,0,17.179l62.558,63.46H96.279 c-6.641,0-12.03,5.438-12.03,12.151c0,6.713,5.39,12.151,12.03,12.151h247.74l-62.558,63.46c-4.704,4.752-4.704,12.439,0,17.179 c4.704,4.752,12.319,4.752,17.011,0l82.997-84.2C386.113,196.588,386.161,188.756,381.481,184.088z"></path> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </g> </g></svg>                </a>
                <button class="btn btn-primary" type="submit" onclick="postBrand()">
                    <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" height="1.5em" width="1.5em">
                        <path fill="currentColor" d="M8.1 39.1q-.75.3-1.425-.125T6 37.75V28.9q0-.55.325-.95.325-.4.825-.5L21.1 24 7.15 20.45q-.5-.1-.825-.5Q6 19.55 6 19v-8.75q0-.8.675-1.225Q7.35 8.6 8.1 8.9l32.6 13.7q.9.4.9 1.4 0 1-.9 1.4Z" />
                    </svg>
                </button>
            </div>
            <div class="clearfix"></div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">

            <?php
               $DB->select("select * from brands");

               $brands = $DB->showData();

               for ($i=0; $i < count($brands); $i++) { 
                echo '
                <div class="my-2 border-2 brand col-xs-12 col-sm">
                    <a class="bg-white rounded shadow h-100 hover " href="/edit.php?id='.$brands[$i]["id"].'"><img src="'.$brands[$i]["brandLogo"].'" class="img-thumbnail" />
                    </a>
                </div>';
               }

            ?>

            </div>
        </div>

        <div class="modal fade" id="exampleModalToggle" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel">POST BRAND</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="data" enctype="multipart/form-data">
                            <div class="mx-auto my-5 w-75">
                                <div class="mb-3 col-sm-6">
                                    <label for="brandName" class="col-form-label">Brand Name:</label>
                                    <input type="text" class="form-control" name="brandName" id="brandName" placeholder="Brand Name">
                                </div>
                                <div class="mb-3 col-sm-6">
                                    <label for="brandSite" class="col-form-label">Brand Site:</label>
                                    <input type="text" class="form-control" name="brandSite" id="brandSite" placeholder="Website">
                                </div>

                                <div class="mb-3 col-sm-6">
                                    <label for="brandSite" class="col-form-label">Brand Logo:</label>
                                    <input type="file" class="form-control" id="file" name="file" placeholder="Brand Logo">
                                </div>
                                <input type="hidden" class="form-control" id="" name="upload" value="brandLogo">
                                <button class="btn btn-primary fw-bold" id="brandSubmit">SUBMIT</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
       
    </main>






    <footer class="bottom-0 text-center rounded-top">
        <div class="p-5 bg-lightgray-2 info">...</div>
        <div class="p-3 bg-lightgray-3 about">...</div>
    </footer>

    <!-- Update Brands  -->

    <script>

        function editBrand() {
            var myModal = new bootstrap.Modal(document.getElementsBy('exampleModalToggle2'), {
                keyboard: false
            })

            myModal.show();

        }
    </script>

    <script>
        function postBrand() {
            var myModal = new bootstrap.Modal(document.getElementById('exampleModalToggle'), {
                keyboard: false
            })

            myModal.show();

        }


        $("form#data").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: 'function.php',
                type: 'POST',
                data: formData,
                success: function(data) {
                    
                    if (data == "success") {
                        window.location.reload(true);                    }
                    else {
                        alert(data);
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
    </script>

    <script src="js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
</body>

</html>