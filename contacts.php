<?php

// Carrega configurações globais
require("_global.php");

// Configurações desta página
$page = array(
    "title" => "Faça Contato",  // Título desta página
    "css" => "contacts.css",    // Folha de estilos desta página
    "js" => "contacts.js",      // JavaScript desta página
);

// Inclui o cabeçalho do documento
require('_header.php');
?>

<article>

<h2>Faça Contato</h2>
<p>Preencha todos os campos do formulário para enviar um contato para a equipe do <strong><?php echo $site['sitename'] ?></strong>.</p>
<p class="center red"><small>Todos os campos são obrigatórios.</small></p>

<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">

</form>
</article>

<aside></aside>

<?php
// Inclui o rodapé do documento
require('_footer.php');
?>