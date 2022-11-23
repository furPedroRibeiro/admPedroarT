CREATE DATABASE vitrine;

USE vitrine;

CREATE TABLE cliente(
	cd_cliente INT NOT NULL AUTO_INCREMENT,
	nome VARCHAR(30) NOT NULL,
	nascimento DATE NOT NULL,
	sexo ENUM('M','F'),
	email VARCHAR(45) NOT NULL,
    telefone VARCHAR(15) NOT NULL,
	PRIMARY KEY (cd_cliente)
)DEFAULT CHARSET = utf8;

CREATE TABLE categoria(
	cd INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(20) NOT NULL,
    PRIMARY KEY (cd)
)DEFAULT CHARSET = utf8;

CREATE TABLE produto(
	cd_produto INT NOT NULL AUTO_INCREMENT,
	nome VARCHAR(45) NOT NULL,
    cd_categoria INT NOT NULL,
	ds_produto VARCHAR(100),
	valor DECIMAL(5,2),
	imagem VARCHAR(45), 
	link VARCHAR(20),
    FOREIGN KEY (cd_categoria) REFERENCES categoria(cd),
	PRIMARY KEY (cd_produto)
)DEFAULT CHARSET = utf8;

CREATE TABLE carrinho(
	id INT NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    cd_cliente INT NOT NULL,
	FOREIGN KEY (cd_cliente) REFERENCES cliente(cd_cliente),
    cd_produto INT NOT NULL,
    FOREIGN KEY (cd_produto) REFERENCES produto(cd_produto)
)DEFAULT CHARSET = utf8;