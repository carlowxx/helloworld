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

// Monitora se houve mudanças na autenticação do usuário
firebase.auth().onAuthStateChanged((user) => {
    if (user) {
        // Se alguém se logou, faça isso...
        // Chama a função que trata o usuário logado
        isLogged(user);
    } else {
        // Se alguém deslogou, faça isso...
        // Chama a função que trata o usuário NÃO logado
        notLogged();
    }
});

// Função que trata o usuário logado
function isLogged(user) {
    // Altera href do link
    userAccess.href = `profile.php?ref=${location.href}`;
    // Altera title do link
    userAccess.title = `Ver perfil de ${user.displayName}`;
    // Oculta o ícone de login
    userIcon.style.display = 'none';
    // Cria os atributos da imagem conforme dados do usuário
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
    userImg.style.display  = 'none';
    // Mostra o ícone de login
    userIcon.style.display = 'inline';
    // Altera a label para entrar
    userLabel.innerHTML = 'Entrar';
}