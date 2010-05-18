-- table markers

CREATE TABLE `markers` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
--  `picture_id` INT NOT NULL,
  `name` VARCHAR( 60 ),
  `address` VARCHAR( 120 ),
  `lat` DOUBLE NOT NULL ,
  `lng` DOUBLE NOT NULL ,
  `type` VARCHAR( 30 )
) ENGINE = MYISAM ;

-- ex.
-- Pan Africa Market,"1521 1st Ave, Seattle, WA",47.608941,-122.340145,restaurant

INSERT INTO `markers` (`name`, `address`, `lat`, `lng`, `type`) VALUES ('渋谷あたり', '渋谷神宮町', '35.668016737448255', '139.70558166503906', 'restaurant');
INSERT INTO `markers` (`name`, `address`, `lat`, `lng`, `type`) VALUES ('初台あたり', '新宿区の中', '35.678893819490135', '139.6520233154297', 'bar');
INSERT INTO `markers` (`name`, `address`, `lat`, `lng`, `type`) VALUES ('The Melting Pot', '14 Mercer St, Seattle, WA', '35.67554718289957', '139.77252960205078', 'restaurant');
INSERT INTO `markers` (`name`, `address`, `lat`, `lng`, `type`) VALUES ('東京ヘリポート', '1225 1st Ave, Seattle, WA', '35.631191000905694', '139.83707427978516', 'restaurant');
INSERT INTO `markers` (`name`, `address`, `lat`, `lng`, `type`) VALUES ('江東病院', '2230 1st Ave, Seattle, WA', '35.695624897096735', '139.84943389892578', 'bar');
INSERT INTO `markers` (`name`, `address`, `lat`, `lng`, `type`) VALUES ('Crab Pot', '1301 Alaskan Way, Seattle, WA', '35.62588892919014', '139.77767944335938', 'restaurant');
INSERT INTO `markers` (`name`, `address`, `lat`, `lng`, `type`) VALUES ('Mama\'s Mexican Kitchen', '2234 2nd Ave, Seattle, WA', '47.613975', '-122.345467', 'bar');
INSERT INTO `markers` (`name`, `address`, `lat`, `lng`, `type`) VALUES ('Wingdome', '1416 E Olive Way, Seattle, WA', '47.617215', '-122.326584', 'bar');
INSERT INTO `markers` (`name`, `address`, `lat`, `lng`, `type`) VALUES ('Piroshky Piroshky', '1908 Pike pl, Seattle, WA', '47.610127', '-122.342838', 'restaurant');
