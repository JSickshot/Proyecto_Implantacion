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
    ruta_imagen VARCHAR(255)
);


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

CREATE TABLE cursos (
    id_curso INT AUTO_INCREMENT PRIMARY KEY,
    id_profesor INT,
    nombre_curso VARCHAR(255),
    descripcion TEXT,
    horario VARCHAR(255),
    salon VARCHAR(10),
    FOREIGN KEY (id_profesor) REFERENCES usuarios(id)
);

CREATE TABLE horariosp (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_curso INT,  
    materia VARCHAR(255),
    horario VARCHAR(255),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY (id_curso) REFERENCES cursos(id_curso)  
);
