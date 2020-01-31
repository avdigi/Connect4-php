<?php
session_start();
    if(isset($_SESSION['username'])){
        ob_start();
        header('Location: https://secure.digiovanni.dev/');
        ob_end_flush();
        die();
    }
    require("../src/backend.php");
    $bd = new Backend();
    
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://unpkg.com/tailwindcss@1.0.4/dist/tailwind.min.css" rel="stylesheet">    
    <link href="../assets/css/login.css" rel="stylesheet">
    
    <title>Connect 4 - Forgot Password</title>

</head>
<body class="h-screen overflow-hidden flex items-center justify-center" style="background: #edf2f7;">
    <div class="gradBg h-screen w-screen">
    <div class="flex flex-col items-center flex-1 h-full justify-center px-4 sm:px-0">
        <div class="flex rounded-lg shadow-lg w-full sm:w-3/4 lg:w-1/2 bg-white sm:mx-0 h-auto max-w-xl">
            <div class="flex flex-col w-full p-4">
                <div class="flex flex-col flex-1 justify-center mb-8">
                    <div id="logoContainer" class="mt-4">
                    <!-- With thanks to Alessandro Benassi - Source: https://codepen.io/solidpixel/pen/RZoJeO  -->
                        <svg onmouseenter="startAnimation()" onmouseleave="stopAnimation()" onclick="speedAnimation()" version="1.1" id="loading-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="992 -1075 596 596" style="enable-background:new 992 -1075 596 596;" xml:space="preserve">
                        <circle class="st0" cx="1290" cy="-951.9" r="94.8"/>
                        <circle class="st1" cx="1464.9" cy="-777" r="94.8"/>
                        <circle class="st2" cx="1290" cy="-602.1" r="94.8"/>
                        <circle class="st3" cx="1115.1" cy="-777" r="94.8"/>
                        </svg>
                    </div>
                        
                    <h1 class="text-4xl text-center font-thin">Connect 4</h1>
                    <h2 class="text-3xl text-center font-regular">Forgot your password? No Problem!</h2>
                    <h2 class="text-2xl text-center font-thin">Enter your email below and</br> we will email you a new password!</h2>
                    
                    <div class="w-full mt-4 mb-2">
                        <form class="form-horizontal w-3/4 mx-auto" method="POST" action="#">
                            <div class="flex flex-col mt-4">
                                <input id="email" type="text" class="flex-grow h-8 px-2 border rounded border-grey-400" name="email" value="" required placeholder="Email">
                            </div>
                            <div class="flex flex-col mt-8">
                                <button type="submit" class="btn gradBtn text-white text-sm font-semibold py-2 px-4 rounded">
                                    Request Password
                                </button>
                                <a href="../login/" class=" mt-2 text-center text-blue-500 bg-transparent hover:bg-blue-700 border border-blue-500 text-blue-500 hover:text-white text-sm font-semibold py-2 px-4 rounded">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Javascript stuff -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/TweenMax.min.js"></script>
<script src="../assets/js/logo.js"></script>
</body>
</html>
