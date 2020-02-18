create table user_information(
  id int unsigned primary key auto_increment,
  name varchar(25) not null,
  gender enum('男','女','保密') default '保密',
  tel varchar(15) not null,
  email varchar(25)
  )charset utf8;