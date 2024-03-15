// Obtém elementos para interação
const btnClose = document.getElementById('closeme');
const frmError = document.getElementById('error');
const formFieldName = document.getElementById('name');
const formFieldEmail = document.getElementById('email');

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

// Monitora se houve mudanças na autenticação do usuário
firebase.auth().onAuthStateChanged((user) => {
    if (user) {
        // Se alguém se logou, preenche os campos com os dados do usuário
        formFieldName.value = user.displayName;
        formFieldEmail.value = user.email;
    }
});