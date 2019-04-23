create table log_2001  
(  
  id int not null auto_increment,
  dt  datetime not null,  
  info varchar(100) not null,  
  primary key(id),
  index (dt)  
) ENGINE = MyISAM;  
create table log_2002 like log_2001;
ALTER TABLE log_2002 ENGINE=MyISAM;

create table log_merge  
(  
  id int not null auto_increment,
  dt  datetime not null,  
  info varchar(100) not null,  
  primary key(id),
  index (dt)  
) ENGINE = MERGE UNION = (log_2001, log_2002)  
INSERT_METHOD = FIRST;


repair table log_merge



create table log_2003 like log_2001;
alter table log_merge  
UNION = (log_2001, log_2002,log_2003);  