
DROP TABLE IF EXISTS t_user;
DROP TABLE  IF EXISTS t_user2;
CREATE TABLE `t_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `age` int(11) NOT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `t_user2` (
  `id` int(11) UNSIGNED NOT NULL  AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `age` int(11) NOT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


alter table t_user partition by RANGE(id) (
    PARTITION p0 VALUES LESS THAN (200000),
    PARTITION p1 VALUES LESS THAN (400000),
    PARTITION p2 VALUES LESS THAN (600000),
    PARTITION p3 VALUES LESS THAN (800000),
    PARTITION p4 VALUES LESS THAN MAXVALUE 
);

delimiter $$
DROP PROCEDURE IF EXISTS proc_batch_insert;
CREATE PROCEDURE proc_batch_insert()
BEGIN
DECLARE pre_name BIGINT;
DECLARE ageVal INT;
DECLARE i INT;
SET pre_name=187635267;
SET ageVal=100;
SET i=1;
WHILE i <= 1000000 DO
        INSERT INTO t_user(`name`,age,create_time,update_time) VALUES(CONCAT(i,'@qq.com'),FLOOR(1 + (RAND() * 101)),NOW(),NOW());
SET pre_name=pre_name+100;
SET i=i+1;
END WHILE;
END $$
delimiter ;

delimiter $$
DROP PROCEDURE IF EXISTS proc_batch_insert2;
CREATE PROCEDURE proc_batch_insert2()
BEGIN
DECLARE pre_name BIGINT;
DECLARE ageVal INT;
DECLARE i INT;
SET pre_name=187635267;
SET ageVal=100;
SET i=1;
WHILE i <= 1000000 DO
        INSERT INTO t_user2(`name`,age,create_time,update_time) VALUES(CONCAT(i,'@qq.com'),FLOOR(1 + (RAND() * 101)),NOW(),NOW());
SET pre_name=pre_name+100;
SET i=i+1;
END WHILE;
END $$
delimiter ;

SELECT count(*) from t_user;
SELECT count(*) from t_user2;


select  * from t_user2 partition (p1);

SELECT * FROM t_user WHERE age > 30 AND age < 90;

SELECT * FROM t_user2 WHERE age > 30 AND age < 90;

