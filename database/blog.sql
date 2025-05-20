CREATE DATABASE blog;

CREATE TABLE tags(
  id_tags INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  descritivo VARCHAR(50) NOT NULL
);

INSERT INTO tags (descritivo)
VALUES
("Tecnologia"),
("Gastronomia"),
("Games"),
("Politica"),
("Esportes");


CREATE TABLE posts (
  id_posts INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(50) NOT NULL,
  conteudo VARCHAR(1000) NOT NULL,
  datap DATETIME NOT NULL,
  id_tags INT NOT NULL,
  
  FOREIGN KEY (id_tags) REFERENCES tags (id_tags)
);

INSERT INTO posts (titulo, conteudo, datap, id_tags) 
VALUES
('Primeiro Post', 'Primeiro Post', '2025-05-18', 1),
('Segundo Post', 'Segundo Post', '2025-05-18', 2);

CREATE TABLE usuarios (
  id_usuarios INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  senha VARCHAR(100) NOT NULL,
  id_posts INT NOT NULL,
  
  FOREIGN KEY (id_posts) REFERENCES posts (id_posts)
);

INSERT INTO usuarios (nome, email, senha, id_posts) 
VALUES
('admin', 'admin@admin.com', 'admin', 1),
('teste', 'teste@teste.com', 'teste', 2);
