<!DOCTYPE html>
<html lang="en">
<head>
  <title>Connect 4</title>
	<style type="text/css">
		#background { fill: #666; stroke: black; stroke-width: 2px; }
		.player0   {fill: #990000; stroke: white; stroke-width: 1px; }
		.player1 {fill: green; stroke: red; stroke-width: 1px; }
		.htmlBlock {position:absolute;top:200px;left:300px;width:200px;height:100px;background:#ffc;padding:10px;display:none;}
		body{padding:0px;margin:0px;}
		.cell_white{fill:white;stroke-width:2px;stroke:red;}
		.cell_black{fill:black;stroke-width:2px;stroke:red;}
		.cell_alert{fill:#336666;stroke-width:2px;stroke:red;}
		.name_black{fill:black;font-size:18px}
		.name_orange{fill:orange;font-size:24px;}
		text{pointer-events:none;user-select:none;}
	</style>
	<script src="https://code.jquery.com/jquery-latest.js"></script>
	<script src="js/Objects/Cell.js" type="text/javascript"></script>
	<script src="js/Objects/Piece.js" type="text/javascript"></script>
	<script src="js/gameFunctions.js" type="text/javascript"></script>
	<script src="js/utilFunctions.js" type="text/javascript"></script>
	<script src="js/ajaxFunctions.js" type="text/javascript"></script>
    <link href="https://unpkg.com/tailwindcss@1.0.4/dist/tailwind.min.css" rel="stylesheet">
    <link href="../includes/css/login.css" rel="stylesheet">
	<script type="text/javascript">
			var gameId=<?php echo $_GET['gameId'] ?>;
			var player="<?php echo $_GET['player']?>";
			ajax.initGameAjax('start', gameId);
	</script>
</head>
<body class="h-screen font-sans w-full" onload="connect();">
<div class="gradBg w-full">
	<svg xmlns="https://www.w3.org/2000/svg" version="1.1"  width="900px" height="700px">
		<!-- Make the background -> 800x600 -->
		<rect x="0px" y="0px" width="100%" height="100%" id="background"></rect>
		<text x="20px" y="20px" id="youPlayer">
			You are:
		</text>
		<text x="270px" y="20px" id="nyt" fill="red" display="none">
			NOT YOUR TURN!
		</text>
		<text x="270px" y="20px" id="nyp" fill="red" display="none">
			NOT YOUR PIECE!
		</text>
		<text x="520px" y="20px" id="opponentPlayer">
			Opponent is:
		</text>
		<text x="650px" y="150px" id="output">
			cell id
		</text>
		<text x="650px" y="190px" id="output2">
			piece id
		</text>
	</svg>
	


    <!-- Main Section -->
    <div class="flex-grow container mx-auto sm:px-4 pt-6 pb-8">
        <!-- Chat  & online users Row -->
        <div class="flex flex-wrap -mx-4 ">

            <!--Chat Window -->
            <div class="w-full mb-6 px-4 flex flex-col ">
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
                                    <button id="chat_btn" onclick="sendChat(player, gameId)" class="flex bg-blue-500 hover:bg-blue-700 text-white text-center font-bold py-2 px-4 rounded">Send</button>
                                </div>
                                <div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Chat Window END -->

        </div>
        <!-- Row END -->

    </div>
    <!-- Main Section END -->
    </div>
</body>
<?php 
 echo '<script src="/Game/js/chat.js"></script>';
?>
</html>
