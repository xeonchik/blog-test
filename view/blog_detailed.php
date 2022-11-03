<?php
/**
 * @var \Blog\Entity\Post $post
 */
$post = $this->post;
?>
<div class="post post-detailed">
        <div>
            <div class="date"><?=$post->published->format('y.m.d, H:i\h') ?></div>
            <div class="title"><?=$post->title ?></div>
            <div class="image"><img src="https://via.placeholder.com/150"></div>
            <div class="announce"><?=$post->getAnnounce()?></div>
            <div class="bottom">
                <div class="author">Author: <?=$post->getAuthor()->getName()?></div>
            </div>
        </div>
</div>
