CREATE TABLE ADMINISTRADOR (
    administradorID INT PRIMARY KEY AUTO_INCREMENT,
    nombreAdministrador VARCHAR(100) NOT NULL
);

CREATE TABLE EVENTO (
    eventoID INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    fecha DATE NOT NULL,
    descripcion TEXT,
    imagen VARCHAR(255),
    linkDeCompra VARCHAR(255),
    administradorID INT NOT NULL,
    timeStampEdicion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (administradorID) REFERENCES ADMINISTRADOR(administradorID)
);
