<?php

/** @property \Blog\Entity\Post[] $posts */

?>
<?php foreach ($this->posts as $post): ?>
    <?php echo $this->render('post/post', [
        'post' => $post
    ]) ?>
<?php endforeach; ?>
