<?php

session_start();

require('manageDB.php');

$DB = new DBmanager();

if (!empty($_POST['account']) && $_POST['account'] == "login" && !empty($_POST['email']) && !empty($_POST['password'])) {

  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);

  if ($DB->select("select id from account where email=:email && password=:password", [':email' => $email, ':password' => md5($password)])) {
    //print_r(count($DB->showData()));
    if (count($DB->showData()) == 1) {
      //echo "true";
      $account = $DB->showData();
      $id = $account[0]['id'];
      $_SESSION['id'] = $id;
      
      echo "success";
    } else {
      echo "Invalid credentials !";
    }
  } else {
    echo "Signed in unsuccessfull!";
  }
}


if (!empty($_POST['account']) && $_POST['account'] == "register" && !empty($_POST['email']) && !empty($_POST['name']) && !empty($_POST['password'])) {
  //echo "register";

  $email = htmlspecialchars($_POST['email']);
  $name = htmlspecialchars($_POST['name']);
  $password = htmlspecialchars($_POST['password']);

  if (strlen($password) < 8) {
    echo "Password should have atleast 8 characters.";
    return;
  }

  if ($DB->select("select id from account where email=:email", [':email' => $email])) {
    //print_r(count($DB->showData()));
    if (count($DB->showData()) == 1) {
      echo "Email is already taken!";
      return;
    } 
  }

  if ($DB->insert("insert into account(email, name, password) values(:email, :name, :password)", [':email' => $email, ':name' => $name, ':password' =>  md5($password)])) {
    echo "Account created successfully!";
  } else {
    echo "Account creation unsuccessfull!";
  }
}


/* Reload */

if (!empty($_POST['reload']) && $_POST['reload'] == "reload") {
  $DB->select("select * from chat", "");

  $data = $DB->showData();
  echo count($data);
}

if (!empty($_POST['upload']) && $_POST['upload'] == "brandLogo") {
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path = 'uploads/'; // upload directory


$img = $_FILES['file']['name'];
$tmp = $_FILES['file']['tmp_name'];
// get uploaded file's extension
$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
// can upload same image using rand function
$final_image = time().rand(1000,1000000).$img;
// check's valid format
if(in_array($ext, $valid_extensions)) 
{ 
$ImagePath = $path.md5($final_image).'.'.$ext; 
if(move_uploaded_file($tmp,$ImagePath)) 
{
  $brandName = htmlspecialchars($_POST['brandName']);
  $brandSite = htmlspecialchars($_POST['brandSite']);
  
  

  if ($DB->insert("insert into brands(brandName, brandLogo, brandSite, user_id) values(:brandName, :brandLogo, :brandSite, :user_id)", [':brandName' => $brandName, ':brandLogo' => $ImagePath, ':brandSite' => $brandSite, ':user_id' => (int)$_SESSION["id"]])) {
    echo "success";
  } else {
    echo 'Brand posting failed!';
  }
}
} 
else 
{
echo 'invalid';
}
}


if (!empty($_POST['upload']) && $_POST['upload'] == "updateBrand") {
  $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
  $path = 'uploads/'; // upload directory
  $img = $_FILES['file']['name'];
  $tmp = $_FILES['file']['tmp_name'];
  // get uploaded file's extension
  $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
  // can upload same image using rand function
  $final_image = time().rand(1000,1000000).$img;
  // check's valid format
  if(in_array($ext, $valid_extensions)) 
  { 
  $ImagePath = $path.md5($final_image).'.'.$ext; 
  if(move_uploaded_file($tmp,$ImagePath)) 
  {
    $brandName = htmlspecialchars($_POST['brandName']);
    $brandSite = htmlspecialchars($_POST['brandSite']);
   
    $id = (int)htmlspecialchars($_POST['id']);
  
    if ($DB->update("UPDATE brands SET brandName=:brandName, brandLogo=:brandLogo, brandSite=:brandSite, user_id=:user_id 
    WHERE id=:id", [':brandName' => $brandName, ':brandLogo' => $ImagePath, ':brandSite' => $brandSite, ':user_id' => (int)$_SESSION["id"], ':id' => $id])) {
      echo "success";
      //echo "Brand updated successfully!";
      
      if($DB->select("select brandLogo from brands where id=:id", [':id' => (int)$id])) {
        $deleteBrandLogo = $DB->showData();
        //print_r($deleteBrandLogo);
        unlink('/'.$deleteBrandLogo[0]["brandLogo"]);
      }

    } else {
      echo 'Brand update failed!';
    }
  }
  } 
  else 
  {
  echo 'Something went wrong!';
  }
  }

  if (!empty($_POST['delete']) && $_POST['delete'] == "brand") {

  $id = (int)htmlspecialchars($_POST['id']);
  if ($DB->delete("delete from brands where id=:id", [':id' => $id])) {
    echo "success";
  } else {
    echo "Brand deletion unsuccessfull!";
  }
}


?>
