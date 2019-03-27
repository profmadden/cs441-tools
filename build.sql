use pmadden_441;

CREATE TABLE IF NOT EXISTS `users` (
       `id` int(11) NOT NULL auto_increment,
       `fn` varchar(64),
       `ln` varchar(64),
       `email` varchar(64) NOT NULL,
       `passcode` int(11),
       `sessionkey` int(11),
       PRIMARY KEY (`id`)

);

CREATE TABLE IF NOT EXISTS `submissions` (
       `entry` int(11) NOT NULL auto_increment,
       `title` varchar(64),
       `id` int(11),
       `project` int(11),
       `classnumber` int(11),
       `collab1` varchar(64),
       `collabid1` int(11),
       `collab2` varchar(64),
       `collabid2` int(11),
       `git` varchar(256),
       `data1` mediumblob,
       `data2` mediumblob,
       `data3` mediumblob,
       `markdown` text,
       `gitlog` text,
       `timestamp` timestamp,
       PRIMARY KEY (`entry`)
);

CREATE TABLE IF NOT EXISTS `comments` (
       `entry` int(11) NOT NULL,
       `text` text,
       PRIMARY KEY (`entry`)
);



CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log` text,
  `timestamp` timestamp,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `review` (
       `rid` int(11) NOT NULL auto_increment,
       `entry` int(11),
       `authorid` int(11),
       `reviewid` int(11),
       `project` int(11),
       `score` int(11),
       PRIMARY KEY (`rid`)
);

CREATE TABLE IF NOT EXISTS `bonus` (
       `groupnum` int(11),
       `entry` int(11),
       `id` int(11)
);

CREATE TABLE IF NOT EXISTS `bonuspoints` (
       `reviewid` int(11),
       `entry` int(11),
       `score` int(11)
);


CREATE TABLE IF NOT EXISTS `ranking` (
       `entry` int(11),
       `authorid` int(11),
       `authorname` text,
       `title` text,
       `project` int(11),
       `classnumber` int(11),
       `points` int(11)
);

CREATE TABLE IF NOT EXISTS `points` (
       `id` int(11),
       `entry` int(11),
       `project` int(11),
       `readme` int(10),
       `screenshots` int(11),
       `gitlog` int(11),
       `commits` int(11),
       `voted` int(11),
       `classpoints` int(11),
       `presentation` int(11),
       `total` int(11)
);



