DROP DATABASE IF EXISTS  testapi;
CREATE DATABASE IF NOT EXISTS testapi;
USE testapi;
CREATE TABLE empleado(
    idEmpleado INTEGER AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR (50) NOT NULL,
    apellido VARCHAR (50) NOT NULL,
    telefono VARCHAR (50) NOT NULL
);
CREATE TABLE cliente(
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR (50) NOT NULL,
    apellido VARCHAR (50) NOT NULL,
    telefono VARCHAR (50) NOT NULL,
    idEmpleado INTEGER,
    INDEX(idEmpleado),
    FOREIGN KEY cliente(idEmpleado) REFERENCES empleado(idEmpleado) ON DELETE CASCADE
);
