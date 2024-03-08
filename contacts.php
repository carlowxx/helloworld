<?php

// Carrega configurações globais
require("_global.php");

/**
 * A super global $_POST[] recebe os dados de um formulário submetido pelo método POST.
 **/
// debug($_POST);

// Configurações desta página
$page = array(
    "title" => "Faça Contato",  // Título desta página
    "css" => "contacts.css",    // Folha de estilos desta página
    "js" => "contacts.js",      // JavaScript desta página
);

/**
 * Define as principais variáveis do script
 **/

// Values dos campos do formulário
$form = [
    'name' => '',
    'email' => '',
    'subject' => '',
    'message' => ''
];

// Mensagens de erro
$error = '';

/**
 * Variável de feedback
 *      $sended = false (default) → Formulário não submetido ou contém falhas de preenchimento
 *      $sended = true → Formulário foi subetido com sucesso. Exibe o feedback.
 **/
$sended = false;

// Se o formulário foi enviado
if (isset($_POST['send'])) :

    /*************************************************
     * Sanitiza e valida preenchimento do formulário *
     *************************************************/

    /**
     * Campo 'name' deve ter pelo menos 3 caracteres
     * Referências:
     *       https://www.w3schools.com/php/func_string_htmlspecialchars.asp
     *       https://www.w3schools.com/php/func_string_trim.asp
     **/
    $form['name'] = htmlspecialchars(trim($_POST['name']));
    if (strlen($form['name']) < 3)
        $error .= '<li>Seu nome deve ter pelo menos 3 letras.</li>';

    /**
     * Campo 'email' deve ser um e-mail válido
     * Referências:
     *      https://www.w3schools.com/php/func_filter_input.asp
     **/
    $form['email'] = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    if (!filter_var($form['email'], FILTER_VALIDATE_EMAIL))
        $error .= '<li>Seu endereço de e-mail está inválido.</li>';

    /**
     * Campo 'subject' deve ter pelo menos 4 caracteres
     **/
    $form['subject'] = htmlspecialchars(trim($_POST['subject']));
    if (strlen($form['subject']) < 4)
        $error .= '<li>O assunto deve ter pelo menos 4 caracteres.</li>';

    /**
     * Campo 'message' deve ter pelo menos 5 caracteres
     **/
    $form['message'] = htmlspecialchars(trim($_POST['message']));
    if (strlen($form['message']) < 5)
        $error .= '<li>A mensagem deve ter pelo menos 5 caracteres.</li>';

    //  Se NÃO ocorreram erros no preenchimento do formulário
    if ($error == '') :

        // Grava contato no banco de dados
        $sql = <<<SQL

INSERT INTO contact
    (ctt_name, ctt_email, ctt_subject, ctt_message)
VALUES
    (?, ?, ?, ?);

SQL;

        // Teste o SQL no PHPMyAdmin para ter certeza de que está ok
        // debug($sql, true);

        // Prepara o comando SQL para o banco de dados
        $stmt = $conn->prepare($sql);

        // Envia os dados para o banco
        $stmt->bind_param(
            "ssss", // Substitui os "?" do SQL por strings
            $form['name'], // Campos...
            $form['email'],
            $form['subject'],
            $form['message']
        );

        // Avisa ao banco de dados para executar a query
        $stmt->execute();

        // Confirma para o remetente que formulário foi enviado 
        header("Location: contactok.php?name={$form['name']}");

    // Se ocorreram erros no preenchimento do formulário
    else :

        // Monta feedback de erro para o remetente
        $error = <<<HTML
        
        <span id="closeme"><i class="fa-solid fa-xmark fa-fw"></i></span>
        <h4>Ooooops!</h4>
        <p>Ocorreram erros no preenchimento do formulário.
        <ul>{$error}</ul>
        <p>Por favor, revise o preenchimento e envie novamente.</p>                

HTML;

    endif;

endif;

// Inclui o cabeçalho do documento
require('_header.php');
?>

<article>

    <h2>Faça Contato</h2>

    <?php
        // Se ocorreram erros, exibe a caixa de mensagem
        if ($error != '')
            echo '<div id="error">' . $error . '</div>';
    ?>

        <form id="contact" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">

            <?php // Campo oculto para detectar se o formulário foi enviado 
            ?>
            <input type="hidden" name="send" value="">

            <p>Preencha todos os campos do formulário para enviar um contato para a equipe do <strong><?php echo $site['sitename'] ?></strong>.</p>
            <p class="center red"><small>Todos os campos são obrigatórios.</small></p>

            <p>
                <label for="name">Nome:</label>
                <input type="text" name="name" id="name" placeholder="Seu nome completo." value="<?php echo $form['name'] ?>" required minlength="3">
            </p>

            <p>
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" placeholder="usuario@provedor.com" value="<?php echo $form['email'] ?>" required>
            </p>

            <p>
                <label for="subject">Assunto:</label>
                <input type="text" name="subject" id="subject" placeholder="Sobre o que deseja escrever" value="<?php echo $form['subject'] ?>" required minlength="4">
            </p>

            <p>
                <label for="message">Mensagem:</label>
                <textarea name="message" id="message" placeholder="Escreva sua mensagem aqui" required minlength="5"><?php echo $form['message'] ?></textarea>
            </p>

            <p>
                <button type="submit">Enviar</button>
            </p>

        </form>

</article>

<aside>
    <?php require('_socialaside.php') ?>
</aside>

<?php
// Inclui o rodapé do documento
require('_footer.php');
?>