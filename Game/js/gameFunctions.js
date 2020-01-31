var game={
	xhtmlns:"http://www.w3.org/1999/xhtml",
	svgns:"http://www.w3.org/2000/svg",
	BOARDX:50,				//starting pos of board
	BOARDY:50,				//look above
	boardArr:new Array(),		//2d array [row][col]
	pieceArr:new Array(),		//2d array [player][piece] (player is either 0 or 1)
	BOARDWIDTH:8,				//how many squares across
	BOARDHEIGHT:8,			//how many squares down
	CELLSIZE:75,

	init:function(){
		//create a parent to stick board in...
		var gEle=document.createElementNS(game.svgns,'g');
		gEle.setAttributeNS(null,'transform','translate('+game.BOARDX+','+game.BOARDY+')');
		gEle.setAttributeNS(null,'id','gId_'+gameId);
		//stick g on board
		document.getElementsByTagName('svg')[0].insertBefore(gEle,document.getElementsByTagName('svg')[0].childNodes[5]);
		//create the board...
		//var x = new Cell(document.getElementById('someIDsetByTheServer'),'cell_00',CELLSIZE,0,0);
		for(i=0;i<game.BOARDWIDTH;i++){
			game.boardArr[i]=new Array();
			for(j=0;j<game.BOARDHEIGHT;j++){
				game.boardArr[i][j]=new Cell(document.getElementById('gId_'+gameId),'cell_'+j+i,game.CELLSIZE,j,i);
			}
		}
		////////////////////////////write new code here///////////////////////
		//new Piece(player,cellRow,cellCol,type,num)
		//create red
		game.pieceArr[0]=new Array();
		var idCount=0;
		for(i=0;i<8;i++){
			for(j=0;j<3;j++){
				if((i+j)%2==0){
					game.pieceArr[0][idCount]=new Piece('game_'+gameId,0,i,j,'Checker',idCount);
					idCount++;
				}
			}
		}	
		//create green
		game.pieceArr[1]=new Array();
		idCount=0
		for(i=0;i<8;i++){
			for(j=5;j<8;j++){
				if((i+j)%2==0){
					game.pieceArr[1][idCount]=new Piece('game_'+gameId,1,i,j,'Checker',idCount);
					idCount++;
				}
			}
		}

		////////////////////////////end write new code here///////////////////////
		//put the drop code on the document...
		document.getElementsByTagName('svg')[0].addEventListener('mouseup',drag.releaseMove,false);
		//put the go() method on the svg doc.
		document.getElementsByTagName('svg')[0].addEventListener('mousemove',drag.go,false);
		//put the player in the text
		document.getElementById('youPlayer').firstChild.data+=player;
		document.getElementById('opponentPlayer').firstChild.data+=player2;
		
		//set the colors of whose turn it is
		if(turn==playerId){
			document.getElementById('youPlayer').setAttributeNS(null,'fill',"orange");
			document.getElementById('opponentPlayer').setAttributeNS(null,'fill',"black");
		}else{
			document.getElementById('youPlayer').setAttributeNS(null,'fill',"black");
			document.getElementById('opponentPlayer').setAttributeNS(null,'fill',"orange");
		}
	
		ajax.checkTurnAjax('checkTurn',gameId);
	}
}
			
///////////////////////Dragging code/////////////////////////
var drag={
	//the problem of dragging....
	myX:'',						//hold my last pos.
	myY:'',					//hold my last pos.
	mover:'',					//hold the id of the thing I'm moving
	////setMove/////
	//	set the id of the thing I'm moving...
	////////////////
	setMove:function(which){		
		drag.mover = which;
		//get the last position of the thing... (NOW through the transform=translate(x,y))
		xy=util.getTransform(which);

		drag.myX=xy[0];
		drag.myY=xy[1];
		//get the object then re-append it to the document so it is on top!
		util.getPiece(which).putOnTop(which);
	},
				
	////releaseMove/////
	//	clear the id of the thing I'm moving...
	////////////////
	releaseMove:function(evt){
		if(drag.mover != ''){
			//is it YOUR turn?
			if(turn == playerId){
				var hit=drag.checkHit(evt.layerX,evt.layerY,drag.mover);
			}else{
				var hit=false;
				util.nytwarning();
			}
			if(hit==true){
				//I'm on the square...
				//send the move to the server!!!
			}else{
				//move back
				util.setTransform(drag.mover,drag.myX,drag.myY)
			}
			drag.mover = '';	
		}
	},
				
	////go/////
	//	move the thing I'm moving...
	////////////////
	go:function(evt){
		if(drag.mover != ''){
			util.setTransform(drag.mover,evt.layerX,evt.layerY);
		}
	},
			
	////checkHit/////
	//	did I land on anything important...
	////////////////
	checkHit:function(x,y,id){
		//lets change the x and y coords (mouse) to match the transform
		x=x-game.BOARDX;
		y=y-game.BOARDY;	
		//go through ALL of the board
		for(i=0;i<game.BOARDWIDTH;i++){
			for(j=0;j<game.BOARDHEIGHT;j++){
				var drop = game.boardArr[i][j].myBBox;
				//document.getElementById('output2').firstChild.nodeValue+=x +":"+drop.x+"|";
				if(x>drop.x && x<(drop.x+drop.width) && y>drop.y && y<(drop.y+drop.height) && game.boardArr[i][j].droppable && game.boardArr[i][j].occupied == ''){
					//NEED - check is it a legal move???
					//if it is - then
					//put me to the center....
					util.setTransform(id,game.boardArr[i][j].getCenterX(),game.boardArr[i][j].getCenterY());
					//fill the new cell
					//alert(parseInt(which.substring((which.search(/\|/)+1),which.length)));
					util.getPiece(id).changeCell(game.boardArr[i][j].id,i,j);
					//change other's board
					ajax.changeBoardAjax(id,i,j,'changeBoard',gameId);
					//change who's turn it is
					util.changeTurn();
					return true;
				}
			}	
		}
		return false;
	}
}