CREATE TABLE Alumnos (
  ID INT AUTO_INCREMENT PRIMARY KEY,
  usuario varchar (25),
  pass varchar (25)
);

INSERT INTO Alumnos (usuario, pass) VALUES
    ('julio', 'burgoin'); 


CREATE TABLE Profesores (
  ID INT AUTO_INCREMENT PRIMARY KEY,
  usuario varchar (25),
  pass varchar (25)
);

INSERT INTO profesores (usuario, pass) VALUES
    ( 'juan', 'calvillo'); 


create table materias (
  fisica varchar (80),
  quimica varchar (80),
  Poo  varchar (80),
  implantacion varchar (80),
  redes1 varchar (80),
  redes2 varchar (80),
  redes3 varchar (80),
  redes4 varchar (80),
  aplicacionesmovi varchar (80),
  legislacion varchar (80),
  basedatos1 varchar (80),
  basedatos2 varchar (80),
  termodinamica varchar (80),
  calculo varchar (80),
  analisis varchar (80),
  sistemasope varchar (80),
  progSO varchar (80),
  gestiondeSO varchar (80),
  analiticaweb varchar (80),
  cloudcomp varchar (80),
  microprocesadores varchar (80),
  embebidos varchar (80)
);

INSERT INTO materias VALUES
    ( 'fisica 1', 'Quimica','Programación orientada', 'implantación y mantenimiento','redes a', 'redes b','redes c', 
    'redes d','aplicaciones moviles', 'legislación','basededatosa', 'basededatosb','termodinamica',
    'calculo diferencial','analisis y diseño','sistemas operativos','programacion de SO','Gestion de SO', 
    'analitica web', 'cloud computing','microprocesadores','embebidos'); 



  CREATE TABLE P_principal (
  ID INT AUTO_INCREMENT PRIMARY KEY,
  nombre varchar (50),
  cuenta int (10),
  grado varchar(50)
);

INSERT INTO P_principal (nombre,cuenta,grado) VALUES
    ('juan angel calvillo', 192654987, 'lic en base de datos'); 