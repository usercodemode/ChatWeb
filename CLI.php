<?php

$servername = "127.0.0.1";
$username = "root";
$password = "root123";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}



$key = 0;
while ($key != 1) {

    echo "CLI TOOL: To setUp database and tables for this project.";
    echo "Enter Database Name: ";
    $DBname = readline("");
    mysqli_query($conn, "create database if not exists {$DBname}");
    mysqli_query($conn, "use {$DBname}");

    echo "Do you want to create 'account' table: (yes/no): ";

    $input = readline("");
    if($input == "yes"){
    mysqli_query($conn, "create table if not exists account (
        id INT(255) AUTO_INCREMENT NOT NULL,
        email varchar(255) not null,
        user varchar(255) not null,
        password varchar(255) not null,
        saltPassword varchar(255) not null,
        primary key (`id`))");
    }


    echo "Do you want to create 'chat' table: (yes/no): ";

    $input = readline("");
    if($input == "yes"){
    mysqli_query($conn, "create table if not exists chat (
        id INT(255) AUTO_INCREMENT NOT NULL,
        user varchar(255) not null,
        message varchar(255) not null,

        primary key (`id`))");
    }

    echo "If you didn't recieve any error then check your database.";

    $key = 1;
}

?>
