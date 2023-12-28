<?php
use yii\helpers\Html;
use yii\helpers\Url;
$posts = $dataProvider->getModels(); // Получаем модели постов
?>

<main>

        <!-- основной контент страницы -->
        <div class="container">
            <div class="main">
                <div class="nav">
                    <h3 class="nav-h3">Лента новостей</h3>
                            <?php foreach ($posts as $post): ?>
                                <p class="nav-p"><a href="<?= Url::to(['post/deteil', 'id' => $post->id]) ?>"><span><?= date('H:i', strtotime($post->created_at)) ?></span><?= Html::encode($post->title) ?></a></p>

                            <?php endforeach; ?>
                </div>
                <div class="content">
                    <div class="block">
                        <div class="block-top">
                            <div class="blok-one">
                                <img class="blok-one-img" src="<?= Url::to('@web/static/media/1662811294_g-32 1.png') ?>" alt="">
                                <p class="title"><a href="deteils.html">Доллар упал до 95 рублей на бирже Доллар упал до 95 рублей
                                        на бирже Доллар упал</a> <span class="blok-title-span">Биржи</span></p>
                            </div>
                            <div class="blok-right">
                                <div class="blok-two">
                                    <img class="blok-two-img" src="<?= Url::to('@web/static/media/im1.jpg') ?>" alt="">
                                    <p class="title"><a href="deteils.html">Доллар упал до 95 рублей на бирже</a></p>
                                </div>
                                <div class="blok-two">
                                    <img class="blok-two-img" src="<?= Url::to('@web/static/media/im2.jpg') ?>" alt="">
                                    <p class="title"><a href="deteils.html">Доллар упал до 95 рублей на бирже</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="block-botton">
    <?php foreach ($posts as $post): ?>
        <div class="blok-new">
        <img class="blok-new-img" src="/web/path/to/save/<?= Html::encode($post->image) ?>" alt="<?= Html::encode($post->title) ?>">
            <p class="title">
                <a href="<?= Url::to(['post/deteil', 'id' => $post->id]) ?>"><?= Html::encode($post->title) ?></a>
                <span class="blok-title-span"><?= $post->category ? Html::encode($post->category->title) : 'Без категории' ?></span>
            </p>
        </div>
    <?php endforeach; ?>
</div>
                    </div>
                </div>
            </div>
        </div>
    </main>

