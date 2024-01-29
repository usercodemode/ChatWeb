<!DOCTYPE html>
<?php

session_start();

require("manageDB.php");

$DB = new DBmanager();


$user = !empty($_SESSION['user']) ? $_SESSION['user'] : "";

?>


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
    <div class="p-2 mx-0 my-5 bg-white rounded shadow mx-sm-5">

      <div class="p-4 rounded bg-primary">...</div>
      <div class="p-2 mt-2 border border-black rounded bg-light message scroll" id="scroll">
        <?php

        $DB->select("select * from chat", "");

        $data = $DB->showData();



        for ($i = 0; $i < count($data); $i++) {

          if ($user != $data[$i]["user"]) {

            echo '<br><div class="my-2 col-8 float-start">
<span class="d-inline">
<img class="my-1 img-thumbnail rounded-circle" src="/img/coding.png" alt="" width="45" height="45" align="left"/>
</span>  
<div class="p-2 m-1 bg-white rounded d-inline-block float-start font-jost text-dark">
  <font color="darkorange"><b>(@' . $data[$i]["user"] . '): </b></font> 
  ' . htmlspecialchars($data[$i]["message"]) . '
</div>
<div class="clearfix"></div>
</div><br>';
          } else {
            echo '<br><div class="my-2 col-8 float-end">
<span class="d-inline">
<img class="my-1 img-thumbnail rounded-circle" src="/img/coding.png" alt="" width="45" height="45" align="right"/>
</span>  
<div class="p-2 m-1 text-white rounded shadow bg-primary d-inline-block float-end font-jost">
 
    ' . htmlspecialchars(($data[$i]["message"])) . '

</div>
<div class="clearfix"></div>
</div><br>';
          }
        }


        ?>


        <div class="clearfix"></div>
      </div>

      <div class="p-2 mt-2 border border-black rounded bg-light">
        <textarea class="p-2 border border-black rounded float-start col-8 border-3" name="message" rows="2"></textarea>
        <button class="btn btn-primary" type="submit" onclick="user()">
          <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" height="1.5em" width="1.5em">
            <path fill="currentColor" d="M8.1 39.1q-.75.3-1.425-.125T6 37.75V28.9q0-.55.325-.95.325-.4.825-.5L21.1 24 7.15 20.45q-.5-.1-.825-.5Q6 19.55 6 19v-8.75q0-.8.675-1.225Q7.35 8.6 8.1 8.9l32.6 13.7q.9.4.9 1.4 0 1-.9 1.4Z" />
          </svg>
        </button>
        <div class="clearfix"></div>
      </div>

    </div>

    <div class="modal fade" id="exampleModalToggle" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalToggleLabel">SIGN IN</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mx-auto my-5 w-75">
              <div class="mb-3 col-sm-6">
                <label for="loginUsername" class="col-form-label">Username:</label>
                <input type="text" class="form-control" id="loginUsername" placeholder="Username">
              </div>
              <div class="mb-3 col-sm-6">
                <label for="loginPassword" class="col-form-label">Password:</label>
                <input type="text" class="form-control" id="loginPassword" placeholder="Password">
              </div>
              <button class="btn btn-primary fw-bold" id="loginUser">SIGN IN</button>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary fw-bold" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">CREATE NEW ACCOUNT</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="exampleModalToggle2" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalToggleLabel2">SIGN UP</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <div class="mx-auto my-5 w-75">

              <div class="mb-3 col-sm-6">
                <label for="email" class="col-form-label">Email:</label>
                <input type="text" class="form-control" id="email" placeholder="Email">
              </div>

              <div class="mb-3 col-sm-6">
                <label for="newUsername" class="col-form-label">Username:</label>
                <input type="text" class="form-control" id="newUsername" placeholder="Username">
              </div>
              <div class="mb-3 col-sm-6">
                <label for="newPassword" class="col-form-label">Password:</label>
                <input type="text" class="form-control" id="newPassword" placeholder="Password">
              </div>
              <button class="btn btn-primary fw-bold" id="registerUser">SIGN UP</button>
            </div>

          </div>
          <div class="modal-footer">
            <button class="btn btn-primary fw-bold" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">BACK TO SIGN IN</button>
          </div>
        </div>
      </div>
    </div>

  </main>



  <footer class="bottom-0 text-center rounded-top">
    <div class="p-5 bg-lightgray-2 info">...</div>
    <div class="p-3 bg-lightgray-3 about">...</div>
  </footer>

  <script>
    function user() {
      var user = "<?php echo $user; ?>";
      if (user == "") {
        var myModal = new bootstrap.Modal(document.getElementById('exampleModalToggle'), {
          keyboard: false
        })

        myModal.show();
      } else {
        var message = $("textarea").val();
        if (message != "") {
          $.post("function.php", {
              user: user,
              message: message
            },
            function(data, status) {
              //alert("Data: " + data + "\nStatus: " + status);
              if (data = "message") {

                $("#scroll").load(location.href + " #scroll>*", "");

                updateScroll();

              }
            });
        }
      }
    }
  </script>

  <!-- Login & Register -->
  <script>
    $(document).ready(function() {

      $("#loginUser").click(function() {

        var username = $("#loginUsername").val();
        var password = $("#loginPassword").val();
        if (username != "" && password != "") {
          $.post("function.php", {
              account: "login",
              user: username,
              password: password
            },
            function(data, status) {
              alert("Data: " + data + "\nStatus: " + status);
              //$("#username").val(username);
              if (data == "true") {
                window.location.reload(true);
              }
            });
        } else {
          alert("Please enter all fields!");
        }
      });

    });
  </script>

  <script>
    $(document).ready(function() {
      $("#registerUser").click(function() {

        var email = $("#email").val();
        var username = $("#newUsername").val();
        //$("#username").attr("value", username); 
        var password = $("#newPassword").val();
        if (email != "" && username != "" && password != "") {
          $.post("function.php", {
              account: "register",
              email: email,
              user: username,
              password: password
            },
            function(data, status) {
              alert("Data: " + data + "\nStatus: " + status);
            });
        } else {
          alert("Please enter all fields!");
        }
      });

    });
  </script>

  <!-- Reload -->
  <script>
    var updateData = '<?php echo count($data); ?>';

    setInterval(function() {

      $.post("function.php", {
          reload: "reload"
        },
        function(chatData, status) {
          //alert("Data: " + data + "\nStatus: " + status);
          if (updateData != chatData) {
            $("#scroll").load(location.href + " #scroll>*", "");
            $("#scroll").scrollTop($("#scroll").scrollTop() + 75);

            updateData = chatData;

          }
        });
    }, 1000);
  </script>


  <script src="js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
  <script src="js/script.js" type="text/javascript" charset="utf-8"></script>
</body>

</html>