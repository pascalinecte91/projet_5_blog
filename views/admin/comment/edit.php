<?php if ($success) : ?>
    <div class="alert alert-success">
        Le commentaire a ete correctement modifié!
    </div>
<?php endif ?>


<?php if (!empty($errors)) : ?>
    <div class="alert alert-danger">
        Le commentaire n'a pas pu être modifié
    </div>
<?php endif ?>
<?= e($comment->getContent()) ?>

<?php require('_form.php') ?>