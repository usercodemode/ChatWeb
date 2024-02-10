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
        <div class="container p-4 mx-auto h-100">


            <?php

            if (isset($_GET)) {

                $DB->select("select * from brands where id=:id", [':id' =>  (int)htmlentities($_GET["id"])]);

                $brand = $DB->showData();

                if (count($brand) == 1) {
                    echo '
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                    <div class="my-2 border-2 brand col-xs-12 col-sm">
                        <div class="bg-white rounded shadow h-100 hover " href="#"><img src="' . $brand[0]["brandLogo"] . '" class="img-thumbnail" />
                        </div>
                    </div>

                    </div>

                    <div class="mx-auto my-5 w-75">

                            
                    <form method="post" onsubmit="return false" id="data" enctype="multipart/form-data">
                            <div class="mb-3 col-sm-6">
                                <label for="newBrandName" class="col-form-label">Brand Name:</label>
                                <input type="text" class="form-control" id="brandName" name="brandName" placeholder="Brand Name" value="' . $brand[0]["brandName"] . '">
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label for="newBrandSite" class="col-form-label">Brand Site:</label>
                                <input type="text" class="form-control" id="brandSite" name="brandSite" placeholder="Website" value="' . $brand[0]["brandSite"] . '">
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label for="file" class="col-form-label">Brand Logo:</label>
                                <input type="file" class="form-control" id="file" name="file" placeholder="Choose Image">
                            </div>
                            <input type="hidden" class="form-control" id="" name="upload" value="updateBrand">


                            <input type="hidden" class="form-control" id="" name="id" value="' . $brand[0]["id"] . '">

                            <button class="btn btn-primary fw-bold" id="updateBrand">UPDATE</button>

                            <button class="btn btn-danger fw-bold" onclick="deleteBrand()">DELETE</button>

                        </div>
                    </form>

                    
                    
                    
                    ';
                } else {
                    echo "Brand doesn't exists";
                }
            } else {
                echo "404";
            }

            ?>




        </div>


    </main>






    <footer class="bottom-0 text-center rounded-top">
        <div class="p-5 bg-lightgray-2 info">...</div>
        <div class="p-3 bg-lightgray-3 about">...</div>
    </footer>

    <!-- Login & Register -->


    <script>
        function postBrand() {
            var myModal = new bootstrap.Modal(document.getElementById('exampleModalToggle'), {
                keyboard: false
            })

            myModal.show();

        }


        $("form#data").submit(function(e) {
            //e.preventDefault();
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


        function deleteBrand() {
            var id = <?php echo $brand[0]["id"] ?>;
            if (id != "") {

                $.post("function.php", {
                        delete: "brand",
                        id: id,
                    },
                    function(data, status) {

                    if (data == "success") {
                        window.location.reload(true);                    }
                    else {
                        alert(data);
                    }
                    
                    });
            }

        }

    </script>

    <script src="js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
</body>

</html>