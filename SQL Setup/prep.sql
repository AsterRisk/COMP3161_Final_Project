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

create table comments
(
    comment_id int not null UNIQUE,
    user_id int not null,
    post_id int not null,
    text_content varchar (300),
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

create table friend_requests
(
	requester_id int not null,
	requestee_id int not null,
	primary key (requester_id, requestee_id)
);

create table group_posts
(
	g_post_id int not null UNIQUE,
    user_id int not null,
	group_id int not null,
    text_content varchar(300),
    media_link varchar(70),
    /*foreign key (user_id) references users,*/
    primary key (g_post_id)
);

create table group_comments
(
	g_comment_id int not null UNIQUE,
    member_id int not null,
    g_post_id int not null,
    text_content varchar (300),
    primary key (g_comment_id)
);

delimiter //
create procedure acceptFriendRequest(IN requesting int, requested int)
begin
	delete from friend_requests where requester_id = requesting and requestee_id = requested;
	insert into friends (user_id, friend_id, fgroup) values (requesting, requested, "Default");
	insert into friends (user_id, friend_id, fgroup) values (requested, requesting, "Default");
end;

create procedure deleteFriendRequest(IN requesting int, requested int)
begin
	delete from friend_requests where requester_id = requesting and requestee_id = requested;
end;

create procedure joinGroup(IN newMemberId int, groupID int)
begin 
	insert into members (group_id, member_id, role) values (groupID, newMemberId, "Member");
end;

create procedure createGroup (IN gname varchar(30), creator_id int, dp_address varchar(70))
begin
    DECLARE numGroups INT;
    select count(group_id) into numGroups from groups;
    insert into groups (group_id, owner_id, group_name, group_dp_location) values (numGroups+1, creator_id, gname, dp_address);
    insert into members (group_id, member_id, role) values (numGroups+1, creator_id, "Owner");
end;

create procedure searchUser(IN searchVal varchar(30))
begin
	select * from users where first_name like searchVal or last_name like searchVal or concat(first_name, concat(" ", last_name)) like searchVal;
end;

create procedure searchGroup(IN searchVal varchar(30))
begin
	select * from groups where group_name like searchVal;
end;

create procedure requestFriend(IN requesting int, requested int)
begin
	insert into friend_requests (requester_id, requestee_id) values (requesting, requested);
end;

create procedure promoteUser(IN g_id int, m_id int)
begin
	update members set role = "Content Editor" where member_id = m_id and group_id = g_id;
end;

create procedure leaveGroup(IN g_id int, m_id int)
begin
	delete from members where group_id = g_id and member_id = m_id;
end;
	
//

delimiter ;
