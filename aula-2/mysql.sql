CREATE TABLE usuarios (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
  nome VARCHAR(100) NOT NULL,
  data_nascimento DATETIME NOT NULL,
  peso FLOAT(10,2) NOT NULL,
  data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE noticias (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
  titulo VARCHAR(100) NOT NULL,
  texto LONGTEXT NOT NULL,
  data_publicacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  id_usuario INT UNSIGNED
);

INSERT INTO noticias (titulo, texto, id_usuario)
VALUES ('Noticia 1', 'Texto da noticia 1', 1),
       ('Noticia 2', 'Texto da noticia 2', 1),
       ('Noticia 3', 'Texto da noticia 3', 3);

ALTER TABLE usuarios ADD email VARCHAR(100)
   NOT NULL UNIQUE; 

INSERT INTO usuarios (nome, data_nascimento,
                      peso, email)
VALUES ('Eduardo', '1992-01-16 13:11:00',
        79.3, 'eduardo@test1.com');

INSERT INTO usuarios (email, nome, data_nascimento,
                      peso)
VALUES ('edu@test1.com', 'Mario',
        '1995-01-16 13:11:00', 79.3),
       ('maria@test.com', 'Maria',
        '1987-01-16 13:11:00', 50.3);

-- ALTER TABLE usuarios DROP COLUMN email;
ALTER TABLE usuarios CHANGE data_nascimento
  nascimento DATETIME NOT NULL;

CREATE INDEX email_idx ON usuarios (email); 
DROP INDEX email_idx ON usuarios;

-- Consultas

-- SELECT * FROM usuarios
-- WHERE email  = 'edu@test.com';

-- SELECT * FROM usuarios
-- WHERE
-- nascimento > '1990-01-01 00:00:00';

-- SELECT
-- DATE_FORMAT(nascimento, '%e/%m/%y') AS nascimento
-- FROM usuarios
-- WHERE
-- DATE_FORMAT(nascimento, '%y') > '90';

-- SELECT email FROM usuarios
-- WHERE email LIKE '%test%';

-- SELECT * FROM usuarios
-- WHERE nascimento LIKE '1992-%';

-- SELECT * FROM usuarios
-- WHERE email != 'maria@test.com';

-- SELECT * FROM usuarios
-- WHERE email NOT LIKE '%@test1%';

-- SELECT * FROM usuarios
-- WHERE (nome = 'Eduardo' OR nome = 'Mario')
-- AND nascimento LIKE '1990%' ;

-- SELECT * FROM usuarios
-- WHERE LOWER(nome) = LOWER('eduardo')

-- SELECT * FROM usuarios
-- WHERE nome IS NOT NULL;

-- SELECT * FROM usuarios
-- WHERE nome IN('Eduardo', 'Mario');

-- SELECT * FROM usuarios
-- WHERE nome IN('Eduardo', 'Mario')
-- ORDER BY nome DESC, peso ASC
-- LIMIT 10;

-- SELECT * FROM usuarios
-- LIMIT 2 OFFSET 1;
-- -- LIMIT 1, 2;

-- SELECT ROUND(peso, 2) AS peso, COUNT(*) FROM usuarios
-- GROUP BY ROUND(peso, 2)
-- ORDER BY peso DESC;

-- SELECT SUM(peso) FROM usuarios;


-- SELECT ROUND(peso, 2) AS peso, COUNT(*) FROM usuarios
-- GROUP BY ROUND(peso, 2)
-- HAVING peso > 60
-- ORDER BY peso DESC;

-- SELECT n.titulo, n.texto, u.nome
-- FROM noticias n, usuarios u
-- WHERE n.id_usuario = u.id;

-- SELECT n.titulo, n.texto, u.nome
-- FROM noticias n
-- INNER JOIN usuarios u ON n.id_usuario = u.id;

SELECT nome, COUNT(*)
FROM usuarios, noticias
WHERE usuarios.id = noticias.id_usuario
GROUP BY nome


