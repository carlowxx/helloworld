<?php
// Testa se solicitou a inclusão dos arquivos ".css" e ".js"
$_css = $_js = '';
if (isset($page['css'])) 
    $_css = '<link rel="stylesheet" href="assets/css/' . $page["css"] . '">' . "\n";

    if(isset($page['js']))
    $_js = '<script src="assets/js/' . $page["js"] . '"></script>';

?>
<!DOCTYPE html>
<html lang="pt-Br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/global.css">
    <?php
    // Link da folha de estilos da página atual gerado dinâmicamente 
    echo $_css;
    ?>
    <link rel="shortcut icon" href="assets/img/<?php echo $site["logo"] ?>" >
    <title> Hypo - <?php echo $page["title"]?></title>
    
</head>

<body>
    <div id="wrap">


    <header>
        <div class="header-title-logo">
            <a href="index.php">
            <img class ="logotipo" src="assets/img/<?php echo $site["logo"] ?>" alt="Logotipo de Hello Word">
            </a>

            <div class="header-tittle">
                
                <h1><?php echo $site["title"] ?></h1>
                

                <small><?php echo $site["slogan"] ?></small>

            </div>
        </div>
        <div class="header-search">
            <form action="" method="get">
                <input type="search" name="q" id="search" placeholder="Pesquisar...">
                <button class="search" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
    </header>

    <nav>
        <a href="index.php" title="Página Inicial">
            <i class="fa-solid fa-house fa-fw"></i>
            <span>Inicio</span>
        </a>

        <a href="contacts.php" title="Fale Conosco">
            <i class="fa-regular fa-comment-dots fa-fw"></i>
            <span>Contatos</span>

        </a>

        <a href="about.php" title="Sobre Nós">
            <i class="fa-solid fa-info fa-fw"></i>
            <span>Sobre</span>
        </a>

        <a id="userAccess" href="login.php" title="Logue-se">
        <img id="userImg" src="assets/img/logo01.png" alt="Login de usuário" referrerpolicy="no-referrer"> 
                <i id="userIcon" class="fa-solid fa-right-to-bracket fa-fw"></i>
                <span id="userLabel">Entrar</span>
            </a>


    </nav>

    <main>