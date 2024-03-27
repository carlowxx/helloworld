<?php

/**
 * Total a ser exibido, por default '3'
 * Para alterar este valor, no código principal, defina $num_list antes de 
 * fazer o require() deste código.
 **/
$num_list = (isset($num_list)) ? intval($num_list) : 3;

$output = '';

$sql = <<<SQL

SELECT
	art_id, art_title, art_summary, art_views
FROM article
WHERE
	art_status = 'on'
    AND art_date <= NOW()
ORDER BY art_date DESC
LIMIT {$num_list};

SQL;
$res = $conn->query($sql);

if ($res->num_rows > 0) :

    $output .= '
        <div class="aside_block">
            <h3>Novos artigos</h3>
    ';

    while ($art = $res->fetch_assoc()) :

        // Contador de visualizações
        if (intval($art['art_views']) == 0) $art_views = "Nenhuma visualização";
        elseif ($art['art_views'] == 1) $art_views = "1 visualização";
        else $art_views = "{$art['art_views']} visualizações";

        $box_options = [
            'href' => "view.php?id={$art['art_id']}",
            'title' => $art['art_title'],
            'body' => $art['art_summary'],
            'footer' => $art_views,
            // 'echo' => true,
            // 'limit' => 20
        ];

        $output .= aside_box($box_options);

    endwhile;

    $output .= '</div>';

endif;

echo $output;
