create database apb;
use apb;

create table usuarios (
    id int auto_increment primary key,
    nome varchar(50),
    login varchar(20) unique not null,
    senha varchar(255) not null
);

create table imc (
    id int auto_increment primary key,
    nome varchar(50),
    peso float,
    altura float,
    imc float,
    classificacao varchar(50),
    data_reg timestamp default current_timestamp,
    
    quemFez varchar(20)
);

/*
select * from imc; 
drop database apb;
 */
