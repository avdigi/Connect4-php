<?php

    /**
    * The Login page view
    */
    class LoginView
    {

        private $modelObj;

        private $controller;


        function __construct($controller, $model)
        {

            $this->paintLogin();
            $this->controller = $controller;

            $this->modelObj = $model;
        }

        public function paintLogin()
        {
            echo '
            <body class="h-screen overflow-hidden flex items-center justify-center" style="background: #edf2f7;">
                <div class="gradBg h-screen w-screen">
                <div id="loginForm" class="flex flex-col items-center flex-1 h-full justify-center px-4 sm:px-0">
                    <div class="flex rounded-lg shadow-lg w-full sm:w-3/4 lg:w-1/2 bg-white sm:mx-0 h-auto max-w-5xl">
                        <div class="flex flex-col w-full md:w-1/2 p-4">
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
                                <div class="w-full mt-4">
                                    <form class="form-horizontal w-3/4 mx-auto" method="POST">
                                        <div class="flex flex-col mt-4">
                                            <input id="username" type="text" class="flex-grow h-8 px-2 border rounded border-grey-400" name="username" value="" required placeholder="Username">
                                        </div>
                                        <div class="flex flex-col mt-4">
                                            <input id="password" type="password" class="flex-grow h-8 px-2 rounded border border-grey-400" name="pass" required placeholder="Password">
                                        </div>
                                        <div class="flex items-center mt-4">
                                            <label for="remember" class="flex items-center cursor-pointer text-sm text-grey-dark mx-auto">
                                                <div class="relative">
                                                <input type="checkbox" name="remember" id="remember" value="1" class="hidden" />
                                                <div
                                                    class="toggle__line w-10 h-4 bg-gray-400 rounded-full shadow-inner"
                                                ></div>
                                                <div
                                                    class="toggle__dot absolute w-6 h-6 bg-gray-200 rounded-full shadow inset-y-0 left-0"
                                                ></div>
                                                </div>
                                                <div class="ml-3">Remember Me</div>
                                            </label>
                                        </div>


                                        <div class="flex flex-col mt-8">
                                            <button  class="btn gradBtn text-white text-sm font-semibold py-2 px-4 rounded">
                                                Login
                                            </button>
                                            <a href="../register" class="mt-2 text-center text-blue-500 bg-transparent hover:bg-blue-700 border border-blue-500 text-blue-500 hover:text-white text-sm font-semibold py-2 px-4 rounded">
                                                Register
                                            </a>
                                        </div>
                                    </form>
                                    <div class="text-center mt-4">
                                        <a class="no-underline hover:underline text-blue-dark text-xs" href="forgot.php">
                                            Forgot Your Password?
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hidden md:block md:w-1/2 rounded-r-lg loginImg"></div>
                    </div>
                </div>
            </div>
            </body>';
        }


    }