CREATE DATABASE monsters DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
GRANT ALL PRIVILEGES ON monsters.* TO 'monsters'@'localhost' IDENTIFIED BY 'university' WITH GRANT OPTION;
use monsters;
CREATE TABLE categoria (
idcategoria INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
descricao VARCHAR(30) NOT NULL
);
CREATE TABLE curso (
idcurso INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nomecurso VARCHAR(30) NOT NULL,
descricaocurso BLOB,
categoriaid INT(6) UNSIGNED,
imagemcurso VARCHAR(50),
FOREIGN KEY (categoriaid) REFERENCES categoria(idcategoria) ON DELETE CASCADE
);
CREATE TABLE usuario (
idusuario INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
login VARCHAR(50) NOT NULL,
nome VARCHAR(30) NOT NULL,
senha VARCHAR(50) NOT NULL
);
INSERT INTO usuario (login,nome,senha) VALUES ("ersan@ersan.com.br","Ersan Holstein","8cb2237d0679ca88db6464eac60da96345513964");
CREATE TABLE contatorecebido (
idcontato INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
remetente VARCHAR(50) NOT NULL,
assunto VARCHAR(30) NOT NULL,
texto VARCHAR(300),
data_envio DATETIME
);
