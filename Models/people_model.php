<?php
session_start();
header('Content-Type: text/event-stream');
header("Cache-Control: no-cache"); // Prevent Caching
$username = $_SESSION['username'];

//set up database
require_once __DIR__.'/chat_model.php';
$chatM = New ChatModel();
$data = $chatM->getOnlineUsers($username);

echo "data: ".$data."\n\n";
echo "retry: 6000\n";
// Do not make retry less than 15000(15 seconds) on shared hosting
// And limit simultaneous users to prevent exceeding server resources
ob_flush();
flush();
?>