var xhtmlns = "http://www.w3.org/1999/xhtml"; 
var svgns = "http://www.w3.org/2000/svg";
var BOARDX = 50;				//starting pos of board
var BOARDY = 50;				//look above
var boardArr = new Array();		//2d array [row][col]
var pieceArr = new Array();		//2d array [player][piece] (player is either 0 or 1)
var CELLSIZE=75;
//the problem of dragging....
var myX;						//hold my last pos.
var myY;						//hold my last pos.
var mover='';					//hold the id of the thing I'm moving

function init(){
	//create a parent to stick board in...
	var gEle=document.createElementNS(svgns,'g');
	gEle.setAttributeNS(null,'transform','translate('+BOARDX+','+BOARDY+')');
	gEle.setAttributeNS(null,'id','gId_'+gameId);
	//stick g on board
	document.getElementsByTagName('svg')[0].insertBefore(gEle,document.getElementsByTagName('svg')[0].childNodes[5]);
	//create the board...
	//var x = new Cell(document.getElementById('someIDsetByTheServer'),'cell_00',CELLSIZE,0,0);
	for(i=0;i<ROWS;i++){
		boardArr[i]=new Array();
		for(j=0;j<COLS;j++){
			boardArr[i][j]=new Cell(document.getElementById('gId_'+gameId),'cell_'+j+i,CELLSIZE,j,i);
		}
	}
	////////////////////////////write new code here///////////////////////
	//new Piece(player,cellRow,cellCol,type,num)
	//create red
	pieceArr[0]=new Array();
	var idCount=0;
	for(i=0;i<ROWS;i++){
		for(j=0;j<3;j++){
			if((i+j)%2==0){
				pieceArr[0][idCount]=new Piece(0,i,j,'Checker',idCount);
				idCount++;
			}
		}
	}	
	//create green
	pieceArr[1]=new Array();
	idCount=0
	for(i=0;i<ROWS;i++){
		for(j=5;j<ROWS;j++){
			if((i+j)%2==0){
				pieceArr[1][idCount]=new Piece(1,i,j,'Checker',idCount);
				idCount++;
			}
		}
	}

	////////////////////////////end write new code here///////////////////////
	//put the drop code on the document...
	document.getElementsByTagName('svg')[0].addEventListener('mouseup',releaseMove,false);
	//put the go() method on the svg doc.
	document.getElementsByTagName('svg')[0].addEventListener('mousemove',go,false);
	//put the player in the text
	document.getElementById('youPlayer').firstChild.data+=player0;
	document.getElementById('opponentPlayer').firstChild.data+=player1;
}
			
///////////////////////Dragging code/////////////////////////


////setMove/////
//	set the id of the thing I'm moving...
////////////////
function setMove(which){		
	mover = which;
	//get the last position of the thing... (NOW through the transform=translate(x,y))
	xy=getTransform(which);

	myX=xy[0];
	myY=xy[1];
	//get the object then re-append it to the document so it is on top!
	getPiece(which).putOnTop(which);
}
			
			
////releaseMove/////
//	clear the id of the thing I'm moving...
////////////////
function releaseMove(evt){
	if(mover != ''){
		//is it YOUR turn?
		if(turn == playerId){
			var hit=checkHit(evt.offsetX,evt.offsetY,mover);
		}else{
			var hit=false;
			nytwarning();
		}
		if(hit==true){
			//I'm on the square...
			//send the move to the server!!!
		}else{
			//move back
			setTransform(mover,myX,myY)
		}
		mover = '';	
	}
}
			
			
////go/////
//	move the thing I'm moving...
////////////////
function go(evt){
		
	if(mover != ''){
		setTransform(mover,evt.offsetX,evt.offsetY);
	}
}
			
////checkHit/////
//	did I land on anything important...
////////////////
function checkHit(x,y,id){
	//lets change the x and y coords (mouse) to match the transform
	x=x-BOARDX;
	y=y-BOARDY;	
	console.log(x);
	//go through ALL of the board
	for(i=0;i<ROWS;i++){
		for(j=0;j<COLS;j++){
			var drop = boardArr[i][j].myBBox;
			//document.getElementById('output2').firstChild.nodeValue+=x +":"+drop.x+"|";
			if(x>drop.x && x<(drop.x+drop.width) && y>drop.y && y<(drop.y+drop.height) && boardArr[i][j].droppable && boardArr[i][j].occupied == ''){
				
				//NEED - check is it a legal move???
				//if it is - then
				//put me to the center....
				setTransform(id,boardArr[i][j].getCenterX(),boardArr[i][j].getCenterY());
				//fill the new cell
				//alert(parseInt(which.substring((which.search(/\|/)+1),which.length)));
				getPiece(id).changeCell(boardArr[i][j].id,i,j);
				//change who's turn it is
				changeTurn();
				return true;
			}
		}	
	}
	return false;
}

///////////////////////////////Utilities////////////////////////////////////////


////get Piece/////
//	get the piece (object) from the id and return it...
//	id looks like "piece_0|3"
////////////////
function getPiece(id){
	return pieceArr[parseInt(id.substr((id.search(/\_/)+1),1))][parseInt(id.substring((id.search(/\|/)+1),id.length))];
}
			
////get Transform/////
//	look at the id of the piece sent in and work on it's transform
////////////////
function getTransform(id){
	var hold=document.getElementById(id).getAttributeNS(null,'transform');
	var retVal=new Array();
	retVal[0]=hold.substring((hold.search(/\(/) + 1),hold.search(/,/));			//x value
	retVal[1]=hold.substring((hold.search(/,/) + 1),hold.search(/\)/));;		//y value
	return retVal;
}
			
////set Transform/////
//	look at the id, x, y of the piece sent in and set it's translate
////////////////
function setTransform(id,x,y){
	document.getElementById(id).setAttributeNS(null,'transform','translate('+x+','+y+')');
}

////change turn////
//	change who's turn it is
//////////////////
function changeTurn(){
	//locally
	if(turn == 0){
		turn=1;
		document.getElementById('youPlayer').setAttributeNS(null,'fill','black');
		document.getElementById('opponentPlayer').setAttributeNS(null,'fill','orange');
	}else{
		turn=0;
		document.getElementById('youPlayer').setAttributeNS(null,'fill','orange');
		document.getElementById('opponentPlayer').setAttributeNS(null,'fill','black');
	}
	//how about for the server (and other player)?
	//send JSON message to server, have both clients monitor server to know who's turn it is...
}

/////////////////////////////////Messages to user/////////////////////////////////


////nytwarning (not your turn)/////
//	tell player it isn't his turn!
////////////////
function nytwarning(){
	if(document.getElementById('nyt').getAttributeNS(null,'display') == 'none'){
		document.getElementById('nyt').setAttributeNS(null,'display','inline');
		setTimeout('nytwarning()',2000);
	}else{
		document.getElementById('nyt').setAttributeNS(null,'display','none');
	}
}

////nypwarning (not your piece)/////
//	tell player it isn't his piece!
////////////////
function nypwarning(){
	if(document.getElementById('nyp').getAttributeNS(null,'display') == 'none'){
		document.getElementById('nyp').setAttributeNS(null,'display','inline');
		setTimeout('nypwarning()',2000);
	}else{
		document.getElementById('nyp').setAttributeNS(null,'display','none');
	}
}