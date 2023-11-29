CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255),
    ApellidoP VARCHAR(255),
    APELLIDOM VARCHAR(255),
    CALLE VARCHAR(255),
    DELEGACION VARCHAR(255),
    COLONIA VARCHAR(255),
    TELEFONO VARCHAR(255),
    FECHA_NAC DATE,
    password VARCHAR(255),
    Licenciatura VARCHAR(255),
    numero_cuenta VARCHAR(20) UNIQUE, 
    rol VARCHAR(20),
    ruta_imagen VARCHAR(255),
    estado BOOLEAN NOT NULL DEFAULT 1,
    id_materia INT,  
    id_horario INT
);

insert into usuarios (nombre,ApellidoP,APELLIDOM,calle,DELEGACION,COLONIA,TELEFONO,FECHA_NAC,password,
Licenciatura,numero_cuenta,rol,estado) values ('Adrien osamet', 'Ojeda','Trasviña', 'Aquiles serda', 'Esterito', 'Esterito', '61215543212', '1996-06-11', 
12345, 'Lic. Actuaria', 'A12345678','alumno', 0);

insert into usuarios (nombre,ApellidoP,APELLIDOM,calle,DELEGACION,COLONIA,TELEFONO,FECHA_NAC,password,
Licenciatura,numero_cuenta,rol,estado) values ('Jasmin', 'Zarate','Chula', 'Chabacano', 'Haiti', 'Santo Domingo', '19207491876', '1998-03-09', 
82937, 'Lic. Arquitectura', 'A18293047','alumno', 0);

insert into usuarios (nombre,ApellidoP,APELLIDOM,calle,DELEGACION,COLONIA,TELEFONO,FECHA_NAC,password,
Licenciatura,numero_cuenta,rol,estado) values ('Frida', 'Gutierrez','Treviño', 'Cereza', 'Exposito', 'Bombas', '83947129087', '1890-10-01', 
12355, 'Lic. Panaderia', 'A78965439','alumno', 0);

insert into usuarios (nombre,ApellidoP,APELLIDOM,calle,DELEGACION,COLONIA,TELEFONO,FECHA_NAC,password,
Licenciatura,numero_cuenta,rol,estado) values ('Emiliano', 'Quiroz','Cervantes', 'Lomas Estrella', 'Canal de chalco', 'Escritorio', '81111889965', '2003-10-11', 
12222, 'Lic. Sanborns', 'A92634876','alumno', 0);




CREATE TABLE colegiaturas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    estudiante_id INT,
    monto DECIMAL(10, 2),
    fecha_pago DATE,
    estado varchar(255),
    CONSTRAINT fk_estudiante FOREIGN KEY (estudiante_id) REFERENCES usuarios(id)
);

INSERT INTO colegiaturas (estudiante_id, monto, fecha_pago, estado) VALUES
(1, 500.00, '2023-01-15', 'Pendiente'),
(1, 500.00, '2023-02-15', 'Pendiente'),
(1, 500.00, '2023-03-15', 'Pendiente'),
(2, 500.00, '2023-01-16', 'Pendiente'),
(2, 500.00, '2023-02-16', 'Pendiente'),
(2, 500.00, '2023-03-16', 'Pendiente'),
(3, 500.00, '2023-01-17', 'Pendiente'),
(3, 500.00, '2023-02-17', 'Pendiente'),
(3, 500.00, '2023-03-17', 'Pendiente');

CREATE TABLE horarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    materia VARCHAR(255),
    horario VARCHAR(255),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

CREATE TABLE calificaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_horario INT,
    calificacion INT,
    FOREIGN KEY (id_horario) REFERENCES horarios(id)
);

CREATE TABLE cursos (
    id_curso INT AUTO_INCREMENT PRIMARY KEY,
    id_profesor INT,
    nombre_curso VARCHAR(255),
    descripcion TEXT,
    horario VARCHAR(255),
    salon VARCHAR(10),
    FOREIGN KEY (id_profesor) REFERENCES usuarios(id)
);

INSERT INTO cursos (id_profesor, nombre_curso, descripcion, horario, salon)
VALUES (7, 'Modelado de programación ', 'POO', 'Lunes 12:00 PM - 14:00 PM', 'Salón F302');
INSERT INTO cursos (id_profesor, nombre_curso, descripcion, horario, salon)
VALUES (7, 'Introducción a Sistemas Operativos ', 'introducción a sistema operativo windows 10', 'Lunes 7:00 AM - 12:00 PM', 'Salón F102');


CREATE TABLE materias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    creditos INT
);
