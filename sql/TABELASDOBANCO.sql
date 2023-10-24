CREATE DATABASE crudcontabilivre;
USE crudcontabilivre;

create table clientes (
id INT  AUTO_INCREMENT NOT NULL PRIMARY KEY,
nome VARCHAR(100) NOT NULL,
email  VARCHAR(100) NOT NULL);

CREATE TABLE vendas (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    id_cliente INT NOT NULL,
    valor_nota DECIMAL(10, 2) NOT NULL,
    numero_nota VARCHAR(20) NOT NULL,
    data_emissao DATE NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id)
);