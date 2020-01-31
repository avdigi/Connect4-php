<?php
	require_once("../src/backend.php");
    $bd = new Backend();
    
    require_once("../src/auth.php");

    $username = $_SESSION["username"];
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
</head>

<body class="h-screen">
    <div class="font-sans gradBg w-full px-6">

        <!-- Nav Bar -->
        <div>

            <div class="flex-grow container mx-auto sm:px-4 pt-6 pb-8">
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
        </div>
        <!-- Nav Bar END -->

        <!-- Main Section -->
        <div class="flex-grow container mx-auto sm:px-4 pt-6 pb-8">
            <div class="bg-white border-t border-b sm:border-l sm:border-r sm:rounded shadow mb-6">
                <div class="border-b px-6">
                    <div class="flex justify-between -mb-px">
                        <div class="lg:hidden text-blue-600 py-4 text-lg">
                            Price Charts
                        </div>
                        <div class="hidden lg:flex">
                            <button type="button" class="appearance-none py-4 text-blue-600 border-b border-blue-600 mr-6">
                                Bitcoin &middot; CA$21,404.74
                            </button>
                            <button type="button" class="appearance-none py-4 text-gray-600 border-b border-transparent hover:border-gray-600 mr-6">
                                Ethereum &middot; CA$884.80
                            </button>
                            <button type="button" class="appearance-none py-4 text-gray-600 border-b border-transparent hover:border-gray-600">
                                Litecoin &middot; CA$358.24
                            </button>
                        </div>
                        <div class="flex text-sm">
                            <button type="button" class="appearance-none py-4 text-gray-600 border-b border-transparent hover:border-gray-600 mr-3">
                                1M
                            </button>
                            <button type="button" class="appearance-none py-4 text-gray-600 border-b border-transparent hover:border-gray-600 mr-3">
                                1D
                            </button>
                            <button type="button" class="appearance-none py-4 text-gray-600 border-b border-transparent hover:border-gray-600 mr-3">
                                1W
                            </button>
                            <button type="button" class="appearance-none py-4 text-blue-600 border-b border-blue-600 mr-3">
                                1M
                            </button>
                            <button type="button" class="appearance-none py-4 text-gray-600 border-b border-transparent hover:border-gray-600 mr-3">
                                1Y
                            </button>
                            <button type="button" class="appearance-none py-4 text-gray-600 border-b border-transparent hover:border-gray-600">
                                ALL
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex items-center px-6 lg:hidden">
                    <div class="flex-grow flex-shrink-0 py-6">
                        <div class="text-gray-700 mb-2">
                            <span class="text-3xl align-top">CA$</span>
                            <span class="text-5xl">21,404</span>
                            <span class="text-3xl align-top">.74</span>
                        </div>
                        <div class="text-green-400 text-sm">
                            &uarr; CA$12,955.35 (154.16%)
                        </div>
                    </div>
                    <div class="flex-shrink w-32 inline-block relative">
                        <select class="block appearance-none w-full bg-white border border-gray-400 px-4 py-2 pr-8 rounded">
                            <option>BTC</option>
                            <option>ETH</option>
                            <option>LTC</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-grey">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:flex">
                    <div class="w-1/3 text-center py-8">
                        <div class="border-r">
                            <div class="text-gray-700 mb-2">
                                <span class="text-3xl align-top">CA$</span>
                                <span class="text-5xl">21,404</span>
                                <span class="text-3xl align-top">.74</span>
                            </div>
                            <div class="text-sm uppercase text-grey tracking-wide">
                                Bitcoin Price
                            </div>
                        </div>
                    </div>
                    <div class="w-1/3 text-center py-8">
                        <div class="border-r">
                            <div class="text-gray-700 mb-2">
                                <span class="text-3xl align-top"><span class="text-green-500 align-top">+</span>CA$</span>
                                <span class="text-5xl">12,998</span>
                                <span class="text-3xl align-top">.48</span>
                            </div>
                            <div class="text-sm uppercase text-grey tracking-wide">
                                Since last month (CAD)
                            </div>
                        </div>
                    </div>
                    <div class="w-1/3 text-center py-8">
                        <div>
                            <div class="text-gray-700 mb-2">
                                <span class="text-3xl align-top"><span class="text-green-500 align-top">+</span></span>
                                <span class="text-5xl">154.47</span>
                                <span class="text-3xl align-top">%</span>
                            </div>
                            <div class="text-sm uppercase text-grey tracking-wide">
                                Since last month (%)
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
</html>
