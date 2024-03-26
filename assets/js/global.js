/**
 * Chaves de configuração do Firebase
 * Copie aqui as suas prórias chaves do Firebase.
 **/

const firebaseConfig = {
    apiKey: "AIzaSyAFQ3lcr5pisjUGmjscC2OzAvo4nD569zs",
    authDomain: "blog-helloword-c2044.firebaseapp.com",
    projectId: "blog-helloword-c2044",
    storageBucket: "blog-helloword-c2044.appspot.com",
    messagingSenderId: "503360283139",
    appId: "1:503360283139:web:d1105812e5faeee6a5a436"
  };
// Inicializa o Firebase
firebase.initializeApp(firebaseConfig);

// Inicializa o Firebase Authentication
const auth = firebase.auth();

// Identifica elementos do HTML para interação
const userAccess = document.getElementById('userAccess');
const userImg = document.getElementById('userImg');
const userIcon = document.getElementById('userIcon');
const userLabel = document.getElementById('userLabel');
// Campo de busca
const headerSearch = document.getElementById('headerSearch');

// Monitora se houve mudanças na autenticação do usuário
firebase.auth().onAuthStateChanged((user) => {
    if (user) {
        // Se alguém se logou, faça isso:
        // Chama a função que trata o usuário logado
        isLogged(user);
    } else {
        // Se alguém deslogou, faça isso:
        // Chama a função que trata o usuário NÃO logado
        notLogged();
    }
});

// Evita o reenvio dos formulários ao atualizar a página
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}

// Função que trata o usuário logado
function isLogged(user) {
    // Altera href do link
    // Atividade 4) uid=${user.uid}
    userAccess.href = `profile.php?uid=${user.uid}&ref=${location.href}`;
    // Altera title do link
    userAccess.title = `Ver perfil de ${user.displayName}`;
    // Oculta o ícone de login
    userIcon.style.display = 'none';
    // Define os atributos da imagem conforme dados do usuário
    userImg.src = user.photoURL;
    userImg.alt = user.displayName;
    // Mostrar a imagem do usuário
    userImg.style.display = 'inline';
    // Altera a label para entrar
    userLabel.innerHTML = 'Perfil';
}

// Função que trata o usuário NÃO logado 
function notLogged() {
    // Altera href do link
    userAccess.href = `login.php?ref=${location.href}`;
    // Altera title do link
    userAccess.title = 'Logue-se';
    // Oculta a imagem do usuário
    userImg.style.display = 'none';
    // Mostra o ícone de login
    userIcon.style.display = 'inline';
    // Altera a label para entrar
    userLabel.innerHTML = 'Entrar';
}

// Função que converte datas do Firebase (timestamp) para pt-BR
function convertTimestampToDateFormat(timestamp) {
    const date = new Date(timestamp);
    const day = date.getDate().toString().padStart(2, '0');
    const month = (date.getMonth() + 1).toString().padStart(2, '0');
    const year = date.getFullYear();
    const hour = date.getHours().toString().padStart(2, '0');
    const min = date.getMinutes().toString().padStart(2, '0');
    return `${day}/${month}/${year} às ${hour}:${min}`;
}

// Função que remove espaços antes e depois, códigos JavaScript e tags HTML da string argumento
function stripTags(htmlText) {
    let div = document.createElement('div');
    div.innerHTML = htmlText.trim().replace(/<script>.*<\/script>/, '');
    return div.textContent;
}

// Função que valida o preenchimento do formulário de busca
function searchCheck() {
    // Sanitiza o valor do campo
    headerSearch.value = stripTags(headerSearch.value.trim());
    // Se o campo não tem valor bloqueia o envio do formulário
    if (headerSearch.value == '') {
        // alert('Oooops! Você não disse o que quer procurar...');
        return false;
    }
    return true;
}