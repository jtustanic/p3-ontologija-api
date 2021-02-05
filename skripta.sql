create database jtustanic_20 default character set utf8mb4;
use jtustanic_20;
create table ontologija(
    sifra int not null primary key auto_increment,
    ime_nakladnika varchar(255) not null,
    mjesto_izdanja varchar(255) not null,
    jePreveo varchar(255) not null,
    jePrevedeno varchar(255) not null,
    zaradioJe int(255) not null,
);
