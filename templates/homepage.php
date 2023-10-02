<?php ob_start() ?>

    <h1>Ceci est un titre
    Hello World!</h1>
</body>
</html>
<?php $content = ob_get_clean(); ?>
<?php require('layout.php');
