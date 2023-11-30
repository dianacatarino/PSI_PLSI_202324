CREATE DATABASE LusitaniaTravel;
USE LusitaniaTravel;

CREATE TABLE Empresas (
    id INT AUTO_INCREMENT,
    sede VARCHAR(50) NOT NULL,
    capitalsocial DECIMAL(10, 2), 
    email VARCHAR(100),
    localidade VARCHAR(50), 
    nif VARCHAR(15),  
    morada VARCHAR(30) NOT NULL,
    CONSTRAINT pk_empresa_id PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE Fornecedores (
    id INT AUTO_INCREMENT,
    responsavel VARCHAR(30) NOT NULL,
    tipo VARCHAR(20) NOT NULL,
    nome_alojamento VARCHAR(30) NOT NULL,
    localizacao_alojamento VARCHAR(50) NOT NULL,
    acomodacoes_alojamento VARCHAR(100) NOT NULL,
    CONSTRAINT pk_fornecedores_id PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE Reservas (
    id INT AUTO_INCREMENT,
    tipo ENUM('Online', 'Presencial'),
    checkin DATE NOT NULL,
    checkout DATE NOT NULL,
    numeroquartos INT NOT NULL,
    numeroclientes INT NOT NULL,
    valor DECIMAL(10, 2) NOT NULL,
    cliente_id INT NOT NULL,
    funcionario_id INT NOT NULL,
    CONSTRAINT pk_reservas_id PRIMARY KEY (id),
    CONSTRAINT fk_reservas_cliente FOREIGN KEY (cliente_id) REFERENCES User(id),
    CONSTRAINT fk_reservas_funcionario FOREIGN KEY (funcionario_id) REFERENCES User(id)
) ENGINE=InnoDB;

CREATE TABLE Imagens (
    id INT AUTO_INCREMENT,
    filename VARCHAR(255) NOT NULL,
    fornecedor_id INT NOT NULL,
    CONSTRAINT pk_imagens_id PRIMARY KEY (id),
	CONSTRAINT fk_imagens_fornecedor FOREIGN KEY (fornecedor_id) REFERENCES Fornecedores(id)
) ENGINE=InnoDB;

CREATE TABLE LinhasReservas (
    id INT AUTO_INCREMENT,
    tipoquarto VARCHAR(20) NOT NULL,
    numeronoites INT NOT NULL,
    numerocamas INT NOT NULL,
    subtotal DECIMAL(10, 2) NOT NULL,
    reservas_id INT NOT NULL,
    CONSTRAINT pk_linhasreservas_id PRIMARY KEY (id),
    CONSTRAINT fk_linhasreservas_reservas FOREIGN KEY (reservas_id) REFERENCES Reservas(id)
) ENGINE=InnoDB;

CREATE TABLE Faturas (
    id INT AUTO_INCREMENT,
    totalf DECIMAL(10, 2) NOT NULL,
    totalsi DECIMAL(10, 2) NOT NULL,
    iva DECIMAL(4, 2) NOT NULL,
    empresa_id INT NOT NULL,
    reserva_id INT NOT NULL,
    CONSTRAINT pk_faturas_id PRIMARY KEY (id),
    CONSTRAINT fk_faturas_empresas FOREIGN KEY (empresa_id) REFERENCES Empresas (id),
    CONSTRAINT fk_faturas_reservas FOREIGN KEY (reserva_id) REFERENCES Reservas (id)
) ENGINE=InnoDB;

CREATE TABLE LinhasFaturas (
    id INT AUTO_INCREMENT,
    quantidade INT NOT NULL,
    precounitario DECIMAL(10, 2) NOT NULL,  
    subtotal DECIMAL(10, 2) NOT NULL,    
	iva DECIMAL(4, 2) NOT NULL,
    fatura_id INT NOT NULL,
    linhasreservas_id INT NOT NULL,
    CONSTRAINT pk_linhasfaturas_id PRIMARY KEY (id),
    CONSTRAINT fk_linhasfaturas_faturas FOREIGN KEY (fatura_id) REFERENCES Faturas (id),
    CONSTRAINT fk_linhasfaturas_linhasreservas FOREIGN KEY (linhasreservas_id) REFERENCES LinhasReservas(id)
) ENGINE=InnoDB;

CREATE TABLE Confirmacoes (
    id INT AUTO_INCREMENT,
    estado ENUM('Pendente', 'Confirmado', 'Cancelado'),
    dataconfirmacao DATE,
    reserva_id INT NOT NULL,
    fornecedor_id INT NOT NULL,
    CONSTRAINT pk_confirmacoes_id PRIMARY KEY (id),
    CONSTRAINT fk_confirmacoes_reservas FOREIGN KEY (reserva_id) REFERENCES Reservas (id),
    CONSTRAINT fk_confirmacoes_fornecedor FOREIGN KEY (fornecedor_id) REFERENCES Fornecedores (id)
) ENGINE=InnoDB;

CREATE TABLE Comentarios (
    id INT AUTO_INCREMENT,
    titulo VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    data_comentario DATE NOT NULL,
    cliente_id INT NOT NULL,
    fornecedor_id INT NOT NULL,
    CONSTRAINT pk_comentarios_id PRIMARY KEY (id),
    CONSTRAINT fk_comentarios_cliente FOREIGN KEY (cliente_id) REFERENCES User(id),
	CONSTRAINT fk_comentarios_fornecedor FOREIGN KEY (fornecedor_id) REFERENCES Fornecedores(id)
) ENGINE=InnoDB;

CREATE TABLE Avaliacoes (
    id INT AUTO_INCREMENT,
    classificacao INT NOT NULL,
    data_avaliacao DATE NOT NULL,
    cliente_id INT NOT NULL,
    fornecedor_id INT NOT NULL,
    CONSTRAINT pk_avaliacoes_id PRIMARY KEY (id),
    CONSTRAINT fk_avaliacoes_cliente FOREIGN KEY (cliente_id) REFERENCES User(id),
    CONSTRAINT fk_avaliacoes_fornecedor FOREIGN KEY (fornecedor_id) REFERENCES Fornecedores(id)
) ENGINE=InnoDB;

CREATE TABLE Profile (
	id INT AUTO_INCREMENT,
	name VARCHAR(25) NOT NULL,
	mobile VARCHAR(9) NOT NULL,
	street VARCHAR(30) NOT NULL,
	locale VARCHAR(20) NOT NULL,
	postalCode VARCHAR(10) NOT NULL,
    role ENUM('admin', 'funcionario', 'fornecedor','cliente') DEFAULT NULL,
    user_id INT NOT NULL,
    CONSTRAINT pk_profile_id PRIMARY KEY (id),
    CONSTRAINT pk_profile_user_id FOREIGN KEY (user_id) REFERENCES User(id)
) ENGINE=InnoDB;

ALTER TABLE User
ADD COLUMN profile_id INT,
ADD CONSTRAINT fk_user_profile_id FOREIGN KEY (profile_id) REFERENCES Profile(id);




