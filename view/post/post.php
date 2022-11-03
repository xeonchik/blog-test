<?php
/**
 * @var \Blog\Entity\Post $post
 */
?>
<div class="post">
    <a href="/view?id=<?=$post->id?>">
        <div>
            <div class="title">
                <?=$post->published->format('y.m.d, H:i\h') ?> - <?=$post->title ?>
            </div>
            <div class="announce"><?=$post->getAnnounce()?></div>
            <div class="bottom">
                <div class="author">Author: <?=$post->getAuthor()->getName()?></div>
                <div class="comments">Kommentare: <?=count($post->getComments())?></div>
            </div>
        </div>
        <div class="image"><img src="https://via.placeholder.com/150"></div>
    </a>
</div>
