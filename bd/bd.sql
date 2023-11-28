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

INSERT INTO horarios (id_usuario, materia, horario) VALUES (1, 'Matemáticas', 'Lunes 10:00 AM - 12:00 PM');

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

CREATE TABLE horariosp (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_curso INT,  
    materia VARCHAR(255),
    horario VARCHAR(255),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY (id_curso) REFERENCES cursos(id_curso)  
);

CREATE TABLE materias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    creditos INT
);
