create database if not exists active_record default charset set utf8 default collate utf8mb4_general_ci;

use active_record;

create table if not exists users(
    id int(11) unsigned not null auto_increment primary key,
    full_name tinytext not null,
    email varchar(255) not null unique
) engine = innodb default collate utf8mb4_general_ci ;

insert into users values(1, 'php lang', 'php@php.net');