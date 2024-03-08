// Obtém elementos para interação
const btnClose = document.getElementById('closeme');
const frmError = document.getElementById('error');

// Só executa as ações quando o elemento existe no documento
if (document.body.contains(frmError)) {

    // Monitora cliques em 'btnClose'
    btnClose.addEventListener('click', closeMe);

    // Timer para fechar em 'seconds' segundos
    // Se não quise usar, comente as linhas
    const seconds = 5;
    // setTimeout(closeMe, seconds * 1000);
}

// Função que fecha a caixa de erro
function closeMe() {
    frmError.style.display = 'none';
}
