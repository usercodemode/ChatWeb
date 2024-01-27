<?php

session_start();

require('manageDB.php');

$DB = new DBmanager();

if (!empty($_POST['account']) && $_POST['account'] == "login" && !empty($_POST['user']) && !empty($_POST['password'])) {
  //echo "login";

  $username = htmlspecialchars($_POST['user']);
  $password = htmlspecialchars($_POST['password']);

  if ($DB->select("select user, password from account where user=:user && password=:password", [':user' => $username, ':password' => $password])) {
    //print_r(count($DB->showData()));
    if (count($DB->showData()) == 1) {
      echo "true";
      $account = $DB->showData();
      $user = $account[0]['user'];
      //print_r($user);
      $_SESSION['user'] = $user;

    } else {
      echo "Invalid credentials !";
    }
  } else
  {
    echo "Signed in unsuccessfull!";
  }

}


if (!empty($_POST['account']) && $_POST['account'] == "register" && !empty($_POST['email']) && !empty($_POST['user']) && !empty($_POST['password'])) {
  //echo "register";

  $email = htmlspecialchars($_POST['email']);
  $username = htmlspecialchars($_POST['user']);
  $password = htmlspecialchars($_POST['password']);
  $saltPassword = "abcd";

  if ($DB->insert("insert into account(email, user, password, saltPassword) values(:email, :user, :password, :saltPassword)", [':email' => $email, ':user' => $username,':password' =>  $password, ':saltPassword' => md5($saltPassword)])) {
    echo "Account created successfully!";
  } else {
    echo "Account creation unsuccessfull!";
  }

}

/* Message */
if (!empty($_POST['user']) && !empty($_POST['message'])) {
  $user = htmlspecialchars($_POST['user']);
  $message = htmlspecialchars($_POST['message']);
  
  if($DB->insert("insert into chat(user, message) values(:user, :message)", [':user' => $user, ':message' => $message])){
    echo "message";
  }
  else {
    echo 'Message failed!';
  }
}

/* Reload */

if (!empty($_POST['reload']) && $_POST['reload'] == "reload"){
  $DB->select("select * from chat", "");

  $data = $DB->showData();
  echo count($data);
}


?>