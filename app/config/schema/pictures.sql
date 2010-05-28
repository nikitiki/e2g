-- table markers

CREATE TABLE `pictures` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `docos_id`  VARCHAR( 20 ) BINARY  NOT NULL,
  `twipic_id` VARCHAR( 20 ) BINARY,
  `text` VARCHAR( 100 ),
  `url` VARCHAR( 40 ),
  `width` INT,
  `height` INT,
  `size` INT,
  `timestamp` TIMESTAMP,
  `user_id` INT,
  `screen_name` VARCHAR( 30 ) ,
  `type` VARCHAR( 30 )
) ENGINE = MYISAM ;

