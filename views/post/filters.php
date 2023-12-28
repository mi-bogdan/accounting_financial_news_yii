<?php
use yii\helpers\Html;
use yii\helpers\Url;

$posts = $dataProvider->getModels();

?>

<main>
        <!-- основной контент страницы -->
        <div class="container">
            <div class="main">
                <div class="nav">
                    <h3 class="nav-h3">Лента новостей</h3>
                            <?php foreach ($post_all as $post): ?>
                                <p class="nav-p"><a href="<?= Url::to(['post/deteil', 'id' => $post->id]) ?>"><span><?= date('H:i', strtotime($post->created_at)) ?></span><?= Html::encode($post->title) ?></a></p>

                            <?php endforeach; ?>
                </div>
                <div class="content">
                    <div class="block">
                     
                   
                        <div class="block-botton">
                            
                        
                        <?php if (!empty($posts)): ?>
                            <p class='category-filters'>Категория: <?= Html::encode($category->title) ?></p>

    <?php foreach ($posts as $post): ?>
        <div class="blok-new">
            <img class="blok-new-img" src="/web/path/to/save/<?= Html::encode($post->image) ?>" alt="<?= Html::encode($post->title) ?>">
            <p class="title">
                <a href="<?= Url::to(['post/deteil', 'id' => $post->id]) ?>">
                    <?= Html::encode($post->title) ?>
                </a>
                <span class="blok-title-span">
                    <?= $post->category ? Html::encode($post->category->title) : 'Без категории' ?>
                </span>
            </p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p class='list-p-error'>Новости не найдены</p>
<?php endif; ?>
</div>
                    </div>
                </div>
            </div>
        </div>
    </main>