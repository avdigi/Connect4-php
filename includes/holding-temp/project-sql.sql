CREATE TABLE `people` (
  `PersonID` MEDIUMINT NOT NULL AUTO_INCREMENT,
  `Username` varchar(20) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Password` char(64) NOT NULL,
  `OnlineStatus` smallint DEFAULT 0,
  `Wins` MEDIUMINT DEFAULT 0,
  `Losses` MEDIUMINT DEFAULT 0,
  `Ties` MEDIUMINT DEFAULT 0,
  PRIMARY KEY (`PersonID`)
);

///create new user with default values
INSERT INTO people (username, email, password) VALUES ("defaultUser", "default@email.com", "password");

//check if login and pass matches and then logins them in.
SELECT * from people where email = :email and password= :hashedpw