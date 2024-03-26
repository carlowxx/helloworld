<?php

// Carrega configurações globais
require("_global.php");

// Configurações desta página
$page = array(
    "title" => "Perfil do Usuário",
    "css" => "profile.css",
    "js" => "profile.js"
);

// Atividade 4) Obtém o ID do usuário, da URL
$uid = isset($_GET['uid']) ? trim(htmlentities($_GET['uid'])) : '';

// Atividade 4) Inicializa a view dos comentários do usuário na <aside>
$user_comments = '<div class="aside_block"><h3>Seus comentários</h3>';

if ($uid != '') :

    // Query para obter os comentários
    $sql = <<<SQL

SELECT 
    cmt_content,
    art_id, art_title
FROM comment
    INNER JOIN article ON cmt_article = art_id
WHERE 
    -- Requisitos
    cmt_status = 'on'
    AND art_status = 'on'
    AND art_date <= NOW()
    AND cmt_social_id = ?
ORDER BY cmt_date DESC
LIMIT 5;

SQL;

    // Atividade 4) Prepara e executa o statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $uid);
    $stmt->execute();
    // Atividade 4) Obtém o resultado da consulta
    $res = $stmt->get_result();

    // Atividade 4) Total de registros
    $total = $res->num_rows;

    // Atividade 4) Se não tem registros:
    if ($total > 0) :

        while ($art = $res->fetch_assoc()) :

            $cmt_content = $art['cmt_content'];
            if (strlen($cmt_content) > 50) {
                $cmt_content = substr($cmt_content, 0, 47) . "...";
            }

            $user_comments .= <<<HTML

<div class="box" onclick="location.href='view.php?id={$art['art_id']}'">
    <h5>{$art['art_title']}</h5>
    <small title="{$art['cmt_content']}">{$cmt_content}</small>
</div>

HTML;

        endwhile;

        $user_comments .= "</div>";

    else :

        $user_comments .= <<<HTML

<p class="center">Você ainda não tem comentários. Acesse nossos <a href="index.php">artigos</a> e comente!</p>
        
HTML;

    endif;

else :

    $user_comments .= <<<HTML

<p class="center" id="linkToProfile"></p>

HTML;

endif;

// Inclui o cabeçalho do documento
require('_header.php');
?>

<article>

    <h2>Olá <span id="userName">usuário</span>!</h2>

    <div id="userCard"></div>

    <p>Sua conta é gerenciada pelo Google. Clique no botão abaixo para acessar seu perfil no Google.</p>

    <p class="center">
        <button type="button" id="btnGoogleProfile">
            <i class="fa-brands fa-google fa-fw"></i>
            Acessar perfil no Google
        </button>
    </p>

    <p>Clique no botão abaixo se quise sair do aplicativo.</p>

    <p class="center">
        <button type="button" id="btnLogout">
            <i class="fa-solid fa-right-from-bracket fa-fw"></i>
            Logout / Sair
        </button>
    </p>

</article>

<aside>
    <?php
    // Atividade 4) view dos comentários do usuário
    echo $user_comments;
    ?>
</aside>

<?php
// Inclui o rodapé do documento
require('_footer.php');
?>