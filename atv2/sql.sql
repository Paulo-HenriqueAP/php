CREATE DATABASE api_aula2;
USE api_aula2;

CREATE TABLE api_usuarios(
id int auto_increment primary key,
nome varchar(100) not null,
email varchar(150) not null unique,
senha varchar(255) not null,
telefone varchar(200) not null,
endereco varchar(100) not null,
estado char(2) not null,
data_nascimento date not null,
criacao timestamp default current_timestamp
);