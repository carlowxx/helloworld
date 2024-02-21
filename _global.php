<?php

/**
 * _config.php
 * 
 * Este é o arquivo de configuração inicial das páginas do aplicativo.
 * Este arquivo deve ser incluído nas páginas antes de quaisquer outros códigos PHP.
 * Antes de transferir este aplicativo para um provedor, as configurações abaixo
 * devem ser revisadas e atualizadas conforme as configurações do provedor.
 * 
 * IMPORTANTE!
 * Este arquivo tem dados sensíveis como crdenciais de usuários e senhas, inclusive
 * do banco de dados, portanto, deve ser tratado com muito cuidado.
 **/

/*
    Define a tabela de caracteres para UTF-8
    Evita problemas de acentuação
*/
header("Content-type: text/html; charset=utf-8");

// Configurações globais do site
$site = [
    "sitename" => "Olá Mundo",              // Usado na tag <title>
    "title" => "Olá Mundo",                 // Usado na tag <header>
    "slogan" => "De volta às fronteiras",   // Usado na tag <header>
    "logo" => "logo01.png",                 // Usado na tag <header>

    // Dados de conexão com o MySQL:
    "mysql_hostname" => "localhost",        // Servidor do banco de dados MySQL
    "mysql_username" => "root",             // Nome do usuário do MySQL para o app
    "mysql_password" => "",                 // Senha do usuário do MySQL para o app
    "mysql_database" => "helloword"         // Nome do banco de dados do MySQL para o app
];

/*
    Conexão com o MySQL usando a biblioteca MySQLi.
    Referências: https://www.w3schools.com/php/php_mysql_connect.asp
*/
$conn = new mysqli(
    $site["mysql_hostname"],    // Servidor do banco de dados MySQL
    $site["mysql_username"],    // Nome do usuário do MySQL para o app
    $site["mysql_password"],    // Senha do usuário do MySQL para o app
    $site["mysql_database"]     // Nome do banco de dados do MySQL para o app
);

// Trata erros de conexão com o banco de dados
if ($conn->connect_error)
    die("Falha de conexão com o banco e dados: " . $conn->connect_error);

// Seta transações com MySQL/MariaDB para UTF-8
$conn->query("SET NAMES 'utf8'");
$conn->query('SET character_set_connection=utf8');
$conn->query('SET character_set_client=utf8');
$conn->query('SET character_set_results=utf8');

// Seta dias da semana e meses do MySQL/MariaDB para "português do Brasil"
$conn->query('SET GLOBAL lc_time_names = pt_BR');
$conn->query('SET lc_time_names = pt_BR');

/*********************************
 * Funções globais do aplicativo *
 *********************************/

// Função para debug
// Referências: https://www.w3schools.com/tags/tag_pre.asp
function debug($target, $exit = false)
{
    echo "<pre>";
    print_r($target);
    echo "</pre>";
    // var_dump($target);
    if ($exit) exit();
}

// Debug de $site
// debug($site);

// Debug de $conn
// debug($conn, true);

// Consulta de teste
$sql = 'SELECT art_id, art_thumbnail, art_title, art_summary FROM article;';
$res = $conn->query($sql);
debug($res);

if ($res->num_rows > 0) {
    echo 'achei algo';

    // Iterar dados da variável
    while ($article = $res->fetch_assoc()) {

        debug($article);
        
        // PHP HereDoc
        // Interpolar → Escreve uma variável dentro de uma string
        echo <<<output
        
        <div>
        <img src="{$article['art_thumbnail']}" alt="{$article['art_title']}">
        <h4>{$article['art_title']}</h4>
        <p>{$article['art_summary']}</p>
        <p><a href="view.php?id={$article['art_id']}">Ver artigo completo</a></p>
        </div>
        
        output;

    }
} else {
    echo 'Nenhum artigo cadastrado!';
}

exit();