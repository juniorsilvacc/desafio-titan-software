USE controle_empresa;

CREATE TABLE tbl_usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE tbl_empresa (
    id_empresa INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(40) NOT NULL
);

CREATE TABLE tbl_funcionario (
    id_funcionario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    cpf VARCHAR(11) NOT NULL UNIQUE,
    rg VARCHAR(20) NOT NULL,
    email VARCHAR(30) NOT NULL UNIQUE,
    id_empresa INT NOT NULL,
    data_cadastro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    salario DOUBLE(10, 2) NOT NULL,
    bonificacao DOUBLE(10, 2) DEFAULT 0,
    FOREIGN KEY (id_empresa) REFERENCES tbl_empresa(id_empresa)
);

-- Inserir usuário inicial
INSERT INTO tbl_usuario (login, senha) VALUES ('teste@gmail.com.br', MD5('1234'));
