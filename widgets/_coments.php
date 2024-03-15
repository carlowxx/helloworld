<?php

echo '<h2 id="comment">Comentários</h2><div id="commentBox">BISCOITO</div>';

// Query que recebe todos os comentários do artigo atual
$sql = <<<SQL

SELECT 
cmt_id, cmt_social_name, cmt_social_photo, cmt_content,
DATE_FORMAT(cmt_date, "%d/%m/%Y às %H:%i") AS cmt_datebr
FROM comment
WHERE
	cmt_article = '{$id}'
    AND cmt_status = 'on'
ORDER BY cmt_date DESC;

SQL;

// Executar
$res = $conn->query($sql);

// Conta o número de comentários
$cmt_total = $res->num_rows;

// Conforme o número de comentários.
if ($cmt_total == 0)
    $view_total =  '<h5>Nenhum comentário</h5><p class="center">Seja o(a) primeiro(a) a comentar.</p>';
elseif ($cmt_total == 1)
    $view_total =  '<h5>1 comentário</h5>';
else
    $view_total =  "<h5>{$cmt_total} comentários</h5>";

// Exibe o total de comentários
echo $view_total;

if ($cmt_total > 0) :

    // Loop para iterar os comentários
    while ($cmt = $res->fetch_assoc()) :

        // Sanitiza comentário antes de exibir
        $cmt_content = htmlspecialchars(trim($cmt['cmt_content']));

        echo <<<HTML

<div class="cmt_box">
    <div class="cmt_header">
        <img src="{$cmt['cmt_social_photo']}" alt="{$cmt['cmt_social_name']}" referrerpolicy="no-referrer">
        <small>Por {$cmt['cmt_social_name']} em {$cmt['cmt_datebr']}.</small>
    </div>
    <div class="cmt_body">{$cmt_content}</div>
</div>

HTML;

    endwhile;

endif;
