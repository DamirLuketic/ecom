drop database if exists ecom;
create database ecom charset utf8;
use ecom;

create table roles(
role_id int not null primary key auto_increment,
role_name varchar(50) not null
);

insert into roles (role_name) values
('admin'),('customer');

create table users(
user_id int not null primary key auto_increment,
email varchar(100) not null,
password char(32) not null,
firstname varchar(100) not null,
lastname varchar(100) not null,
address varchar(100) not null,
postoffice varchar(100) not null,
city varchar(100) not null,
state varchar(100) default null,
country varchar(100) not null, 
role int not null default 2,
date_created datetime not null,
date_accessed datetime,
user_accessed int,
active int not null default 1
);

create unique index ui1 on users(email);

alter table users add foreign key (role) references roles(role_id);

insert into users(email,password,firstname,lastname,address,postoffice,city,state,country,date_created,role) values
('luketic.damir@gmail.com',md5('pass1'),'Damir','Luketić','Stonska 4','31000','Osijek',null, 'Croatia','2015-12-12 14:35:28',1),
('luketic.darko@gmail.com',md5('pass2'),'Darko','Luketić','V.P. Gore 4','31000','Osijek',null, 'customer','2015-12-26 4:35:45',2),
('zrasic@gmail.com',md5('pass3'),'Zdravko','Rašić','Radićeva 15','31000','Osijek',null, 'Croatia','2016-02-01 06:31:34',2);

create table categories(
category_id int not null primary key auto_increment,
name varchar(100) not null,
details text,
parent int,
category_order int not null,
date_created timestamp not null,
user_created int not null,
date_accessed timestamp,
user_accessed int,
deleted boolean not null default 0
);

alter table categories add foreign key (user_created) references users(user_id);
alter table categories add foreign key (user_accessed) references users(user_id);
alter table categories add foreign key (parent) references categories(category_id);

insert into categories values
(null,'Speakers','',null,1,'2012-11-24 14:55:28',1,null,null,false),
(null,'Amplifiers','',null,2,'2014-09-25 17:23:35',1,null,null,false),
(null,'CD-players','',null,3,'2013-07-19 13:36:44',1,null,null,false),
(null,'Audio epilog','',1,1,'2012-11-24 14:55:28',1,null,null,false),
(null,'ATC','',1,2,'2014-09-25 17:23:35',1,null,null,false),
(null,'Dali','',1,3,'2013-07-19 13:36:44',1,null,null,false),
(null,'Rega','',1,4,'2013-07-19 13:36:44',1,null,null,false),
(null,'Cambridge','',2,1,'2014-09-25 17:23:35',1,null,null,false),
(null,'Onkyo','',2,2,'2013-07-19 13:36:44',1,null,null,false),
(null,'Rega','',2,3,'2013-07-19 13:36:44',1,null,null,false),
(null,'Audiolab','',3,1,'2013-07-19 13:36:44',1,null,null,false),
(null,'Cambridge','',3,2,'2014-09-25 17:23:35',1,null,null,false),
(null,'Onkyo','',3,3,'2013-07-19 13:36:44',1,null,null,false),
(null,'Rega','',3,4,'2013-07-19 13:36:44',1,null,null,false),
(null,'Pimienta','',4,1,'2013-07-19 13:36:44',1,null,null,false),
(null,'Others','',4,2,'2013-07-19 13:36:44',1,null,null,false);

create table units(
unit_id int not null primary key auto_increment,
name varchar(50) not null
);

insert into units(name) values
('One'),('Pair');

create table products(
product_id int not null primary key auto_increment,
model varchar(50) not null,
quantity_in_stock int not null,
price decimal(18,2) not null,
sku varchar(50),
unit int not null,
details text,
more_information text,
date_created datetime not null,
user_created int not null,
date_accessed datetime,
user_accessed int,
deleted boolean default 0
);

create unique index ui2 on products(sku);

alter table products add foreign key (unit) references units(unit_id);
alter table products add foreign key (user_created) references users(user_id);
alter table products add foreign key (user_accessed) references users(user_id);

insert into products(model,quantity_in_stock,price,sku,unit,details,more_information,date_created,user_created,date_accessed,user_accessed,deleted) values
('Jana', 23, 500, "SP-AU-0001",2,null,null,"2006-04-10 11:29:12",1,null,null,0),
('Pimienta', 25, 800, "SP-AU-0002",2,null,null,"2010-02-15 13:29:51",1,null,null,0),
('Pimienta 2', 26, 860, "SP-AU-0003",2,null,null,"2007-10-16 22:50:10",1,null,null,0),
('Prime', 21, 2000, "SP-AU-0004",2,null,null,"2001-02-17 05:47:50",1,null,null,0),
('Ice', 24, 799.99, "SP-AU-0005",2,null,null,"2002-12-25 23:32:06",1,null,null,0),
('Epicon 8', 26, 587, "SP-AT-0006",2,null,null,"2000-09-07 16:34:05",1,null,null,0),
('Epicon 6', 24, 541, "SP-AT-0007",2,null,null,"2002-04-04 08:46:01",1,null,null,0),
('Rubicon 8', 23, 245, "SP-AT-0008",2,null,null,"2015-05-03 12:46:25",1,null,null,0),
('Rubicon 6', 27, 587, "SP-AT-0009",2,null,null,"2009-10-22 10:09:27",1,null,null,0),
('Opticon 5', 24, 574, "SP-AT-0010",2,null,null,"2011-09-10 16:46:06",1,null,null,0),
('Helicon Stand MKL', 24, 547, "SP-AT-0011",2,null,null,"2001-12-20 24:52:27",1,null,null,0),
('Helicon 800 MK2', 43, 544, "SP-AT-0012",2,null,null,"2011-02-19 18:29:55",1,null,null,0),
('SCM7', 33, 775, "SP-DA-0013",2,null,null,"2014-11-09 05:34:31",1,null,null,0),
('SCM11', 34, 555, "SP-DA-0014",2,null,null,"2013-05-05 18:20:08",1,null,null,0),
('SCM40', 54, 754, "SP-DA-0015",2,null,null,"2009-02-15 24:25:43",1,null,null,0),
('SCM20ASLT', 54, 545, "SP-DA-0016",2,null,null,"2008-08-15 04:12:33",1,null,null,0),
('SCM50ASLT', 77, 785, "SP-DA-0017",2,null,null,"2006-08-20 12:03:33",1,null,null,0),
('SCM50 Anniversary', 13, 457, "SP-DA-0018",2,null,null,"2011-11-26 03:31:27",1,null,null,0),
('ELI 50', 11, 575, "SP-DA-0019",2,null,null,"2015-12-23 15:38:04",1,null,null,0),
('RX1', 34, 547, "SP-RE-0020",2,null,null,"2012-03-27 02:10:35",1,null,null,0),
('RX3', 54, 545, "SP-RE-0021",2,null,null,"2005-02-06 14:50:47",1,null,null,0),
('RX5', 32, 745, "SP-RE-0022",2,null,null,"2009-07-24 03:34:16",1,null,null,0),
('RS10', 11, 478, "SP-RE-0023",2,null,null,"2005-10-24 04:47:45",1,null,null,0),
('EAR', 32, 547, "AM-RE-0024",1,null,null,"2008-11-08 22:21:43",1,null,null,0),
('BRIO-R', 32, 471, "AM-RE-0025",1,null,null,"2006-10-09 07:49:05",1,null,null,0),
('ELEX-R', 54, 417, "AM-RE-0026",1,null,null,"2008-05-14 11:52:24",1,null,null,0),
('ELICIT-R', 24, 471, "AM-RE-0027",1,null,null,"2014-12-13 03:56:09",1,null,null,0),
('OSIRIS-R', 27, 741, "AM-RE-0028",1,null,null,"2000-12-05 04:45:44",1,null,null,0),
('A-9070', 28, 857, "AM-ON-0029",1,null,null,"2008-08-13 19:27:35",1,null,null,0),
('TX-8020', 25, 457, "AM-ON-0030",1,null,null,"2004-11-27 15:55:30",1,null,null,0),
('P-3000R', 23, 784, "AM-ON-0031",1,null,null,"2007-11-20 10:01:54",1,null,null,0),
('P-3000RA', 26, 784, "AM-ON-0032",1,null,null,"2003-12-01 20:47:00",1,null,null,0),
('PA-MC5501', 23, 748, "AM-ON-0033",1,null,null,"2007-03-03 22:46:09",1,null,null,0),
('PHA-1045', 25, 444, "AM-ON-0034",1,null,null,"2005-06-28 06:14:00",1,null,null,0),
('PHA-1045DAB', 23, 578, "AM-ON-0035",1,null,null,"2008-08-02 11:23:51",1,null,null,0),
('PHA-1045DAB-E', 26, 254, "AM-ON-0036",1,null,null,"2007-02-01 00:40:48",1,null,null,0),
('340A', 27, 478, "AM-CA-0037",1,null,null,"2006-09-13 22:01:03",1,null,null,0),
('340A SE', 23, 458, "AM-CA-0038",1,null,null,"2000-03-23 15:01:10",1,null,null,0),
('540A v2', 26, 845, "AM-CA-0039",1,null,null,"2004-06-22 13:19:16",1,null,null,0),
('640A v2', 22, 458, "AM-CA-0040",1,null,null,"2014-08-14 01:41:22",1,null,null,0),
('740A', 26, 478, "AM-CA-0041",1,null,null,"2011-06-24 01:26:33",1,null,null,0),
('840A', 27, 478, "AM-CA-0042",1,null,null,"2008-07-20 23:34:13",1,null,null,0),
('840A', 25, 547, "AM-CA-0043",1,null,null,"2014-09-03 21:02:24",1,null,null,0),
('APOLLO-R', 24, 478, "CD-RE-0044",1,null,null,"2013-10-17 05:04:58",1,null,null,0),
('SATURN-R', 25, 478, "CD-RE-0045",1,null,null,"2008-09-13 16:17:52",1,null,null,0),
('ISIS', 27, 247, "CD-RE-0046",1,null,null,"2003-09-25 11:06:25",1,null,null,0),
('VALVE ISIS', 28, 478, "CD-RE-0047",1,null,null,"2011-06-09 18:50:30",1,null,null,0),
('DAC-R', 32, 578, "CD-RE-0048",1,null,null,"2008-11-19 16:03:50",1,null,null,0),
('340C', 32, 458, "CD-CA-0049",1,null,null,"2002-07-16 21:49:17",1,null,null,0),
('540C v2', 26, 789, "CD-CA-0050",1,null,null,"2004-10-18 10:52:01",1,null,null,0),
('640 v2', 76, 742, "CD-CA-0051",1,null,null,"2015-01-18 08:55:48",1,null,null,0),
('740C v2', 45, 748, "CD-CA-0052",1,null,null,"2003-02-25 18:55:14",1,null,null,0),
('840C v2', 34, 478, "CD-CA-0053",1,null,null,"2013-06-12 24:17:02",1,null,null,0),
('8200A', 22, 415, "CD-AU-0054",1,null,null,"2014-03-05 02:08:16",1,null,null,0),
('8200CD', 21, 748, "CD-AU-0055",1,null,null,"2014-10-09 00:34:33",1,null,null,0),
('8200CDQ', 24, 484, "CD-AU-0056",1,null,null,"2002-10-16 15:54:24",1,null,null,0),
('8200AP', 12, 478, "CD-AU-0057",1,null,null,"2013-07-08 06:55:22",1,null,null,0),
('8200M', 15, 458, "CD-AU-0058",1,null,null,"2006-02-22 19:08:25",1,null,null,0),
('8200MB', 17, 478, "CD-AU-0059",1,null,null,"2012-10-18 23:01:02",1,null,null,0),
('8200P', 18, 485, "CD-AU-0060",1,null,null,"2009-01-26 14:15:35",1,null,null,0),
('C-5VL', 19, 418, "CD-ON-0061",1,null,null,"2006-01-10 22:00:33",1,null,null,0),
('C-7000R', 20, 477, "CD-ON-0062",1,null,null,"2001-10-19 15:08:42",1,null,null,0),
('C-7030', 19, 487, "CD-ON-0063",1,null,null,"2013-05-23 10:31:28",1,null,null,0),
('C-7070', 23, 478, "CD-ON-0064",1,null,null,"2012-03-05 22:13:03",1,null,null,0),
('C-733', 29, 458, "CD-ON-0065",1,null,null,"2012-04-26 05:45:48",1,null,null,0),
('C-55VL', 30, 158, "CD-ON-0066",1,null,null,"2001-07-04 23:23:24",1,null,null,0);

create table categories_products(
category_product_id int not null primary key auto_increment,
product int not null,
category int not null,
price decimal(18,2) not null
);

alter table categories_products add foreign key (product) references products(product_id);
alter table categories_products add foreign key (category) references categories(category_id);

insert into categories_products values

/* in parent category null */

(null,1,1,(select price from products where product_id=1)),
(null,2,1,(select price from products where product_id=2)),
(null,3,1,(select price from products where product_id=3)),
(null,4,1,(select price from products where product_id=4)),
(null,5,1,(select price from products where product_id=5)),
(null,6,1,(select price from products where product_id=6)),
(null,7,1,(select price from products where product_id=7)),
(null,8,1,(select price from products where product_id=8)),
(null,9,1,(select price from products where product_id=9)),
(null,10,1,(select price from products where product_id=10)),
(null,11,1,(select price from products where product_id=11)),
(null,12,1,(select price from products where product_id=12)),
(null,13,1,(select price from products where product_id=13)),
(null,14,1,(select price from products where product_id=14)),
(null,15,1,(select price from products where product_id=15)),
(null,16,1,(select price from products where product_id=16)),
(null,17,1,(select price from products where product_id=17)),
(null,18,1,(select price from products where product_id=18)),
(null,19,1,(select price from products where product_id=19)),
(null,20,1,(select price from products where product_id=20)),
(null,21,1,(select price from products where product_id=21)),
(null,22,1,(select price from products where product_id=22)),
(null,23,1,(select price from products where product_id=23)),
(null,24,2,(select price from products where product_id=24)),
(null,25,2,(select price from products where product_id=25)),
(null,26,2,(select price from products where product_id=26)),
(null,27,2,(select price from products where product_id=27)),
(null,28,2,(select price from products where product_id=28)),
(null,29,2,(select price from products where product_id=29)),
(null,30,2,(select price from products where product_id=30)),
(null,31,2,(select price from products where product_id=31)),
(null,32,2,(select price from products where product_id=32)),
(null,33,2,(select price from products where product_id=33)),
(null,34,2,(select price from products where product_id=34)),
(null,35,2,(select price from products where product_id=35)),
(null,36,2,(select price from products where product_id=36)),
(null,37,2,(select price from products where product_id=37)),
(null,38,2,(select price from products where product_id=38)),
(null,39,2,(select price from products where product_id=39)),
(null,40,2,(select price from products where product_id=40)),
(null,41,2,(select price from products where product_id=41)),
(null,42,2,(select price from products where product_id=42)),
(null,43,2,(select price from products where product_id=43)),
(null,44,3,(select price from products where product_id=44)),
(null,45,3,(select price from products where product_id=45)),
(null,46,3,(select price from products where product_id=46)),
(null,47,3,(select price from products where product_id=47)),
(null,48,3,(select price from products where product_id=48)),
(null,49,3,(select price from products where product_id=49)),
(null,50,3,(select price from products where product_id=50)),
(null,51,3,(select price from products where product_id=51)),
(null,52,3,(select price from products where product_id=52)),
(null,53,3,(select price from products where product_id=53)),
(null,54,3,(select price from products where product_id=54)),
(null,55,3,(select price from products where product_id=55)),
(null,56,3,(select price from products where product_id=56)),
(null,57,3,(select price from products where product_id=57)),
(null,58,3,(select price from products where product_id=58)),
(null,59,3,(select price from products where product_id=59)),
(null,60,3,(select price from products where product_id=60)),
(null,61,3,(select price from products where product_id=61)),
(null,62,3,(select price from products where product_id=62)),
(null,63,3,(select price from products where product_id=63)),
(null,64,3,(select price from products where product_id=64)),
(null,65,3,(select price from products where product_id=65)),
(null,66,3,(select price from products where product_id=66)),

/* in first child category */

(null,1,4,(select price from products where product_id=1)),
(null,2,4,(select price from products where product_id=2)),
(null,3,4,(select price from products where product_id=3)),
(null,4,4,(select price from products where product_id=4)),
(null,5,4,(select price from products where product_id=5)),
(null,6,6,(select price from products where product_id=6)),
(null,7,6,(select price from products where product_id=7)),
(null,8,6,(select price from products where product_id=8)),
(null,9,6,(select price from products where product_id=9)),
(null,10,6,(select price from products where product_id=10)),
(null,11,6,(select price from products where product_id=11)),
(null,12,6,(select price from products where product_id=12)),
(null,13,5,(select price from products where product_id=13)),
(null,14,5,(select price from products where product_id=14)),
(null,15,5,(select price from products where product_id=15)),
(null,16,5,(select price from products where product_id=16)),
(null,17,5,(select price from products where product_id=17)),
(null,18,5,(select price from products where product_id=18)),
(null,19,5,(select price from products where product_id=19)),
(null,20,7,(select price from products where product_id=20)),
(null,21,7,(select price from products where product_id=21)),
(null,22,7,(select price from products where product_id=22)),
(null,23,7,(select price from products where product_id=23)),
(null,24,10,(select price from products where product_id=24)),
(null,25,10,(select price from products where product_id=25)),
(null,26,10,(select price from products where product_id=26)),
(null,27,10,(select price from products where product_id=27)),
(null,28,10,(select price from products where product_id=28)),
(null,29,9,(select price from products where product_id=29)),
(null,30,9,(select price from products where product_id=30)),
(null,31,9,(select price from products where product_id=31)),
(null,32,9,(select price from products where product_id=32)),
(null,33,9,(select price from products where product_id=33)),
(null,34,9,(select price from products where product_id=34)),
(null,35,9,(select price from products where product_id=35)),
(null,36,9,(select price from products where product_id=36)),
(null,37,8,(select price from products where product_id=37)),
(null,38,8,(select price from products where product_id=38)),
(null,39,8,(select price from products where product_id=39)),
(null,40,8,(select price from products where product_id=40)),
(null,41,8,(select price from products where product_id=41)),
(null,42,8,(select price from products where product_id=42)),
(null,43,8,(select price from products where product_id=43)),
(null,44,14,(select price from products where product_id=44)),
(null,45,14,(select price from products where product_id=45)),
(null,46,14,(select price from products where product_id=46)),
(null,47,14,(select price from products where product_id=47)),
(null,48,14,(select price from products where product_id=48)),
(null,49,12,(select price from products where product_id=49)),
(null,50,12,(select price from products where product_id=50)),
(null,51,12,(select price from products where product_id=51)),
(null,52,12,(select price from products where product_id=52)),
(null,53,12,(select price from products where product_id=53)),
(null,54,11,(select price from products where product_id=54)),
(null,55,11,(select price from products where product_id=55)),
(null,56,11,(select price from products where product_id=56)),
(null,57,11,(select price from products where product_id=57)),
(null,58,11,(select price from products where product_id=58)),
(null,59,11,(select price from products where product_id=59)),
(null,60,11,(select price from products where product_id=60)),
(null,61,13,(select price from products where product_id=61)),
(null,62,13,(select price from products where product_id=62)),
(null,63,13,(select price from products where product_id=63)),
(null,64,13,(select price from products where product_id=64)),
(null,65,13,(select price from products where product_id=65)),
(null,66,13,(select price from products where product_id=66)),

/* in sub category */

(null,2,15,(select price from products where product_id=2)),
(null,3,15,(select price from products where product_id=3)),
(null,1,16,(select price from products where product_id=1)),
(null,4,16,(select price from products where product_id=4)),
(null,5,16,(select price from products where product_id=5));


create table images(
image_id int not null primary key auto_increment,
product int not null,
path text not null,
featured boolean not null
);

alter table images add foreign key (product) references products(product_id);

insert into images values
(null,1,'1.jpg',true),
(null,1,'555.jpg',false),
(null,2,'2.jpg',true),
(null,3,'3.jpg',true),
(null,4,'4.jpg',true),
(null,5,'5.jpg',true),
(null,6,'6.jpg',true),
(null,7,'7.jpg',true),
(null,8,'8.jpg',true),
(null,9,'9.jpg',true),
(null,10,'10.jpg',true),
(null,11,'11.jpg',true),
(null,12,'12.jpg',true),
(null,13,'13.jpg',true),
(null,14,'14.jpg',true),
(null,15,'15.jpg',true),
(null,16,'16.jpg',true),
(null,17,'17.jpg',true),
(null,18,'18.jpg',true),
(null,19,'19.jpg',true),
(null,20,'20.jpg',true),
(null,21,'21.jpg',true),
(null,22,'22.jpg',true),
(null,23,'23.jpg',true),
(null,24,'24.jpg',true),
(null,25,'25.jpg',true),
(null,26,'26.jpg',true),
(null,27,'27.jpg',true),
(null,28,'28.jpg',true),
(null,29,'29.jpg',true),
(null,30,'30.jpg',true),
(null,31,'31.jpg',true),
(null,32,'32.jpg',true),
(null,33,'33.jpg',true),
(null,34,'34.jpg',true),
(null,35,'35.jpg',true),
(null,36,'36.jpg',true),
(null,37,'37.jpg',true),
(null,38,'38.jpg',true),
(null,39,'39.jpg',true),
(null,40,'40.jpg',true),
(null,41,'41.jpg',true),
(null,42,'42.jpg',true),
(null,43,'43.jpg',true),
(null,44,'44.jpg',true),
(null,45,'45.jpg',true),
(null,46,'46.jpg',true),
(null,47,'47.jpg',true),
(null,48,'48.jpg',true),
(null,49,'49.jpg',true),
(null,50,'50.jpg',true),
(null,51,'51.jpg',true),
(null,52,'52.jpg',true),
(null,53,'53.jpg',true),
(null,54,'54.jpg',true),
(null,55,'55.jpg',true),
(null,56,'56.jpg',true),
(null,57,'57.jpg',true),
(null,58,'58.jpg',true),
(null,59,'59.jpg',true),
(null,60,'60.jpg',true),
(null,61,'61.jpg',true),
(null,62,'62.jpg',true),
(null,63,'63.jpg',true),
(null,64,'64.jpg',true),
(null,65,'65.jpg',true),
(null,66,'66.jpg',true);

create table reviews(
id int not null primary key auto_increment,
user int not null,
product int not null,
grade int not null,
review text
);

alter table reviews add foreign key (user) references users(user_id);
alter table reviews add foreign key (product) references products(product_id);

create table carts(
id int not null primary key auto_increment,
user int not null,
product int not null,
quantity int not null,
price decimal(18,2) not null,
in_cart_time timestamp not null
);

alter table carts add foreign key (user) references users(user_id);
alter table carts add foreign key (product) references products(product_id);

create table payments(
payment_id int not null primary key auto_increment,
name varchar(50) not null
);

insert into payments(name) values
('PayPal'),('Credit Cart');

create table invoices(
invoices_id int not null primary key auto_increment,
user int not null,
date timestamp,
payment int not null,
shipping_address varchar(100),
shipping_postoffice varchar(100),
shipping_city varchar(100),
shipping_state varchar(100) default null,
shipping_country varchar(100),
billing_address varchar(100),
billing_postoffice varchar(100),
billing_city varchar(100),
billing_state varchar(100) default null,
billing_country varchar(100) 
);

alter table invoices add foreign key (payment) references payments(payment_id);
alter table invoices add foreign key (user) references users(user_id);

create table invoices_items(
invoice int not null,
user int not null,
product int not null,
quantity int not null,
price decimal(18,2) not null
);

alter table invoices_items add foreign key (product) references products(product_id);
alter table invoices_items add foreign key (invoice) references invoices(invoices_id);

create table special_offer(
special_offer_id int not null primary key auto_increment,
product int not null,
active boolean not null default 1,
date_created datetime not null,
user_created int not null,
date_deleted datetime,
user_deleted int
);

alter table special_offer add foreign key (product) references products(product_id);
alter table special_offer add foreign key (user_created) references users(user_id);
alter table special_offer add foreign key (user_deleted) references users(user_id);

insert into special_offer(product,date_created,user_created) values
(1,now(),1),(2,now(),1),(3,now(),2),(4,now(),2),(5,now(),3),(6,now(),3);

create table users_hold_on_carts(
id int not null primary key auto_increment,
user int not null,
product int not null,
quantity int not null,
price decimal(18,2) not null,
in_cart_set datetime,
in_cart_deleted timestamp not null
);

alter table users_hold_on_carts add foreign key (user) references users(user_id);
alter table users_hold_on_carts add foreign key (product) references products(product_id);

/*
SET GLOBAL event_scheduler = ON;

DELIMITER $$

create 
	EVENT delete_from_cart 
	on SCHEDULE every 6 hour STARTS '2016-03-10 22:45:00' 
	do begin
		
		 insert into users_hold_on_carts (user,product,quantity,price,in_cart_set)
         select user, product, quantity, price, in_cart_time from carts where TO_SECONDS(in_cart_time) < TO_SECONDS(now()) - 604800;

		delete from carts where TO_SECONDS(in_cart_time) < TO_SECONDS(now()) - 604800;
		    
	end $$

DELIMITER ;


/* 604800 */







































