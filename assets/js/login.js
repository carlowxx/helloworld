// Referência dos elementos HTML
const btnLogin = document.getElementById('btnLogin');
const loginError = document.getElementById('loginError');

// Monitora se houve mudanças na autenticação do usuário
firebase.auth().onAuthStateChanged((user) => {
    if (user) {
        // Se alguém se logou, faça isso...
        // Obtém o parâmetro do link da página
        var searchParams = new URLSearchParams(window.location.search);
        // Obtém o valor do parâmetro "ref"
        var refValue = searchParams.get('ref');
        // Redireciona para a página de origem
        location.href = refValue ? refValue : 'index.php';
    } else {
        // Se alguém deslogou, faça isso...
        // Monitorar cliques no botão de login
        btnLogin.addEventListener('click', login);
    }
});

// Função para fazer login
function login() {

    // Referência ao provedor de login
    const provider = new firebase.auth.GoogleAuthProvider();

    // Login do usuário na janela popup
    firebase.auth()
        .signInWithPopup(provider)
        .then((userData) => {
            // Se deu certo...
            // Obtém o parâmetro do link da página
            var searchParams = new URLSearchParams(window.location.search);
            // Obtém o valor do parâmetro "ref"
            var refValue = searchParams.get('ref');
            // Redireciona para a página de origem
            location.href = refValue ? refValue : 'index.php';
        })
        .catch((error) => {
            // Se algo der errado...
            // Exibe mensagem de alerta para o usuário
            loginError.innerHTML = "Oooops! Algo deu errado. Por favor, tente mais tarde.";
            loginError.style.display = 'block';
            // Exibe o erro técnico no console do JavaScript
            console.error(error);
        });

}