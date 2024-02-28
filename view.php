<?php

// Carrega configurações globais
require("_global.php");

// Configurações desta página
$page = array(
    "title" => "Artigo Completo", // Título desta página
    "css" => "view.css",          // Folha de estilos desta página
    "js" => "view.js",            // JavaScript desta página
);

// Obter o ID do artigo e armazenar na variável 'id'
// Operador ternário
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Se o ID for inválido redireciona para a página 404.
// Referências: https://www.w3schools.com/php/func_network_header.asp
if($id < 1) header('Location: 404.php');

// Obtém o artigo do banco de dados
$sql = <<<SQL

SELECT

 	-- Obtém os campos de article necessários
 	art_id, art_title, art_content,
    
    -- Obtém a data formatada para o pseudo-campo art_datebr
    -- Referência: https://www.w3schools.com/sql/func_mysql_date_format.asp
    DATE_FORMAT(art_date, "%d/%m/%Y às %H:%i") AS art_datebr,
    
    -- Obtém os campos de employee necessários
    emp_id, emp_photo, emp_name, emp_type,
    
    -- Obtém a data formatada de cadastro do emplyee para o pseudo-campo emp_datebr
    DATE_FORMAT(emp_date, "%d/%m/%Y") AS emp_datebr,
    
    -- Obtém a idade do employee em anos
    -- Referências: https://www.w3schools.com/sql/func_mysql_timediff.asp
    TIMESTAMPDIFF(YEAR, emp_birth, CURDATE()) as emp_age 

-- Tabela original
FROM `article`

-- Faz a junção das tabelas 'article' e 'employee'
INNER JOIN `employee` ON art_author = emp_id

-- Regras para obter os dados
WHERE art_id = '{$id}'

	-- A data deve ser menor ou igual a agora
    -- Não obtém artigos agendados para o futuro
	AND art_date <= NOW()
    
    -- O artigo deve estar online
    AND art_status = 'on';

SQL;

// Executa o SQL
$res = $conn->query($sql);

// Se artigo não existe redireciona para a página 404.
if($res->num_rows == 0) header('Location: 404.php');

// Obtém o artigo e armazena em $art[]
$art = $res->fetch_assoc();

// Altera o título da página
$page['title'] = $art['art_title'];

// debug($art);

// Gera a view para o usuário
$article = <<<ART

<div class="article">
    <h2>{$art['art_title']}</h2>
    <small>Por {$art['emp_name']} em {$art['art_datebr']}.</small>
    <div>{$art['art_content']}</div>
</div>

ART;

// Inclui o cabeçalho do documento
require('_header.php');
?>

<article><?php echo $article ?></article>

<aside></aside>

<?php require('_footer.php') ?>
