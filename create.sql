create table company(
    id int primary key
    ,nm varchar(25)
    ,tel char(13)
    ,e_mail varchar(25)
    ,loginId varchar(10)
    ,ps varchar(10)
)

create table instructor(
    id int primary key
    ,nm varchar(25)
    ,tel char(13)
    ,e_mail varchar(25)
    ,loginId varchar(10)
    ,ps varchar(10)
)

create table schedule(
    id int primary key
    ,str_date date
    ,end_date date
    ,u_id int
)

create table skill(
    id int primary key
    ,lang varchar(10)
)

create table skill_user(
    id int primary key
    ,u_id int
    ,s_id int
)

create table evalution(
    id int primary key
    ,c_id int
    ,u_id int
    ,results int
)

create table complete(
    id int primary key
    ,val varchar(5)
)

create table offer(
    id int primary key
    ,c_id int
    ,u_id int
    ,s_id int
    ,contents varchar(100)
    ,str_date date
    ,end_date date
    ,order_date date
    ,limit_date date
    ,app_id int
    ,complete_id int
)

create table approval(
    id int primary key
    ,val varchar(10)
)

insert skill(lang) values('C++'),('C#'),('Java'),('PHP'),('Ruby'),('Python')
,('Perl'),('VisualBasic'),('JavaScript'),('VB.NET'),('GO'),('Swift'),('Kotlin')
,('Objective C'),('LISP'),('Haskel'),('Prolog');

insert complete(val) values
('完了'),('未完了');

insert approval(val) values
('未承認'),('承認'),('拒否');

ALTER TABLE company MODIFY id INT auto_increment;
ALTER TABLE instructor MODIFY id INT auto_increment;
ALTER TABLE schedule MODIFY id INT auto_increment;
ALTER TABLE skill MODIFY id INT auto_increment;
ALTER TABLE skill_user MODIFY id INT auto_increment;
ALTER TABLE evalution MODIFY id INT auto_increment;
ALTER TABLE complete MODIFY id INT auto_increment;
ALTER TABLE offer MODIFY id INT auto_increment;
ALTER TABLE approval MODIFY id INT auto_increment;

ALTER TABLE company ADD UNIQUE (loginId);
ALTER TABLE company ADD UNIQUE (ps);
ALTER TABLE instructor ADD UNIQUE (loginId);
ALTER TABLE instructor ADD UNIQUE (ps);

ALTER TABLE schedule ADD FOREIGN KEY(u_id) REFERENCES instructor(id);
ALTER TABLE skill_user ADD FOREIGN KEY(u_id) REFERENCES instructor(id);
ALTER TABLE skill_user ADD FOREIGN KEY(s_id) REFERENCES skill(id);
ALTER TABLE offer ADD FOREIGN KEY(u_id) REFERENCES instructor(id);
ALTER TABLE offer ADD FOREIGN KEY(s_id) REFERENCES skill(id);
ALTER TABLE offer ADD FOREIGN KEY(c_id) REFERENCES company(id);
ALTER TABLE offer ADD FOREIGN KEY(app_id) REFERENCES approval(id);
ALTER TABLE offer ADD FOREIGN KEY(complete_id) REFERENCES complete(id);
ALTER TABLE evalution ADD FOREIGN KEY(u_id) REFERENCES instructor(id);
ALTER TABLE evalution ADD FOREIGN KEY(c_id) REFERENCES company(id);

ALTER TABLE テーブル名 ALTER COLUMN カラム名 DROP NOT NULL;

ALTER TABLE schedule MODIFY u_id int not null;
ALTER TABLE skill_user MODIFY u_id int NOT NULL;
ALTER TABLE skill_user MODIFY s_id int NOT NULL;
ALTER TABLE offer MODIFY u_id int NOT NULL;
ALTER TABLE offer MODIFY s_id int NOT NULL;
ALTER TABLE offer MODIFY app_id int NOT NULL;
ALTER TABLE offer MODIFY complete_id int NOT NULL;
ALTER TABLE offer MODIFY c_id int NOT NULL;
ALTER TABLE evalution MODIFY u_id int NOT NULL;
ALTER TABLE evalution MODIFY c_id int NOT NULL;

ALTER TABLE instructor MODIFY loginId int NOT NULL;
ALTER TABLE instructor MODIFY ps int NOT NULL;
ALTER TABLE company MODIFY loginId int NOT NULL;
ALTER TABLE company MODIFY ps int NOT NULL;


insert instructor(loginId,ps) values ("ksks","ksks");
insert skill_user(id,u_id,s_id) values (1,1,1),(2,1,2),(3,1,3);
select ins.loginId,sk.lang
from instructor ins
inner join skill_user sk_u on ins.id = sk_u.u_id
inner join skill sk on sk_u.s_id = sk.id;
delete from skill_user where skill_user.id=4;

select ins.nm,sk.lang
from instructor ins
inner join skill_user sk_u on ins.id = sk_u.u_id
inner join skill sk on sk_u.s_id = sk.id;

UPDATE offer SET app.id=:id where id = :findId

SELECT ins.nm, sk.lang, sch.str_date, sch.end_date
FROM instructor ins
INNER JOIN skill_user sk_u ON ins.id = sk_u.u_id
INNER JOIN schedule sch ON ins.id = sch.u_id
INNER JOIN skill sk ON sk.id = sk_u.s_id
WHERE sk_u.s_id IN(:id)
AND sch.str_date >= :str_date
AND sch.end_date <= :end_date
GROUP BY ins.id
