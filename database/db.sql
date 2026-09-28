CREATE DATABASE brinquedos;

use brinquedos;


CREATE TABLE brinquedos (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    categoria VARCHAR(60) NOT NULL,
    faixa_etaria VARCHAR(30) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    quantidade_estoque INT UNSIGNED NOT NULL DEFAULT 0,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;


INSERT INTO brinquedos (nome, categoria, faixa_etaria, preco, quantidade_estoque) VALUES
('Boneca Falante', 'Bonecas', '3-6 anos', 89.90, 15),
('Carrinho de Controle Remoto', 'Veículos', '6-10 anos', 149.90, 8),
('Quebra-Cabeça 500 peças', 'Jogos', '10+ anos', 39.90, 20);