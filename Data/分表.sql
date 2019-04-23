CREATE TABLE t_member (
	id BIGINT auto_increment PRIMARY KEY,
	NAME VARCHAR (20),
	sex TINYINT NOT NULL DEFAULT '0'
) ENGINE = MyISAM DEFAULT charset = utf8 auto_increment = 1;


insert into t_member(id,name,sex) values (1,'jacson','0');
insert into t_member(name,sex) select name,sex from t_member;

DROP TABLE IF EXISTS t_member1;

CREATE TABLE t_member1 (
	id BIGINT PRIMARY KEY auto_increment,
	NAME VARCHAR (20),
	sex TINYINT NOT NULL DEFAULT '0'
) ENGINE = MyISAM DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1;

DROP TABLE
IF EXISTS t_member2;

CREATE TABLE t_member2 (
	id BIGINT PRIMARY KEY auto_increment,
	NAME VARCHAR (20),
	sex TINYINT NOT NULL DEFAULT '0'
) ENGINE = MyISAM DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1;

DROP TABLE IF EXISTS t_member_all;

CREATE TABLE t_member_all (
	id BIGINT PRIMARY KEY auto_increment,
	NAME VARCHAR (20),
	sex TINYINT NOT NULL DEFAULT '0'
) ENGINE = MyISAM
UNION
	= (t_member1, t_member2) INSERT_METHOD = LAST CHARSET = utf8 AUTO_INCREMENT = 1;


insert into t_member1(id,name,sex) select id,name,sex from t_member where id%2=0;

insert into t_member2(id,name,sex) select id,name,sex from t_member where id%2=1;