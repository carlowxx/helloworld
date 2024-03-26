<?php

// Carrega configurações globais
require("_global.php");

// Configurações desta página
$page = array(
    "title" => "Políticas de Privacidade"
);

// Inclui o cabeçalho do documento
require('_header.php');
?>

<article>

    <h2>Política de Privacidade de <?php echo $site['sitename'] ?></h2>
    <p><em>Esta Política de Privacidade descreve como o <?php echo $site['sitename'] ?> coleta, utiliza e protege as informações pessoais dos usuários que interagem com o nosso blog. Ao utilizar o HelloWord, você concorda com a coleta e uso de informações de acordo com esta política.</em></p>
    <h3>Informações Coletadas</h3>
    <p>Ao comentar em nosso blog, é necessário se logar utilizando a autenticação social do Google. Ao fazer isso, coletamos as seguintes informações do seu perfil do Google: Nome, Email e Foto de perfil. Essas informações são utilizadas exclusivamente para identificá-lo(a) como autor do comentário.</p>
    <h3>Uso das Informações</h3>
    <p>As informações coletadas são utilizadas apenas para identificar o autor dos comentários no nosso blog. Não compartilhamos essas informações com terceiros nem as utilizamos para qualquer finalidade além da identificação do autor do comentário.</p>
    <h3>Armazenamento de Dados</h3>
    <p>As informações coletadas são armazenadas de forma segura em nosso banco de dados. Não armazenamos nenhuma outra informação além do Nome, Email e Foto de perfil fornecidos pelo Google durante o processo de autenticação.</p>
    <h3>Segurança</h3>
    <p>O <?php echo $site['sitename'] ?> adota medidas de segurança para proteger as informações pessoais dos usuários contra acesso não autorizado, alteração, divulgação ou destruição não autorizada dos dados armazenados.</p>
    <h3>Alterações na Política de Privacidade</h3>
    <p>Esta Política de Privacidade pode ser atualizada periodicamente para refletir mudanças nas práticas de coleta, uso e proteção de informações. Recomendamos que os usuários revisem periodicamente esta página para se manterem informados sobre como estamos protegendo suas informações.</p>
    <h3>Contato</h3>
    <p>Se você tiver alguma dúvida ou preocupação sobre esta Política de Privacidade, entre em contato conosco através da <a href="contacts.php">página de contatos</a>.</p>
    <p><em>Última atualização: 21/03/2024.</em></p>

</article>

<aside>

    <h3>Veja +</h3>
    <ul>
        <li><a href="contacts.php">Faça contato</a></li>
        <li><a href="about.php">Sobre o <?php echo $site['sitename'] ?></a></li>
    </ul>

    <?php
    // Lista de redes sociais
    require('widgets/_socialaside.php');
    ?>

</aside>

<?php
// Inclui o rodapé do documento
require('_footer.php');
?>