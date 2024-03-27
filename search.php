<?php

// Carrega configurações globais
require("_global.php");

// Configurações desta página
$page = array(
    "title" => "Procurando...",
    "css" => "index.css"
);

// inicializa a view
$search_view = '';

// Incializa vatiável com total de comentários
$total = 0;

// Obtém o termo de busca da URL
$query = isset($_GET['q']) ? trim(htmlentities(strip_tags($_GET['q']))) : '';

// Se a query NÃO está vazia
if ($query != '') :

    // Incializa variável da view
    $search_view .= "<h2>Procurando por '{$query}'</h2>";

    // Altera <title>
    $page['title'] = "Procurando por '{$query}'";

    // Consulta SQL usa prepared statement
    $sql = <<<SQL

-- Referências: https://www.w3schools.com/mysql/mysql_like.asp

SELECT 
	art_id 
FROM article 
WHERE
	-- Requisitos padrão
    art_date <= NOW()
    AND art_status = 'on'
    -- Busca
    AND art_title LIKE ?
    OR art_summary LIKE ?
    OR art_content LIKE ?
ORDER BY art_date DESC;

SQL;

    // Prepara a query de busca
    $search_query = "%{$query}%";

    // Prepara e executa o statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        'sss',
        $search_query,
        $search_query,
        $search_query
    );
    $stmt->execute();

    // Obtém o resultado da consulta
    $res = $stmt->get_result();

    // Total de registros
    $total = $res->num_rows;

    // Se vieram registros:
    if ($total > 0) :

        // Processa o total de resultados
        if ($total == 1) $viewtotal = '1 resultato';
        else $viewtotal = "{$total} resultados";

        $search_view .= "<p><small class=\"authordate\">{$viewtotal}</small></p>";

        while ($art = $res->fetch_assoc())
            $search_view .= view_article($art['art_id']);

    // Se não achou nada:
    else :
        $search_view .= "<p class=\"center\">Nenhum conteúdo encontrado com '{$query}'.</p>";
    endif;

else :
//É o acumulador
    $search_view .= <<<HTML

<h2>Procurando...</h2>
<p class="center">Digite algo no campo de busca!</p>

HTML;

endif;

// Inclui o cabeçalho do documento
require('_header.php');
?>

<article>
    <?php
    // Exibe a view
    echo $search_view;
    ?>
</article>

<aside>
    <?php
    // Mostra os artigos mais visualizados
    require('widgets/_mostviewed.php');
    // Caso a busca retorne mais que 4 itens, exibe artigos mais comentados.
    if ($total > 4)
        require('widgets/_mostcommented.php');
    ?>
</aside>

<?php
// Inclui o rodapé do documento
require('_footer.php');
?>