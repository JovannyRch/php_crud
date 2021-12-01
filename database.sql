drop database if exists circulo_acciones_db;
create database circulo_acciones_db;
use circulo_acciones_db;

create table alumnos(
    id_alumno int primary key not null auto_increment,
    nombre_completo varchar(100),
    folio varchar(20)
);


create table socios(
    id_socio int primary key not null auto_increment,
    estado varchar(50),
    institucion varchar(50),
    servicio varchar(100)
);


create table alumnos_cursos(
    id_alumnos_cursos int primary key not null auto_increment,
    id_alumno int,
    foreign key(id_alumno) references alumnos(id_alumno) on delete cascade,
    id_socio int,
    foreign key(id_socio) references socios(id_socio) on delete cascade
);


create table mensajes(
    id_mensaje int primary key not null auto_increment,
    telefono varchar(100),
    nombre varchar(100),
    correo varchar(100),
    mensaje varchar(200)
);