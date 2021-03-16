-- Creates and Drops

CREATE TABLE Ciudades (
  ID_Ciudad int(11) NOT NULL,
  Codigo varchar(10) NOT NULL,
  Nombre varchar(40) NOT NULL,
  Codigo_pais varchar(10) NOT NULL,
  PRIMARY KEY (ID_Ciudad));

CREATE TABLE Paises (
  ID_Pais int(11) NOT NULL,
  Codigo varchar(5) NOT NULL,
  Nombre varchar(40) NOT NULL,
  PRIMARY KEY (ID_Pais));



CREATE TABLE Usuario (
  ID_Usuario INT(200) AUTO_INCREMENT,
  Nombre VARCHAR(100),
  Apellido VARCHAR(200),
  Usuario VARCHAR(60),
  Contrasena VARCHAR(50),
  ID_Rol INT,
  Correo VARCHAR(98),
  PRIMARY KEY (ID_Usuario),
  FOREIGN KEY (ID_Rol) references Rol(ID_Rol) on update cascade on delete cascade
);

-- Drop table Usuario;

CREATE TABLE Usuarios_token (
  ID_Token int(11) NOT NULL AUTO_INCREMENT,
  ID_Usuario varchar(45) DEFAULT NULL,
  Token varchar(45) DEFAULT NULL,
  Estado varchar(45) DEFAULT NULL,
  Fecha datetime DEFAULT NULL,
  PRIMARY KEY (ID_Token));

CREATE TABLE Vacante (
  ID_Vacante INT(200) AUTO_INCREMENT,
  Compania VARCHAR(150),
  Logo VARCHAR(400),
  URL VARCHAR(9000),
  Posicion VARCHAR(50),
  Descripcion VARCHAR(10000),
  ID_Ciudad int(11) ,
  Ubicacion VARCHAR(5000),
  ID_Categoria INT,
  ID_Tipo_Vacante INT,
  Email VARCHAR(98),
  PRIMARY KEY (ID_Vacante),
  FOREIGN KEY (ID_Categoria) references Categoria(Id_Categoria) on update cascade on delete cascade,
  FOREIGN KEY (ID_Tipo_vacante) references Tipo_Vacante(ID_Tipo_vacante) on update cascade on delete cascade
);

-- select * from Vacante;
-- drop TABLE Vacante;
 
CREATE TABLE Tipo_Vacante (
  ID_Tipo_Vacante INT(200) AUTO_INCREMENT,
  Nombre VARCHAR(100),
  PRIMARY KEY (ID_Tipo_Vacante)
);

CREATE TABLE Rol (
  ID_Rol INT(200) AUTO_INCREMENT,
  Nombre VARCHAR(100),
  PRIMARY KEY (ID_Rol)
);

CREATE TABLE Categoria (
  ID_Categoria INT(200) AUTO_INCREMENT,
  Nombre VARCHAR(100),
  PRIMARY KEY (ID_Categoria)
);

-- Rol Inserts
INSERT INTO Rol (nombre) values(
 "User"
);

INSERT INTO Rol (nombre) values(
 "Postman"
);

INSERT INTO Rol (nombre) values(
 "Admin"
);

-- Tipo Vacante Inserts
insert into Tipo_Vacante (Nombre) values (
"Freelancer"
);

insert into Tipo_Vacante (Nombre) values (
"Full Time"
);

insert into Tipo_Vacante (Nombre) values (
"Part Time"
);

-- select * from Tipo_Vacante;



-- Insert categoria Procedures
Delimiter //
CREATE PROCEDURE InsertCategorias(in nombre varchar(100))
BEGIN
insert into Categoria (nombre) values (nombre)
;
END
//


-- Procedures Execute

call InsertCategorias('Programming');
//
call InsertCategorias('Design');
//
call InsertCategorias('Accountant');
//
call InsertCategorias('Buyer');
//
call InsertCategorias('Mechatronic');
//
call InsertCategorias('Secretary');
//
call InsertCategorias('Engeniering');
//
call InsertCategorias('Teacher');
//
call InsertCategorias('Security');
//
call InsertCategorias('Consultant');
//
call InsertCategorias('Lawyer');
//

-- select * from Usuario;






