<?php
use yii\widgets\LinkPager;
?>
<div class="news--main-page">
    <h1 class="main--h1"><?=$sectionTitle?></h1>
    <? if ($posts):?>
        <? foreach ($posts as $article): ?>
            <div class="items-leading">
                <div class="one--leading">
                    <div class="leading--left">
                        <? if ($article['mini_image']):?>
                        <img src="<?= $article['mini_image'] ?>">
                        <? endif;?>
                    </div>
                    <div class="leading--right">
                        <h2><?= $article['title'] ?></h2>
                        <p><?= $article['description'] ?></p>
                        <div class="readmore">
                            <a href="<?= $article['url'] ?>">
                                Подробнее...
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <? endforeach;?>
        <?=LinkPager::widget(['pagination' => $pagination]);?>
    <? else:?>
        <p>Пока нет ни одной новости</p>
    <? endif;?>
</div>