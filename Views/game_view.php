<?php

    /**
    * The Game view
    */
    class GameView
    {

        private $model;

        private $controller;


        function __construct($controller, $model)
        {
            $this->controller = $controller;

            $this->model = $model;
        }

        public function paintGame()
        {
            echo '<!--Chat Window -->
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
                <!--Chat Window END -->';
        }

    }