//////////////ajax //////////////////
// use - ajax.ajaxCall(), ajax.changeServerTurnAjax()...
var ajax={
	////ajax util/////
	//d is data sent, looks like {name:value,name2:val2}
	////////////////
	ajaxCall:function(GetPost,d){
		return $.ajax({
			type: GetPost,
			async: true,
			cache:false,
			url: "mid.php",
			data: d,  
			dataType: "json"
		});
	},
	
	////initGameAjax/////
	//d is data sent, looks like {name:value,name2:val2}
	//this is my starter call
	//goes out and gets all pertinant information about the game (FOR ME)
	////////////////
	initGameAjax:function(whatMethod,val){
		//data is gameId
		ajax.ajaxCall("POST",{method:whatMethod,a:"game",data:val}).done(function(jsonObj){
			//compare the session name to the player name to find out my playerId;
			turn = jsonObj[0].whoseTurn;
			if(player == jsonObj[0].player1_name){
				player2 = jsonObj[0].player0_name;
				playerId = 1;
			}else{
				player2 = jsonObj[0].player1_name;
				playerId = 0;
			}
			//document.getElementById('output2').firstChild.data='playerId '+playerId+ ' turn '+turn;
			//start building the game (board and piece)
			game.init();
			console.log('init done');
		});
	},
	
	////changeServerTurnAjax/////
	//change the turn on the server
	//no callback
	////////////////
	changeServerTurnAjax:function(whatMethod,val){
		ajax.ajaxCall("POST",{method:whatMethod,a:"game",data:val});
		//change the color of the names to be the other guys turn
		document.getElementById('youPlayer').setAttributeNS(null,'fill',"black");
		document.getElementById('opponentPlayer').setAttributeNS(null,'fill',"orange");
	},
	
	////changeBoardAjax/////
	//change the board on the server
	//no callback
	////////////////
	changeBoardAjax:function(pieceId,boardI,boardJ,whatMethod,val){
		//data: gameId~pieceId~boardI~boardJ~playerId
		ajax.ajaxCall("POST",{method:whatMethod,a:"game",data:val+"~"+pieceId+"~"+boardI+"~"+boardJ+"~"+playerId});
	},
	
	////checkTurnAjax/////
	//check to see whose turn it is
	////////////////
	checkTurnAjax:function(whatMethod,val){
		if(turn!=playerId){
			ajax.ajaxCall("GET",{method:whatMethod,a:"game",data:val}).done(function(jsonObj){
				console.log('check turn');
				if(jsonObj[0].whoseTurn == playerId){
					//switch turns
					turn=jsonObj[0].whoseTurn;
					//get the data from the last guys move
					ajax.getMoveAjax('getMove',gameId);
				}
			});
		}
		setTimeout(function(){ajax.checkTurnAjax('checkTurn',gameId)},3000);
	},
	
	////getMoveAjax/////
	//get the last move
	//-called after I find out it is my turn
	////////////////
	getMoveAjax:function(whatMethod,val){
		ajax.ajaxCall("GET",{method:whatMethod,a:"game",data:val}).done(function(jsonObj){
			//change the text output on the side for whose turn it is
	
			//change the color of the names for whose turn it is:
			document.getElementById('youPlayer').setAttributeNS(null,'fill',"orange");
			document.getElementById('opponentPlayer').setAttributeNS(null,'fill',"black");
	
			//make the other guys piece move to the location
			//first, clear the other guy's cell
			var toMove=util.getPiece(jsonObj[0]['player'+Math.abs(playerId-1)+'_pieceID']);
			toMove.current_cell.notOccupied();
			//now, actually move it! 
			var x=game.boardArr[jsonObj[0]['player'+Math.abs(playerId-1)+'_boardI']][jsonObj[0]['player'+Math.abs(playerId-1)+'_boardJ']].getCenterX();
			var y=game.boardArr[jsonObj[0]['player'+Math.abs(playerId-1)+'_boardI']][jsonObj[0]['player'+Math.abs(playerId-1)+'_boardJ']].getCenterY();
			util.setTransform(jsonObj[0]['player'+Math.abs(playerId-1)+'_pieceID'],x,y);
		
			//now, for me, make the new cell occupied!
			util.getPiece(jsonObj[0]['player'+Math.abs(playerId-1)+'_pieceID']).changeCell('cell_'+jsonObj[0]['player'+Math.abs(playerId-1)+'_boardI']+jsonObj[0]['player'+Math.abs(playerId-1)+'_boardJ'],jsonObj[0]['player'+Math.abs(playerId-1)+'_boardI'],jsonObj[0]['player'+Math.abs(playerId-1)+'_boardJ']);
		});
	}
}