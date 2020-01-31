<?php
session_start();
header('Content-Type: text/event-stream');
header("Cache-Control: no-cache"); // Prevent Caching

//set up database
require_once __DIR__.'/chat_model.php';
$chatM = New ChatModel();
$gameid = $_SESSION["gameid"];
$data = $chatM->getChat($gameid);

echo "data: ".$data."\n\n";
echo "retry: 2000\n";
ob_flush();
flush();
?>