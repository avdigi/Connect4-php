<?php

    /**
    * The Login page view
    */
    class HeaderView
    {
        function __construct()
        {
            $this->paintHeader();
        }

        public function paintHeader()
        {
            echo '<!doctype html>
                    <html lang="en">
                    <head>
                        <meta charset="utf-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <link href="https://unpkg.com/tailwindcss@1.0.4/dist/tailwind.min.css" rel="stylesheet">    
                        <link href="/includes/css/login.css" rel="stylesheet">
                        <!-- Javascript stuff -->
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/TweenMax.min.js"></script>
                        <script src="/includes/js/logo.js"></script>
                        <script src="/includes/js/login.js"></script>
                        
                        <title>Connect 4</title>
                    </head>';
        }
    }