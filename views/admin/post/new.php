<?php if (!empty($errors)) : ?>
   <div class="alert alert-danger">
      L'article n'a pas pu être enregistré, merci de corriger vos erreurs
   </div>
<?php endif ?>
<?php if (isset($_GET['created'])) :
?>
   <div class="alert alert-success">
      L'article a ete correctement crée
   </div>
<?php endif ?>

<h2>NOUVEAU POST </h2>

<?php require('_form.php') ?>