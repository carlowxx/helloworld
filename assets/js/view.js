// Referência dos elementos HTML
const commentBox = document.getElementById('commentBox');

// Monitora se houve mudanças na autenticação do usuário
firebase.auth().onAuthStateChanged((user) => {
    if (user) {
        // Se alguém se logou, faça isso:


    } else {
        // Se alguém deslogou, faça isso:
        commentBox.innerHTML = `<p><a href="login.php?ref=${location.href}#comment">Logue-se</a> para comentar.</p>`;
    }
});