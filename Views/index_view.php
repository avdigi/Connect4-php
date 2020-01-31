<?php

    /**
    * The home page view
    */
    class IndexView
    {

        private $model;

        private $controller;

        private $publicRoom;


        function __construct($controller, $model)
        {
            $this->controller = $controller;

            $this->model = $model;
            $this->publicRoom = 1;
            if(!isset($_SESSION["gameid"])){
                $_SESSION["gameid"] = 0;
            }
            if(!isset($_SESSION["username"])){
                ob_start();
                header("Location: /login");
                ob_end_flush();
                die();
            exit();
            } else {
                $this->gameid = $_SESSION["gameid"];
                $this->username = $_SESSION["username"];
                $this->paintIndex();
            }
        }

        public function paintIndex()
        {
            echo '
            <script src="/includes/js/activity.js"></script>
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
                        <div class="w-auto flex text-right">
        
                            <div class="flex items-center ml-2">
                                <span class="text-white text-xl mr-5">Welcome, '.$this->username.'</span>
                                <button onclick="location.href=\'../login\'" id="login-button" class="block no-underline inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-gray-900 hover:bg-white mt-4 sm:mt-0">Log out</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Nav Bar END -->

            <!--Modal-->
            <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
              <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
              
              <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                
                <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                  <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                  </svg>
                  <span class="text-sm">(Esc)</span>
                </div>
          
                <!-- Add margin if you want to see some of the overlay behind the modal-->
                <div class="modal-content py-4 text-left px-6">
                  <!--Title-->
                  <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Challenge!</p>
                    <div class="modal-close cursor-pointer z-50">
                      <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                      </svg>
                    </div>
                  </div>
          
                  <!--Body-->
                  <p>Somebody has challenged you!</p>
          
                  <!--Footer-->
                  <div class="flex justify-end pt-2">
                    <button class="modal-accept px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Accept</button>
                    <button class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Decline</button>
                  </div>
                  
                </div>
              </div>
            </div>
        
        
            <!-- Main Section -->
            <div class="flex-grow container mx-auto sm:px-4 pt-6 pb-8">
                <!-- Chat  & online users Row -->
                <div class="flex flex-wrap -mx-4 ">
        
                    <!--Chat Window -->
                    <div class="w-full mb-6 lg:mb-0 lg:w-3/4 px-4 flex flex-col ">
                        <div class="transparentWindow sm:rounded shadow ">
                            <div class="border-b bg-gray-200">
                                <div class="flex justify-between px-6 -mb-px">
                                    <h3 class="text-gray-900 py-4 font-normal text-lg">Public Chatroom</h3>
                                </div>
                            </div>
                            <div>
                                <div id="chattext" class="text-left px-6 py-4 onlineUsers overflow-y-scroll semiTransparentWindow">
                                <!--all text messages goes here -->
                                </div>
                                <div class="px-6 py-4 bg-gray-200 shadow-lg">
                                    <div class="px-4 py-4 flex items-center">
                                        <div class="flex items-center w-full">
                                            <input id="text" class="textInput flex-1 w-4/5 border rounded px-2 py-2 mr-2" type="text">
                                            <button id="chat_btn" onclick="sendChat(\''.$this->username.'\')" class="flex bg-blue-500 hover:bg-blue-700 text-white text-center font-bold py-2 px-4 rounded">Send</button>
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
                    <div class="w-full mb-6 lg:mb-0 lg:w-1/4 flex-grow h-full">
                        <div class="flex-grow flex flex-col transparentWindow sm:rounded shadow overflow-hidden ">
                            <div class="border-b bg-gray-200">
                                <div class="flex justify-between px-6 -mb-px">
                                    <h3 class="text-gray-900 py-4 font-normal text-xl">Online Players</h3>
                                </div>
                            </div>
                            <div class="onlineUsers overflow-y-scroll semiTransparentWindow">
                                <table class="w-full shadow-lg rounded">
                                    <tbody class="bg-white "  id="peopletext">
                                    </tbody>
                                </table>
                            </div>
                            <div class="px-6 py-4 bg-gray-200">
                                <div class="px-4 py-4 flex items-center">
                                    <div class="text-center flex-1 mx-4 px-2 py-1">
                                    <span class="text-lg">'.$this->username.' - <span class="text-green-500">Online</span></span>
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
        <script src="/includes/js/chat.js"></script>
        <script>
        function beginChallenge(){
            location.href = "../Game/checkers.php?player='.$this->username.'&gameId='.$this->gameid.'";
        }
        </script>
        <script src="/includes/js/challenge.js"></script>
        <script>
        const node = document.getElementsByClassName("textInput")[0];
        node.addEventListener("keyup", function(event) {
            if (event.key === "Enter") {
                sendChat(\''.$this->username.'\');
            }
        });
        </script>';
        }

    }