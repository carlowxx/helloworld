// Referência dos elementos HTML
const commentBox = document.getElementById('commentBox');

// Monitora se houve mudanças na autenticação do usuário
firebase.auth().onAuthStateChanged((user) => {
    if (user) {
        // Se alguém se logou, faça isso:
        showCommentField(user);
    } else {
        // Se alguém deslogou, faça isso:
        showLoginLink();
    }
});

function showCommentField(user) {
    // Obtém o id do artigo atual
    var searchParams = new URLSearchParams(window.location.search);
    // Obtém o valor do parâmetro "id"
    var idValue = parseInt(searchParams.get('id'));
    // Gera a view do formulário de comentários
    commentBox.innerHTML = `
<form method="post" action="view.php?id=${idValue}#comment" name="comment" id="commentForm" onsubmit="preSanitize()">
    <input type="hidden" name="article_id" value="${idValue}">
    <input type="hidden" name="social_id" value="${user.uid}">
    <input type="hidden" name="social_name" value="${user.displayName}">
    <input type="hidden" name="social_photo" value="${user.photoURL}">
    <input type="hidden" name="social_email" value="${user.email}">
    <textarea name="txt_comment" id="txtComment" placeholder="Comente aqui!" required minlength="3"></textarea>
    <button type="submit">Enviar</button>
</form>
    `;
}

function showLoginLink() {
    commentBox.innerHTML = `
<p><a href="login.php?ref=${location.href}%23comment">
    Logue-se</a> para comentar.
</p>
    `;
}

// Função que pré-sanitiza os comentários
function preSanitize() {
    const txtComment = document.getElementById('txtComment');
    txtComment.value = stripTags(txtComment.value);
}