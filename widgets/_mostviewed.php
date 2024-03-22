<?php

/**
 * Total a ser exibido, por default '3'
 * Para alterar este valor, no código principal, defina $num_list antes de 
 * fazer o require() deste código.
 **/
$num_list = (isset($num_list)) ? intval($num_list) : 3;

// Obtém uma lista de artigos mais visualizados no site
$sql = <<<SQL

SELECT 
    art_id, art_thumbnail, art_title, art_summary
FROM article
ORDER BY art_views
LIMIT {$num_list};

SQL;

// Executa a query e armazena os resultados em '$res'
$res = $conn->query($sql);

// Variável acumuladora. Armazena cada um dos artigos.
$aside_viewed = '<h3>Artigos + vistos</h3><div class="viewed">';

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

<div class="aside" onclick="location.href = 'view.php?id={$mv['art_id']}'">
    <img src="{$mv['art_thumbnail']}" alt="{$mv['art_title']}">
    <div>
    <h5>{$mv['art_title']}</h5>
    <p><small title="{$mv['art_summary']}">{$art_summary}</small></p>
    </div>
</div>

HTML;
endwhile;

$aside_viewed .= '</div>';

// Envia para a view
echo $aside_viewed;

?>