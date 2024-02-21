-- ------------------------------------------------- --
-- Cria o banco de dados da aplicação no MySQL.      --
-- Referências:                                      --
--  •  MySQL → https://www.w3schools.com/mysql       --
--  •  SQL ANSI → https://www.w3schools.com/sql      --
-- ------------------------------------------------- --
--      ATENÇÃO! DANGER! PERIGO! CUIDADO! OOOPS!     --
-- ------------------------------------------------- --
-- Este script só deve ser usado em desenvolvimento. --
-- Ele apaga o banco de dados e recria as estruturas --
-- do zero, apagando dados preexistentes.            --
-- Apague este arquivo no branch de produção.        --
-- ------------------------------------------------- --

-- Apaga o banco de dados caso ele exista.
DROP DATABASE IF EXISTS helloword;

-- Cria o banco de dados.
--     Seleciona o CHARSET UTF-8 para aramazenar caracteres do portugês.
--     Seleciona o COLLATE 'utf8mb4_general_ci' para fazer buscas case-insensitive.
CREATE DATABASE helloword CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Seleciona o banco de dados para criar as tabelas.
USE helloword;

-- Cria a tabela 'employee'.
CREATE TABLE employee (
    emp_id INT PRIMARY KEY AUTO_INCREMENT,
    emp_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    emp_photo VARCHAR(255),
    emp_name VARCHAR(127) NOT NULL,
    emp_birth DATE,
    emp_email VARCHAR(255) NOT NULL,
    emp_password VARCHAR(63) NOT NULL,
    emp_type ENUM('admin', 'author', 'moderator') DEFAULT 'moderator',
    emp_status ENUM('on', 'off', 'del') DEFAULT 'on'
);

-- Cria a tabela 'article'.
CREATE TABLE article (
    art_id INT PRIMARY KEY AUTO_INCREMENT,
    art_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    art_thumbnail VARCHAR(255),
    art_title VARCHAR(127),
    art_summary VARCHAR(255),
    art_author INT,
    art_content TEXT,
    art_views INT DEFAULT '0',
    art_status ENUM('on', 'off', 'del') DEFAULT 'on',
    FOREIGN KEY (art_author) REFERENCES employee(emp_id)
);

-- Cria a tabela 'comment'.
CREATE TABLE comment (
    cmt_id INT PRIMARY KEY AUTO_INCREMENT,
    cmt_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    cmt_article INT,
    cmt_social_id VARCHAR(255),
    cmt_social_name VARCHAR(255),
    cmt_social_photo VARCHAR(255),
    cmt_social_email VARCHAR(255),
    cmt_content TEXT,
    cmt_status ENUM('on', 'off', 'del') DEFAULT 'on',
    FOREIGN KEY (cmt_article) REFERENCES article(art_id)
);

-- Cria a tabela 'contact'.
CREATE TABLE contact (
    ctt_id INT PRIMARY KEY AUTO_INCREMENT,
    ctt_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ctt_name VARCHAR(255),
    ctt_email VARCHAR(255),
    ctt_subject VARCHAR(255),
    ctt_message TEXT,
    ctt_status ENUM('received', 'read', 'answered', 'deleted') DEFAULT 'received'
);

-- --------------------------------------------------------------- --
-- Insere alguns dados "fake" nas tabelas para os testes iniciais. --
-- Dizemos "popular tabela com dados".
-- --------------------------------------------------------------- --

-- Popular tabela 'employee'.
INSERT INTO employee (
    emp_id, emp_photo, emp_name, emp_birth, emp_email, emp_password, emp_type
) VALUES 
('1', 'https://randomuser.me/api/portraits/lego/5.jpg', 'Joca da Silva', '2000-01-29', 'joca@silva.com', SHA1('senha123'), 'admin'),
('2', 'https://randomuser.me/api/portraits/women/33.jpg', 'Marineuza Siriliano', '1984-09-20', 'mari@neuza.com', SHA1('senha123'), 'author'),
('3', 'https://randomuser.me/api/portraits/men/40.jpg', 'Setembrino Trocatapas', '1999-10-21', 'set@brino.com', SHA1('senha123'), 'moderator'),
('4', 'https://randomuser.me/api/portraits/men/41.jpg', 'Hermenildo Sirigildo', '2001-12-24', 'herme@gildo.com', SHA1('senha123'), 'author');

-- Popular tabela 'article'.
INSERT INTO article
    (
        art_id, art_author, 
        art_thumbnail,
        art_title, 
        art_summary, 
        art_content
    )
VALUES
    (
        '1', '2', 
        'https://picsum.photos/200',
        'Figueira donde nascem figos',
        'Conheça e saiba cuida de figueira e comer frutos deliciosos.',
        '
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga ab, excepturi, ullam veniam perspiciatis officiis nostrum libero rerum ipsum minima tempore quisquam accusamus officia magni ea accusantium cumque reiciendis molestias.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate placeat obcaecati harum doloribus perferendis mollitia autem, sapiente fuga itaque officiis molestias libero ea, delectus vero error? Amet deserunt eum vero.</p>
            <figure>
            <img src="https://picsum.photos/300/200" alt="Imagem qualquer">    
            <figcaption>Imagem aleatória.</figcaption>                    
            </figure>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iusto nulla cum voluptate sed debitis minima consequuntur sint earum iste nam corporis aperiam dolorum temporibus itaque, corrupti velit architecto? Modi, quam!</p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsum quia distinctio iusto exercitationem qui accusantium ex ullam, excepturi illo quisquam beatae, nisi ad earum reprehenderit, maiores asperiores fuga nulla accusamus.</p>
        '
    ), (
        '2', '4',
        'https://picsum.photos/201',
        'Roseiras que espetam os dedos',
        'Como lidar com a colheita das rosas sem sangrar.',
        '
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga ab, excepturi, ullam veniam perspiciatis officiis nostrum libero rerum ipsum minima tempore quisquam accusamus officia magni ea accusantium cumque reiciendis molestias.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate placeat obcaecati harum doloribus perferendis mollitia autem, sapiente fuga itaque officiis molestias libero ea, delectus vero error? Amet deserunt eum vero.</p>
            <figure>
            <img src="https://picsum.photos/300/200" alt="Imagem qualquer">    
            <figcaption>Imagem aleatória.</figcaption>                    
            </figure>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iusto nulla cum voluptate sed debitis minima consequuntur sint earum iste nam corporis aperiam dolorum temporibus itaque, corrupti velit architecto? Modi, quam!</p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsum quia distinctio iusto exercitationem qui accusantium ex ullam, excepturi illo quisquam beatae, nisi ad earum reprehenderit, maiores asperiores fuga nulla accusamus.</p>
        '
    ), (
        '3', '2',
        'https://picsum.photos/202',
        'Plantinhas na varanda',
        'Cuide bem das plantinhas da varanda neste verão.',
        '
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga ab, excepturi, ullam veniam perspiciatis officiis nostrum libero rerum ipsum minima tempore quisquam accusamus officia magni ea accusantium cumque reiciendis molestias.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate placeat obcaecati harum doloribus perferendis mollitia autem, sapiente fuga itaque officiis molestias libero ea, delectus vero error? Amet deserunt eum vero.</p>
            <figure>
            <img src="https://picsum.photos/300/200" alt="Imagem qualquer">    
            <figcaption>Imagem aleatória.</figcaption>                    
            </figure>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iusto nulla cum voluptate sed debitis minima consequuntur sint earum iste nam corporis aperiam dolorum temporibus itaque, corrupti velit architecto? Modi, quam!</p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsum quia distinctio iusto exercitationem qui accusantium ex ullam, excepturi illo quisquam beatae, nisi ad earum reprehenderit, maiores asperiores fuga nulla accusamus.</p>
        '
    );

-- Popular tabela 'comment'.
INSERT INTO comment 
(
    cmt_article,
    cmt_social_id,
    cmt_social_name,
    cmt_social_photo,
    cmt_social_email,
    cmt_content
) VALUES
(
    '1', 
    'abc123',
    'Mariah do Bairro', 
    'https://randomuser.me/api/portraits/women/40.jpg',
    'mariahbairro@gmail.com',
    'Não gosto de Figos. Eles tem caroços.'
), (
    '2', 
    'def456',
    'Esmeraldino', 
    'https://randomuser.me/api/portraits/lego/7.jpg',
    'esmeraldo@dino.com',
    'Prefiro os cravos às rosas. Pelo menos eles não tem espinhos.'
), (
    '1', 
    'ghi890',
    'Pedro Pedroso', 
    'https://randomuser.me/api/portraits/men/87.jpg',
    'pedro@pedroso.com',
    'Fogos são gostosos somente no Natal.'
);

-- Popular tabela 'contact'.
