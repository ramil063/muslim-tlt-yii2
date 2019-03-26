<div class="one--article">
    <img class="main--image" src="<?= $post['medium_image'] ?>" alt="">
    <h2><?= $post['title'] ?></h2>
    <div class="article--description">
        <?= $post['description'] ?>
    </div>
    <div class="article--content">
        <?= $post['content'] ?>
    </div>
    <e-gallery album='<?=json_encode($post['album'])?>'></e-gallery>
</div>