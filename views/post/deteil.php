<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$posts = $dataProvider->getModels();
$this->title = $model->title;
?>

<main>
        <!-- основной контент страницы -->
        <div class="container">
            <div class="main">

                <div class="deteil">
                    <p class="deteil-title"><?= Html::encode($this->title) ?></p>
                    <div class="deteil-block">
                        <p class="deteil-autor"><?= Html::encode($userModel->username) ?></p>
                    
                        <p class="deteil-data"><?= strftime('%e %B, %H:%M', strtotime($model->created_at)) ?></p>
                        <div>
                            <a class="deteil-comments" href="<?= Url::to(['post/comments', 'id' => $model->id]) ?>">
                                <img class="deteil-comments-img" src="<?= Url::to('@web/static/media/icons8-комментарии-50.png') ?>" alt="">
                                <p class="deteil-comments-count">Комментарии</p>
                            </a>
                        </div>

                    </div>
                    <div>
                        <img class="deteil-img" src="/web/path/to/save/<?= Html::encode($model->image) ?>" alt="">
                    </div>
                    <div class="deteil-descriptions">
                        <p class="deteil-descriptions-p">
                        <?= Html::encode($model->content) ?>
                        </p>
                    </div>

                    <div class="post-tags">
                    <h3 class='tag-h3'>Теги:</h3>
                    <ul class='tag-ul'>
                        <?php foreach ($model->tags as $tag): ?>
                            <li class='tag-li'><?= Html::encode($tag->title) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    </div>



                </div>
                <div class="nav">
                    <h3 class="nav-h3">Лента новостей</h3>
                    <?php foreach ($posts as $post): ?>
                                <p class="nav-p"><a href="<?= Url::to(['post/deteil', 'id' => $post->id]) ?>"><span><?= date('H:i', strtotime($post->created_at)) ?></span><?= Html::encode($post->title) ?></a></p>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </main>