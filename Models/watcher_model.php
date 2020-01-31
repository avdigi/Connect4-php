<?php
session_start();
header('Content-Type: text/event-stream');
header("Cache-Control: no-cache"); // Prevent Caching

$username = $_SESSION['username'];
//get challenge
require_once __DIR__.'/challenge_model.php';
$chatM = New ChallengeModel();
$data = $chatM->getChallenge($username);
$_SESSION['gameid'] = $data;


echo "data: ".$data."\n\n";
echo "retry: 2000\n";
ob_flush();
flush();
?>