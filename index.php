<?php

// Carrega configurações globais
require("_global.php");

// Configurações desta página
$page = array(
    "title" => $site['slogan'],      // Título desta página
    "css" => "index.css",            // Folha de estilos desta página
    "js" => "index.js",              // JavaScript desta página
);

/**
 * Listar os artigos do banco de dados
 * Regras / parâmetros:
 *  • Ordenados pela data de publicação com os mais recentes primeiro
 *  • Obter somente artigos no passado e presente
 *      • Não obter artigos agendados para o futuro
 *  • Obter somente artigos com status = 'on'
 *  • Obter os campos id, thumbnail, title, summary
 **/
$sql = <<<SQL

SELECT
-- Obter os campos id, thumbnail, title, summary
	art_id, art_date, art_thumbnail, art_title, art_summary
FROM article

-- Obter somente artigos no passado e presente
-- Não obter artigos agendados para o futuro
	WHERE art_date <= NOW()	  	
        
-- Obter somente artigos com status = 'on'
		AND art_status = 'on'        	

-- Ordenados pela data de publicação com os mais recentes primeiro
	ORDER BY art_date DESC;

SQL;

//  Executa o SQL e armazena os resultados em $res
$res = $conn->query($sql);

// Conta os registros e armazena em $total
$total = $res->num_rows;

// Variável que contém a lista de artigos em HTML
$articles = "";

// Se não tem artigos, exibe um aviso
if ($total == 0) :
    $articles = "<p>Não achei nada!</p>";
else :

    // Loop para obter cada artigo
    while ($art = $res->fetch_assoc()) :

        $articles .= <<<HTML

<div class="article" onclick="location.href = 'view.php?id={$art['art_id']}'">
    <img src="{$art['art_thumbnail']}" alt="{$art['art_title']}">
    <div>
        <h4>{$art['art_title']}</h4>
        <p>{$art['art_summary']}</p>
    </div>
</div>

HTML;

    endwhile;

endif;

// debug($articles, true); 
// exit();

// Obtém artigos mais visualizados
$sql = <<<SQL

SELECT art_id, art_thumbnail, art_title, art_summary
FROM article
ORDER BY art_views
LIMIT 3;

SQL;

// Executa a query e armazena os resultados em '$res'
$res = $conn->query($sql);

// Variável acumuladora. Armazena cada um dos artigos.
$aside_viewed = '<div class="viewed">';

// Loop para obter cada registro
while ($mv = $res->fetch_assoc()) :

    // Cria uma variável '$art_summary' para o resumo
    $art_summary = $mv['art_summary'];

    // Se o resumo tem mais de X caracteres
    // Referências: https://www.w3schools.com/php/func_string_strlen.asp
    if (strlen($mv['art_summary']) > $site['summary_length'])

        // Corta o resumo para a quantidade de caracteres correta
        // Referências: https://www.php.net/mb_substr
        $art_summary = mb_substr(
            $mv['art_summary'],         // String completa, a ser cortada
            0,                          // Posição do primeiro caracter do corte
            $site['summary_length']     // Tamanho do corte
        ) . "...";                      // Concatena reticências no final

    // Monta a view HTML
    $aside_viewed .= <<<HTML

<div onclick="location.href = 'view.php?id={$mv['art_id']}'">
    <img src="{$mv['art_thumbnail']}" alt="{$mv['art_title']}">
    <div>
    <h4>{$mv['art_title']}</h4>
    <p title="{$mv['art_summary']}">{$art_summary}</p>
    </div>
</div>

HTML;
endwhile;

$aside_viewed .= '</div>';

// Inclui o cabeçalho do documento
require('_header.php');
?>

<article>

    <h2><?php echo $total ?> artigos mais recentes</h2>
    <?php echo $articles ?>

</article>

<aside>
    <h3>Artigos + vistos</h3>
    <?php echo $aside_viewed ?>
    
</aside>

<?php require('_footer.php') ?>