<?php

$chatM;

error_reporting (E_ALL);
//set up database
require '../../Models/chat_model.php';
$this->chatM = New ChatModel();

session_start();
$text = "";


if(isset($_POST['text']) && isset($_POST['room']) && isset($_SESSION['username'])) {
    $this->chatM->postChat($_POST['room'], $_SESSION['uname'], $_POST['text']);
    echo "success";
    exit();
}
?>