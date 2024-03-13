<?php

// Carrega configurações globais
require("_global.php");

// Configurações desta página
$page = array(
    "title" => "Login / Entrar",
    "css" => "login.css",
    "js" => "login.js"
);

// Inclui o cabeçalho do documento
require('_header.php');
?>

<article>
    <h2>Login / Entrar</h2>
    <p>Logue-se para ter acesso aos recursos restritos do site.</p>
    <p>Use sua conta Google / Gmail.</p>
    <p class="center">
        <button type="button" id="btnLogin">
            <i class="fa-brands fa-google fa-fw"></i>
            &nbsp; 
            Logue-se com o Google
        </button>
    </p>
</article>

<aside></aside>

<?php
// Inclui o rodapé do documento
require('_footer.php');
?>