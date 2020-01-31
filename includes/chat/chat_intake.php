<?php
session_start();
$text = "";
$date = date('H:i');
if(isset($_POST['text']) && isset($_SESSION['uname'])) {
    $text = "<b>".$_SESSION['uname']."</b> [<b>".$date."</b>]: ".$_POST['text']."\n";
    $handle = fopen("chat.txt", "a");
    fwrite($handle, $text);
    fclose($handle);
    exit();
}
if(isset($_POST['uname'])) {
    $_SESSION['uname'] = $_POST['uname'];
    echo "success";
    exit();
}
?>