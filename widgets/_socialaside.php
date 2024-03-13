<?php

/**
 * Exibe uma lista de ícones de redes sociais
 * A lista está cadastrada em $site['social_list'] no arquivo
 * de configuração global (_global.php).
 * As folhas de estilo estão em 'assets/css/global.css'.
 **/

$aside_social = <<<HTML

<h3>+ Contatos</h3>
<p>Você também pode entrar em contato ou saber mais pelas nossas redes sociais:</p>
<div class="social-side">

HTML;

foreach ($site['social_list'] as $item) {

    $aside_social .= <<<HTML
    
    <a class="col" href="{$item['link']}" target="_blank" title="{$item['name']}">
        <i class="{$item['icon']}" style="color: {$item['color']}"></i>
    </a>

HTML;
}

$aside_social .= '</div>';

echo $aside_social;