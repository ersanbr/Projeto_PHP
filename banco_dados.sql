CREATE TABLE categoria (
idcategoria INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
descricao VARCHAR(30) NOT NULL
);
INSERT INTO categoria (descricao) VALUES ("Ciências Exatas");
INSERT INTO categoria (descricao) VALUES ("Ciências Humanas");
CREATE TABLE curso (
idcurso INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nomecurso VARCHAR(30) NOT NULL,
descricaocurso VARCHAR(1000) NOT NULL,
categoriaid INT(6) UNSIGNED,
imagemcurso VARCHAR(50),
FOREIGN KEY (categoriaid) REFERENCES categoria(idcategoria) ON DELETE CASCADE
);
INSERT INTO curso (nomecurso,descricaocurso,categoriaid,imagemcurso) VALUES ("Matemática","História do curso de Matemática !",1,"");
CREATE TABLE usuario (
idusuario INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
login VARCHAR(50) NOT NULL,
nome VARCHAR(30) NOT NULL,
senha VARCHAR(50) NOT NULL
);
CREATE TABLE contatorecebido (
idcontato INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
remetente VARCHAR(50) NOT NULL,
assunto VARCHAR(30) NOT NULL,
texto VARCHAR(300),
data_envio DATETIME
);
