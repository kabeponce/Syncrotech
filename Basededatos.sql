

CREATE DATABASE IF NOT EXISTS syncrotech_pro;
USE syncrotech_pro;


CREATE TABLE marca(
    id_marca INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
);


CREATE TABLE categoria(
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE
);


CREATE TABLE subcategoria(
    id_subcategoria INT AUTO_INCREMENT PRIMARY KEY,
    id_categoria INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,

    FOREIGN KEY (id_categoria)
    REFERENCES categoria(id_categoria)
);


CREATE TABLE producto(
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    id_marca INT NOT NULL,
    id_subcategoria INT NOT NULL,

    nombre VARCHAR(150) NOT NULL,
    modelo VARCHAR(100),
    descripcion VARCHAR(255),
    tipo_licencia VARCHAR(50),
    estado VARCHAR(20) DEFAULT 'ACTIVO',

    FOREIGN KEY (id_marca)
    REFERENCES marca(id_marca),

    FOREIGN KEY (id_subcategoria)
    REFERENCES subcategoria(id_subcategoria)
);


CREATE TABLE servicio(
    id_servicio INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    tipo VARCHAR(80) NOT NULL,
    descripcion VARCHAR(255),
    precio_base DECIMAL(12,2),
    estado VARCHAR(20) DEFAULT 'ACTIVO'
);


CREATE TABLE producto_servicio(
    id_producto INT NOT NULL,
    id_servicio INT NOT NULL,

    PRIMARY KEY(id_producto,id_servicio),

    FOREIGN KEY (id_producto)
    REFERENCES producto(id_producto),

    FOREIGN KEY (id_servicio)
    REFERENCES servicio(id_servicio)
);


CREATE TABLE cliente(
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    empresa VARCHAR(150) NOT NULL,
    nit VARCHAR(30),
    contacto VARCHAR(120),
    telefono VARCHAR(30),
    correo VARCHAR(120),
    ciudad VARCHAR(80),
    direccion VARCHAR(150)
);


CREATE TABLE empleado(
    id_empleado INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(120) NOT NULL,
    cargo VARCHAR(80),
    telefono VARCHAR(30),
    correo VARCHAR(120)
);


CREATE TABLE contrato(
    id_contrato INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    id_empleado INT NOT NULL,

    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    estado VARCHAR(20) DEFAULT 'ACTIVO',

    FOREIGN KEY (id_cliente)
    REFERENCES cliente(id_cliente),

    FOREIGN KEY (id_empleado)
    REFERENCES empleado(id_empleado)
);


CREATE TABLE detalle_contrato(
    id_detalle INT AUTO_INCREMENT PRIMARY KEY,
    id_contrato INT NOT NULL,
    id_producto INT,
    id_servicio INT,
    cantidad INT DEFAULT 1,
    valor_unitario DECIMAL(12,2),

    FOREIGN KEY (id_contrato)
    REFERENCES contrato(id_contrato),

    FOREIGN KEY (id_producto)
    REFERENCES producto(id_producto),

    FOREIGN KEY (id_servicio)
    REFERENCES servicio(id_servicio)
);


CREATE TABLE factura(
    id_factura INT AUTO_INCREMENT PRIMARY KEY,
    id_contrato INT NOT NULL,
    fecha DATE NOT NULL,
    total DECIMAL(12,2),
    estado VARCHAR(20) DEFAULT 'PENDIENTE',

    FOREIGN KEY (id_contrato)
    REFERENCES contrato(id_contrato)
);


CREATE TABLE ticket(
    id_ticket INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    id_empleado INT,

    asunto VARCHAR(150),
    descripcion TEXT,
    prioridad VARCHAR(20),
    estado VARCHAR(20) DEFAULT 'ABIERTO',
    fecha_apertura DATE,

    FOREIGN KEY (id_cliente)
    REFERENCES cliente(id_cliente),

    FOREIGN KEY (id_empleado)
    REFERENCES empleado(id_empleado)
);


CREATE TABLE licencia(
    id_licencia INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    id_producto INT NOT NULL,

    serial_licencia VARCHAR(100),
    fecha_inicio DATE,
    fecha_fin DATE,
    estado VARCHAR(20),

    FOREIGN KEY (id_cliente)
    REFERENCES cliente(id_cliente),

    FOREIGN KEY (id_producto)
    REFERENCES producto(id_producto)
);


INSERT INTO marca(nombre) VALUES
('Fortinet'),
('AWS'),
('Microsoft'),
('Dell'),
('Kaspersky');


INSERT INTO categoria(nombre) VALUES
('Seguridad'),
('Cloud'),
('Hardware'),
('Software'),
('Infraestructura');


INSERT INTO subcategoria(id_categoria,nombre) VALUES
(1,'Firewall'),
(1,'Endpoint'),
(1,'SIEM'),
(2,'Compute'),
(2,'Storage'),
(2,'Database'),
(2,'Networking'),
(3,'Servidor'),
(3,'Laptop'),
(3,'Desktop'),
(3,'Storage Empresarial'),
(4,'Sistema Operativo'),
(4,'Productividad'),
(5,'Redes');


INSERT INTO producto(id_marca,id_subcategoria,nombre) VALUES
(1,1,'FortiGate'),
(1,14,'FortiSwitch'),
(1,14,'FortiAP'),
(1,1,'FortiManager'),
(1,3,'FortiAnalyzer');


INSERT INTO producto(id_marca,id_subcategoria,nombre) VALUES
(2,4,'Amazon EC2'),
(2,5,'Amazon S3'),
(2,4,'AWS Lambda'),
(2,6,'Amazon RDS'),
(2,7,'Amazon VPC');


INSERT INTO producto(id_marca,id_subcategoria,nombre) VALUES
(3,2,'Microsoft Azure'),
(3,13,'Microsoft 365'),
(3,12,'Windows Server'),
(3,6,'Microsoft SQL Server'),
(3,2,'Microsoft Defender for Endpoint');

INSERT INTO producto(id_marca,id_subcategoria,nombre) VALUES
(4,8,'Dell PowerEdge'),
(4,9,'Dell Latitude'),
(4,10,'Dell OptiPlex'),
(4,11,'Dell PowerStore'),
(4,11,'Dell EMC Unity XT');

INSERT INTO producto(id_marca,id_subcategoria,nombre) VALUES
(5,2,'Kaspersky Endpoint Security'),
(5,3,'Kaspersky Security Center'),
(5,2,'Kaspersky Small Office Security'),
(5,3,'Kaspersky Threat Intelligence'),
(5,3,'Kaspersky Anti Targeted Attack Platform');


INSERT INTO servicio(nombre,tipo,precio_base) VALUES
('Implementación','Proyecto',1500000),
('Soporte Premium','Soporte',900000),
('Monitoreo 24/7','Administrado',2500000),
('Consultoría Cloud','Consultoría',1800000),
('Migración Infraestructura','Proyecto',3500000),
('Renovación Licencias','Comercial',500000),
('Hardening Seguridad','Seguridad',2200000),
('Capacitación Técnica','Capacitación',1200000);


INSERT INTO producto_servicio VALUES
(1,1),(1,2),(1,6),
(2,1),(2,2),
(6,4),
(8,4),
(11,4),
(16,1),(16,2),
(21,2),(21,7);


INSERT INTO cliente(empresa,contacto,telefono,correo,ciudad) VALUES
('InnovaSeg','Juan Gomez','3001000001','juan@empresa.com','Bogotá'),
('CyberWorks','Laura Perez','3001000002','laura@empresa.com','Medellín');


INSERT INTO empleado(nombre,cargo,telefono,correo) VALUES
('Carlos Ruiz','Ingeniero Preventa','3101000001','carlos@syncrotech.com'),
('Marta Lopez','Consultora Cloud','3101000002','marta@syncrotech.com');


INSERT INTO contrato(id_cliente,id_empleado,fecha_inicio,fecha_fin) VALUES
(1,1,'2026-01-01','2027-01-01'),
(2,2,'2026-02-01','2027-02-01');


INSERT INTO detalle_contrato(id_contrato,id_producto,id_servicio,cantidad,valor_unitario) VALUES
(1,1,1,1,1500000),
(1,1,2,1,900000),
(2,6,4,1,1800000);

INSERT INTO factura(id_contrato,fecha,total,estado) VALUES
(1,'2026-01-05',2400000,'PAGADA'),
(2,'2026-02-05',1800000,'PENDIENTE');


INSERT INTO licencia(id_cliente,id_producto,serial_licencia,fecha_inicio,fecha_fin,estado) VALUES
(1,1,'FGT-12345','2026-01-01','2027-01-01','ACTIVA'),
(2,6,'AWS-99881','2026-02-01','2027-02-01','ACTIVA');


INSERT INTO ticket(id_cliente,id_empleado,asunto,prioridad,fecha_apertura) VALUES
(1,1,'Caída de VPN','ALTA','2026-04-29'),
(2,2,'Consulta facturación','MEDIA','2026-04-29');
```
