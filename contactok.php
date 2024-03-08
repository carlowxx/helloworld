<?php

// Carrega configurações globais
require("_global.php");

// Configurações desta página
$page = array(
    "title" => "Faça Contato",  // Título desta página
    "css" => "contacts.css",    // Folha de estilos desta página
    "js" => "contacts.js",      // JavaScript desta página
);

// Captura o nome do remetente
$name = isset($_GET['name'])? "Olá " . trim($_GET['name']) . "!": "Olá!";

// Desvia para a 404 se a requisição estiver incorreta
// if (!isset($_GET['name'])) header('Location: 404.php');

// Inclui o cabeçalho do documento
require('_header.php');
?>

<article>

        <h3><?php echo $name ?></h3>
        <p>Seu contato foi enviado com sucesso.</p>
        <p><em>Obrigado...</em></p>
        <p class="center">
            <button onclick="location.href='contacts.php'" type="button">Enviar outro contato</button>
        </p>

</article>

<aside></aside>

<?php
// Inclui o rodapé do documento
require('_footer.php');
?>