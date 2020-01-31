<?php

    //if (!isset($_SERVER['PATH_INFO']))
    //{
    //    echo "Home page";
    //}
    //print "The request path is : ".$_SERVER['PATH_INFO'];

    ///this header needs to be moved to a separate controller

	require_once("src/backend.php");
    $bd = new Backend();
    
    require_once("src/auth.php");

    $username = $_SESSION["username"];
    $_SESSION['last_line'] = "";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Connect 4</title>
    <!--
        <link href="https://unpkg.com/tailwindcss@0.3.0/dist/tailwind.min.css" rel="stylesheet">
    -->
    <link href="https://unpkg.com/tailwindcss@1.0.4/dist/tailwind.min.css" rel="stylesheet">
    <link href="../assets/css/login.css" rel="stylesheet">
<script>
var source, chattext, last_data, chat_btn, conx_btn, disconx_btn, text;
var hr = new XMLHttpRequest();
function connect(){
    if(window.EventSource){
        source = new EventSource("chat/server.php");
        source.addEventListener("message", function(event){
            if(event.data != last_data && event.data != ""){
                msg = '<div class="bg-gray-200 rounded shadow sm:border py-2 px-3 my-4">'+event.data+'</div>';
                chattext.innerHTML += msg;
            }
            last_data = event.data;
        });
        chat_btn.disabled = false;
        scrollSmoothToBottom("chattext");
    } else {
        alert("event source does not work in this browser, author a fallback technology");
        // Program Ajax Polling version here or another fallback technology like flash
    }
}
function disconnect(){
    source.close();
    chat_btn.disabled = true;
}
function chatPost(){
    chat_btn.disabled = true;
    hr.open("POST", "chat/chat_intake.php", true);
    hr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function() {
        if(hr.readyState == 4 && hr.status == 200) {
            chat_btn.disabled = false;
            text.value = "";
        }
    }
    hr.send("text="+text.value);
}
var promptValue = '<?php echo $username; ?>';
if(promptValue != null){
	hr.open("POST", "chat/chat_intake.php", true);
	hr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    if(hr.responseText == "success"){
				chattext = document.getElementById("chattext");
				chat_btn = document.getElementById("chat_btn");
				text = document.getElementById("text");
			}
	    }
    }
	hr.send("uname="+promptValue);
}

function scrollToBottom (id) {
   var div = document.getElementById(id);
   div.scrollTop = div.scrollHeight - div.clientHeight;
}

function scrollSmoothToBottom (id) {
   var div = document.getElementById(id);
   $('#' + id).animate({
      scrollTop: div.scrollHeight - div.clientHeight
   }, 500);
}

</script>
</head>

<body class="h-screen font-sans w-full" onload="connect();">
    <div class="gradBg w-full px-6">
    <!-- Nav Bar -->
    <div class="flex-grow container mx-auto sm:px-4 pt-6">
        <div class="container mx-auto px-4">
            <div class="flex items-center md:justify-between py-4">
                <div class="sm:mt-1 w-1/2 md:w-auto text-center text-white text-2xl font-medium flex items-center flex-shrink-0 text-white">

                    <div id="logoContainer">
                        <!-- With thanks to Alessandro Benassi - Source: https://codepen.io/solidpixel/pen/RZoJeO  -->
                        <svg onmouseenter="startAnimation()" onmouseleave="stopAnimation()" onclick="speedAnimation()" version="1.1" id="loading-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="992 -1075 596 596" style="enable-background:new 992 -1075 596 596;" xml:space="preserve">
                            <circle class="st0" cx="1290" cy="-951.9" r="94.8" />
                            <circle class="st1" cx="1464.9" cy="-777" r="94.8" />
                            <circle class="st2" cx="1290" cy="-602.1" r="94.8" />
                            <circle class="st3" cx="1115.1" cy="-777" r="94.8" />
                        </svg>
                    </div>

                    <h1 class="text-4xl text-center font-thin">Connect 4</h1>
                </div>
                <div class="w-1/4 md:w-auto md:flex text-right">

                    <div class="hidden md:flex md:items-center ml-2">
                        <span class="text-white text-xl mr-5">Welcome, <?php echo $username; ?></span>
                        <button onclick="location.href='../login/logout.php/'" id="login-button" class="block no-underline inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-gray-900 hover:bg-white mt-4 sm:mt-0">Log out</button>
                    </div>

                    <div class="md:hidden">
                        <svg class="fill-current text-white h-8 w-8 mr-0 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M16.4 9H3.6c-.552 0-.6.447-.6 1 0 .553.048 1 .6 1h12.8c.552 0 .6-.447.6-1 0-.553-.048-1-.6-1zm0 4H3.6c-.552 0-.6.447-.6 1 0 .553.048 1 .6 1h12.8c.552 0 .6-.447.6-1 0-.553-.048-1-.6-1zM3.6 7h12.8c.552 0 .6-.447.6-1 0-.553-.048-1-.6-1H3.6c-.552 0-.6.447-.6 1 0 .553.048 1 .6 1z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Nav Bar END -->


    <!-- Main Section -->
    <div class="flex-grow container mx-auto sm:px-4 pt-6 pb-8">
        <!-- Chat  & online users Row -->
        <div class="flex flex-wrap -mx-4 ">

            <!--Chat Window -->
            <div class="w-full mb-6 lg:mb-0 lg:w-3/4 px-4 flex flex-col ">
                <div class="bg-white border-t border-b sm:rounded sm:border shadow ">
                    <div class="border-b">
                        <div class="flex justify-between px-6 -mb-px">
                            <h3 class="text-gray-900 py-4 font-normal text-lg">Public Chatroom</h3>
                        </div>
                    </div>
                    <div>
                        <div id="chattext" class="text-left px-6 py-4 onlineUsers overflow-y-scroll bg-blue-400">
                        <!--all text messages goes here -->
                        </div>
                        <div class="px-6 py-4 bg-gray-200 shadow-lg">
                            <div class="px-4 py-4 flex items-center">
                                <div class="flex items-center w-full">
                                    <input id="text" class="textInput flex-1 w-4/5 border rounded px-2 py-2 mr-2" type="text">
                                    <button id="chat_btn" onclick="chatPost()" class="flex bg-blue-500 hover:bg-blue-700 text-white text-center font-bold py-2 px-4 rounded">Send</button>
                                </div>
                                <div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Chat Window END -->

            <!--online users table-->
            <div class="w-full mb-6 lg:mb-0 lg:w-1/4 px-4 flex flex-col h-full">
                <div class="flex-grow flex flex-col bg-white border-t border-b sm:rounded sm:border shadow overflow-hidden ">
                    <div class="border-b">
                        <div class="flex justify-between px-6 -mb-px">
                            <h3 class="text-gray-900 py-4 font-normal text-xl">Online Players</h3>
                        </div>
                    </div>
                    <div class="onlineUsers overflow-y-scroll bg-blue-400">
                        <table class="w-full shadow-lg rounded bg-blue-400">
                            <tbody class="bg-white ">
                                <?php $bd->db->getOnline($_SESSION["username"]); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-4 bg-gray-200">
                        <div class="px-4 py-4 flex items-center">
                            <div class="text-center flex-1 mx-4 px-2 py-1">
                            <span class="text-lg"><?php echo $username; ?> - <span class="text-green-500">Online</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--online users table END-->
        </div>
        <!-- Row END -->

    </div>
    <!-- Main Section END -->
    </div>
</body>
<!-- Javascript stuff -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/TweenMax.min.js"></script>
<script src="../assets/js/logo.js"></script>
<script src="../assets/js/login.js"></script>
<script src="../assets/js/activity.js"></script>
<script>
//binds enter key to chatPost() function
const node = document.getElementsByClassName("textInput")[0];
node.addEventListener("keyup", function(event) {
    if (event.key === "Enter") {
        chatPost();
    }
});
</script>
</html>