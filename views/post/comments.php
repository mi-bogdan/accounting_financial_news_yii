<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

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
                    <p class="deteil-title"><a href="<?= Url::to(['post/deteil', 'id' => $model->id]) ?>"><?= Html::encode($this->title) ?></a></p>
                    <div class="deteil-block">
                        <p class="deteil-autor"><?= Html::encode($userModel->username) ?></p>
                        <p class="deteil-data"><?= strftime('%e %B, %H:%M', strtotime($model->created_at)) ?></p>
                        <div>
                            <a class="deteil-comments" href="">
                                <img class="deteil-comments-img" src="<?= Url::to('@web/static/media/icons8-комментарии-50.png') ?>" alt="">
                                <p class="deteil-comments-count">Комментарии</p>
                            </a>
                        </div>
                    </div>
                    
                    <div class="deteil-descriptions">
                        <p class="deteil-descriptions-p">
                        <?= StringHelper::truncateWords(Html::encode($model->content), 20, '...'); ?>
                        </p>
                    </div>

                    <h3 class="comment-h3">Комментариев</h3>
                    <?php
                    foreach ($comments as $comment) {
                        ?>

                        <div class="comments">
                        <div class="comments-block">
                            <div class="comments-icon"></div>
                            <p class="comments-author"><?= Yii::$app->formatter->asText($comment->user->username) ?>   <span><?= strftime('%e %B, %H:%M', strtotime($comment->created_at)) ?></span></p>
                        </div>
                        <p class="comment-text">
                        <?= Yii::$app->formatter->asNtext($comment->content) ?>
                        </p>
                        </div>     
                            <?php
                            }
                         ?>

                <br>
                <br>
                <br>
                <br>

                                        <?php $form = ActiveForm::begin([
    'id' => 'comments-comment-form',
    'options' => ['class' => 'comments-review-form'],
]);

// Поле для ввода текста комментария
echo $form->field($commentModel, 'content', [
    'template' => "{label}\n{input}\n{hint}\n{error}",
    'labelOptions' => ['class' => 'comments-review-label'],
    'inputOptions' => ['class' => 'comments-review-textarea', 'placeholder' => 'Введите ваш комментарий'],
])->textarea()->label('Оставь свой комментарий:');

// Кнопка отправки формы
echo Html::submitButton('Отправить', ['class' => 'comments-review-submit-btn']);

// Конец формы
ActiveForm::end(); ?>

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