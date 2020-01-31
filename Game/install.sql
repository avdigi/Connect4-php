-- install:
-- 1) blow in SQL data below
-- 2) svcLayer>game>gameSvc.php line 11, make sure the path to your dbInfo is correct!
-- 3) Need one line of code in checkers.php to start
-- 4) in gameFunctions.js - line 71 need to find out who's turn it is (remember, same code is run by both Fred and Dan)
-- 5) in gameFunctions.js - line 149 need to record the move for the other player

--solutions:
-- 3)  ajax.initGameAjax('start', gameId);
-- 4)  ajax.checkTurnAjax('checkTurn',gameId);
-- 5)  ajax.changeBoardAjax(id,i,j,'changeBoard',gameId);



-- Table structure for table `checkers_games`
-- 

CREATE TABLE `checkers_games` (
  `game_id` int(10) NOT NULL auto_increment,
  `whoseTurn` int(1) NOT NULL default '0',
  `player0_name` varchar(255) NOT NULL default '',
  `player0_pieceID` text,
  `player0_boardI` varchar(255) default NULL,
  `player0_boardJ` varchar(255) default NULL,
  `player1_name` varchar(255) NOT NULL default '',
  `player1_pieceID` text,
  `player1_boardI` varchar(255) default NULL,
  `player1_boardJ` varchar(255) default NULL,
  `last_updated` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`game_id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

-- 
-- Dumping data for table `checkers_games`
-- 

INSERT INTO `checkers_games` VALUES (38, 0, 'Dan', NULL, NULL, NULL, 'Fred', NULL, NULL, NULL, '0000-00-00 00:00:00');