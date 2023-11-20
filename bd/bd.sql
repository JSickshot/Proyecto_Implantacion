CREATE TABLE usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(255),
        ApellidoP VARCHAR(255),
        APELLIDOM VARCHAR(255),
        CALLE VARCHAR (255),
        DELEGACION VARCHAR(255),
        COLONIA VARCHAR(255),
        TELEFONO VARCHAR (255),
        FECHA_NAC date,
        password VARCHAR(255),
        Licenciatura varchar(255),
        numero_cuenta VARCHAR(20),
        rol VARCHAR(20),
        ruta_imagen varchar (255)
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
