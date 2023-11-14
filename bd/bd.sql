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

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    numero_cuenta VARCHAR(20) NOT NULL,
    rol VARCHAR(20) NOT NULL
);

CREATE TABLE materias (
    id_materia INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    grupo VARCHAR(255) NOT NULL,
    lunes VARCHAR(255),
    martes VARCHAR(255),
    miercoles VARCHAR(255),
    jueves VARCHAR(255),
    viernes VARCHAR(255),
    sabado VARCHAR(255),
    salon VARCHAR(255),
    id_profesor INT,
    FOREIGN KEY (id_profesor) REFERENCES usuarios(id)
);