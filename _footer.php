</main>

<footer>

    <a href="index.php">
        <i class="fa-solid fa-house fa-fw"></i>
    </a>
    <div>
        <div>&copy; 2024 Eu Mesmo!</div>
        <a href="privacy.php">Políticas de Privacidade</a>
    </div>
    <a href="#wrap">
        <i class="fa-solid fa-circle-up fa-fw"></i>
    </a>

</footer>
&nbsp;
</div>

<?php // Importa as bibliotecas e configuração do Firebase ?>
    <script src="https://www.gstatic.com/firebasejs/10.8.1/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.8.1/firebase-auth-compat.js"></script>
    

<?php // Importa o JavaScript do tema 
?>
<script src="assets/js/global.js"></script>

<?php // Importa o JavaScript específico desta página dinâmicamente 
?>
<script src="assets/js/<?php echo $page["js"] ?>"></script>
</body>

</html>