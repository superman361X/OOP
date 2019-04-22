

CREATE TABLE `t_user2` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `age` int(11) NOT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7000000 DEFAULT CHARSET=utf8 COLLATE=utf8_bin


DROP TABLE t_user;


CREATE TABLE `t_user` (
  `id` int(11) UNSIGNED NOT NULL  AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `age` int(11) NOT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



alter table t_user partition by RANGE(id) (
    PARTITION p0 VALUES LESS THAN (1000000),
    PARTITION p1 VALUES LESS THAN (2000000),
    PARTITION p2 VALUES LESS THAN (3000000),
    PARTITION p3 VALUES LESS THAN (4000000),
    PARTITION p4 VALUES LESS THAN MAXVALUE 
);

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
        INSERT INTO t_user2(`name`,age,create_time,update_time) VALUES(CONCAT(pre_name,'@qq.com'),(ageVal+1)%30,NOW(),NOW());
SET pre_name=pre_name+100;
SET i=i+1;
END WHILE;
END $$
delimiter ;
call proc_batch_insert2();


show variables like '%datadir%';

SELECT COUNT(*) FROM t_user;

