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
    art_id, art_title, art_summary, art_views
FROM article
WHERE 
    art_status = 'on'
    AND art_date <= NOW()
ORDER BY art_views DESC
LIMIT {$num_list};

SQL;

// Executa a query e armazena os resultados em '$res'
$res = $conn->query($sql);

// Variável acumuladora. Armazena cada um dos artigos.
$aside_viewed = '
    <div class="aside_block">
        <h3>Artigos + vistos</h3>
';

// Loop para obter cada registro
while ($mv = $res->fetch_assoc()) :

    // Contador de visualizações
    if (intval($mv['art_views']) == 0) $art_views = "Nenhuma visualização";
    elseif ($mv['art_views'] == 1) $art_views = "1 visualização";
    else $art_views = "{$mv['art_views']} visualizações";

    $aside_viewed .= aside_box([
        
        'href' => "view.php?id={$mv['art_id']}",
        'title' => $mv['art_title'],
        'body' => $mv['art_summary'],
        'footer' => $art_views
    ]);

endwhile;

$aside_viewed .= '</div>';

// Envia para a view
echo $aside_viewed;

