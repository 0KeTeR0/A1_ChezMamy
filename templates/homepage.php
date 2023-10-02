<?php $title = "Page d'accueil"; ?>
<?php ob_start() ?>

<h1>Ceci est un titre
Hello World!</h1>

<?php $content = ob_get_clean(); ?>
<?php require('layout.php'); ?>
