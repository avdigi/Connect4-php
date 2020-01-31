<?php
	//let's imagine that we are getting p1 and p2 player names from load of doc in session
	$p0='Dan';
	$p1='Fred';
	$gameId=59;
	$turn=0;
	$playerId = 0;  //I'm Dan and my player id - I have to have this different for Fred (1)
	$rows = 8;
	$cols = 8;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>drag php SVG Demo</title>
	<style type="text/css">
		#background { fill: #aaa; stroke: black; stroke-width: 2px; }
		.player0   {fill: #990000; stroke: white; stroke-width: 1px; cursor:pointer; }
		.player1 {fill: green; stroke: white; stroke-width: 1px; cursor:pointer; }
		.htmlBlock {position:absolute;top:200px;left:300px;width:200px;height:100px;background:#ffc;padding:10px;}
		body{padding:0px;margin:0px;}
		.cell_white { fill:white;stroke:red;stroke-width:2px; }
		.cell_black { fill:black;stroke:red;stroke-width:2px; }
		text{pointer-events:none;user-select:none;}
	</style>
	<script src="js/Cell.js" type="text/javascript"></script>
	<!-- ******************* NEW ******************* -->
	<script src="js/Piece.js" type="text/javascript"></script>
	<script src="js/gameFunctions.js" type="text/javascript"></script>
	<script type="text/javascript">
			//get the name of the player...
			var player0="<?php echo $p0; ?>";
			var player1 = "<?php echo $p1; ?>";
			var gameId = <?php echo $gameId; ?>;
			var playerId = <?php echo $playerId; ?>;
			var turn = <?php echo $turn; ?>;
			var ROWS = <?php echo $rows;?>;
			var COLS = <?php echo $cols;?>;
	</script>
</head>
<body onload="init()">
<div style="position:absolute;left:40px;top:40px;">
<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="900px" height="700px">
	<!-- Make the background -->
	<rect x="0px" y="0px" width="100%" height="100%" id="background"></rect>
	<text x="20px" y="20px" id="youPlayer" fill="orange">
		You are red:
	</text>
	<text x="270px" y="20px" id="nyt" fill="red" display="none">
		NOT YOUR TURN!
	</text>
	<text x="270px" y="20px" id="nyp" fill="red" display="none">
		NOT YOUR PIECE!
	</text>
	<text x="520px" y="20px" id="opponentPlayer">
		Opponent is green:
	</text>
	<text x="650px" y="150px" id="output">
		cell id
	</text>
	<text x="650px" y="190px" id="output2">
		piece id
	</text>

</svg>
</div>
</body>
</html>