<?php

// Carrega configurações globais
require("_global.php");

// debug($_POST);

// Configurações desta página
$page = array(
    "title" => "Faça Contato",  // Título desta página
    "css" => "contacts.css",    // Folha de estilos desta página
    "js" => "contacts.js",      // JavaScript desta página
);

// Variável de feedback
$sended = false;

// Se o formulário foi enviado
if (isset($_POST['send'])) :

    // Grava contato no banco de dados
    $sql = <<<SQL

INSERT INTO contact
(`ctt_name`, `ctt_email`, `ctt_subject`, `ctt_message`)
VALUES
('{$_POST['name']}', '{$_POST['email']}', '{$_POST['subject']}', '{$_POST['message']}');

SQL;

    // debug($sql, true);

    // Envia para o banco de dados
    $conn->query($sql);

    // Formulário enviado
    $sended = true;

endif;

// Inclui o cabeçalho do documento
require('_header.php');
?>

<article>

    <h2>Faça Contato</h2>

    <?php if ($sended) : ?>

        <?php
        // Extrai somente o primeiro nome do remetente
        $allnames = explode(" ", $_POST['name']);
        $firstname = $allnames[0];
        ?>

        <h3>Olá <?php echo $firstname ?>!</h3>
        <p>Seu contato foi enviado com sucesso.</p>
        <p><em>Obrigado...</em></p>
        <p class="center">
            <button onclick="location.href='contacts.php'" type="button">Enviar outro contato</button>
        </p>

    <?php else : ?>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">

            <?php // Campo oculto para detectar se o form foi enviado 
            ?>
            <input type="hidden" name="send" value="">

            <p>Preencha todos os campos do formulário para enviar um contato para a equipe do <strong><?php echo $site['sitename'] ?></strong>.</p>
            <p class="center red"><small>Todos os campos são obrigatórios.</small></p>

            <p>
                <label for="name">Nome:</label>
                <input type="text" name="name" id="name" placeholder="Seu nome completo." value="Joca da Silva">
            </p>

            <p>
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" placeholder="usuario@provedor.com" value="joca@silva.com">
            </p>

            <p>
                <label for="subject">Assunto:</label>
                <input type="text" name="subject" id="subject" placeholder="Sobre o que deseja escrever" value="Assunto de teste">
            </p>

            <p>
                <label for="message">Mensagem:</label>
                <textarea name="message" id="message" placeholder="Escreva sua mensagem aqui">Mensagem de teste</textarea>
            </p>

            <p>
                <button type="submit">Enviar</button>
            </p>

        </form>

    <?php endif ?>

</article>

<aside></aside>

<?php
// Inclui o rodapé do documento
require('_footer.php');
?>