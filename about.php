<?php

// Carrega configurações globais
require("_global.php");

// Configurações desta página
$page = array(
    "title" => "Lendo e Entendendo",
    "css" => "about.css"
);

// Inicializa a view de colaboradores
$employees = '';

// Obtém a lista de colaboradores do banco de dados
$sql = <<<SQL

SELECT 
	-- Campos necessários
    emp_id, emp_photo, emp_name, emp_type,
    -- Converte a data de cadastro
    DATE_FORMAT(emp_date, "%d/%m/%Y") AS emp_datebr,
    -- Obtém a idade
    TIMESTAMPDIFF(YEAR, emp_birth, CURDATE()) AS emp_age 
FROM employee
-- Requisitos
WHERE emp_status = 'on'
-- Ordena pelo mais antigo
ORDER BY emp_date;

SQL;
$res = $conn->query($sql);

if ($res->num_rows > 0) :

    $employees .= <<<HTML

        <h3>Colaboradores</h3>
        <p>No {$site['sitename']}, contamos com uma equipe dedicada de administradores, autores e moderadores apaixonados pelo mundo das plantas. Nossos administradores garantem o bom funcionamento do blog, enquanto nossos autores especializados trazem sua experiência e conhecimento para criar conteúdo informativo e inspirador. Nossos moderadores garantem que a comunidade se mantenha positiva e construtiva, proporcionando uma experiência enriquecedora para todos os nossos leitores e participantes.</p>
        <div class="emprow">

    HTML;

    while ($row = $res->fetch_assoc()) :

        switch ($row['emp_type']):
            case 'admin':
                $emp_type = 'administrador';
                break;
            case 'author':
                $emp_type = 'autor';
                break;
            case 'moderator':
                $emp_type = 'moderador';
                break;
            default:
                $emp_type = 'colaborador';
                break;
        endswitch;

        $employees .= <<<HTML

        <div class="empcol">
            <img src="{$row['emp_photo']}" alt="{$row['emp_name']}">
            <h3>{$row['emp_name']}</h3>
            <ul>
                <li>{$row['emp_age']} anos</li>
                <li>Colabora desde {$row['emp_datebr']} como {$emp_type}.</li>
            </ul>
        </div>

        HTML;

    endwhile;

    $employees .= '</div>';

endif;

// Inclui o cabeçalho do documento
require('_header.php');
?>

<article>

    <h2>Sobre o <?php echo $site['sitename'] ?></h2>
    <p><em>Bem-vindo ao <?php echo $site['sitename'] ?>, seu destino definitivo para tudo relacionado ao mundo verde!</em></p>
    <p>Nosso blog é dedicado a explorar o fascinante universo das plantas e árvores, desde ornamentais até variedades frutíferas e medicinais. Nosso objetivo é ser sua principal fonte de informações sobre como plantar, cuidar e colher essas maravilhas naturais. Seja você um jardineiro experiente ou iniciante, nosso propósito é fornecer insights valiosos, dicas e técnicas para ajudá-lo a cultivar um paraíso de jardim próspero. Junte-se a nós nesta jornada verde enquanto desvendamos os segredos da horticultura e revelamos a beleza e os benefícios da natureza."</p>

    <h3>Nossa missão</h3>
    <p>Com o <?php echo $site['sitename'] ?>, nossa missão é inspirar uma apreciação mais profunda pelas maravilhas botânicas que nos cercam. Através de conteúdo envolvente e conselhos práticos, buscamos capacitar as pessoas a se conectarem com a natureza de maneira significativa. Se você é apaixonado por paisagismo, está em busca de aprimorar suas aventuras culinárias com produtos cultivados em casa, ou está interessado em aproveitar as propriedades curativas das plantas medicinais, nosso blog oferece uma riqueza de informações para apoiar suas buscas relacionadas às plantas.</p>

    <h3>Participe</h3>
    <p>Junte-se à nossa comunidade de entusiastas do verde enquanto cultivamos conhecimento, fomentamos a criatividade e semeamos as bases de um futuro mais verde e sustentável juntos.</p>

    <?php echo $employees ?>

</article>

<aside>

    <h3>Veja +</h3>
    <ul>
        <li><a href="contacts.php">Faça contato conosco</a></li>
        <li><a href="about.php">Sobre o <?php echo $site['sitename'] ?></a></li>
    </ul>

    <?php
    // Mostra ícone de contatos na lista de redes sociais
    $show_contact = true;
    // Importa lista de redes sociais
    require('widgets/_socialaside.php');
    // Importa lista de artigos recentes
    require('widgets/_newest.php');
    ?>

</aside>

<?php
// Inclui o rodapé do documento
require('_footer.php');
?>