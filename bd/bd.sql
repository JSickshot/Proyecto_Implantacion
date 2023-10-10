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