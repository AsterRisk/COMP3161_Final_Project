drop database if exists final_proj_3161;
create database final_proj_3161;
use final_proj_3161;

drop table if exists users;
drop table if exists logins;
drop table if exists friends;
drop table if exists posts;
drop table if exists media;
drop table if exists comments;
drop table if exists groups;
drop table if exists members;

create table users
(
    user_id int not null unique,
    first_name varchar(15) not null,
    last_name varchar(15) not null,
    tele_num varchar (15) unique,
    home_address varchar (50),
    email varchar (45) not null unique,
    dob Date not null,
    profile_pic_address varchar(50),
	clearance int not null,
    /*foreign key (user_id, address_id) references addresses,*/
    primary key (user_id)
);

create table logins
(
    user_id int not null unique,
    email varchar (45) not null unique,
    pass_digest varchar(65) not null, 
    salt int not null, 
    primary key (user_id, email)
);

/*create table addresses
(
    record_id int not null unique, 
    user_id int not null unique,
    street_number int not null,
    street_pre varchar(10),
    street_suf varchar(10),
    foreign key(user_id) references users,
    primary key(user_id, record_id)
);*/

create table friends
(
    friend_id int not null,
    user_id int not null,
    fgroup varchar(10),
    /*foreign key(user_id) references users,*/
    primary key (user_id, friend_id)
);

create table posts
(
    post_id int not null UNIQUE,
    user_id int not null,
    text_content varchar(300),
    media_link varchar(70),
    /*foreign key (user_id) references users,*/
    primary key (post_id)
);


create table media
(
    user_id int not null,
    media_link varchar(70) not null unique,
    primary key (media_link)
);

create table comments
(
    comment_id int not null UNIQUE,
    user_id int not null,
    post_id int not null,
    text_content varchar (300),
    media_link varchar(30),
    primary key (comment_id)
);

create table groups
(
    group_id int not null UNIQUE,
    owner_id int not null,
    group_name varchar(30) not null,
    primary key (group_id, owner_id)
);

create table members
(
    group_id int not null,
    member_id int not null,
	role varchar (15) not null,
    primary key (group_id, member_id)
);
