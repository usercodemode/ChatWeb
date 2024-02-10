<?php

$servername = "localhost";
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
        name varchar(255) not null,
        password varchar(255) not null,
        primary key (`id`))");
    }


    echo "Do you want to create 'brands' table: (yes/no): ";

    $input = readline("");
    if($input == "yes"){
    mysqli_query($conn, "create table if not exists brands (
        id INT(255) AUTO_INCREMENT NOT NULL,
        brandName varchar(255) not null,
        brandLogo varchar(255) not null,
        brandSite varchar(255) not null,
        user_id varchar(255) not null,

        primary key (`id`))");
    }

    echo "If you didn't recieve any error then check your database.";

    $key = 1;
}

?>