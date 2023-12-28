<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;
use app\models\Category;
AppAsset::register($this);

$categories = Category::find()->all();
?>
<?php $this->beginPage() ?>


<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

    <header>
        <!-- Шапка страницы -->
        <div class="container">
            <div class="header">
                <div class="header-top">
                <div class="category-list">
                <?php foreach ($categories as $category): ?>
    <a class="category-list-a" href="<?= Yii::$app->urlManager->createUrl(['post/filters', 'id' => $category->id]) ?>">
        <?= $category->title ?>
    </a>
<?php endforeach; ?>
</div>
                    <div class="header-right">

                    <?php if (Yii::$app->user->isGuest): ?>
                        <?= Html::a('Регистрация', ['auth/signup'], ['class' => 'auth-a']) ?>
                    <?php else: ?>

                        <?php if (Yii::$app->user->identity && Yii::$app->user->identity->isAdmin()): ?>
                        <?= Html::a('Админка', ['administrator/admin'], ['class' => 'auth-a']) ?>
                        <?php endif; ?>
                        
                        <?= Html::a('Выйти', ['auth/logout'], ['class' => 'auth-a']) ?>
                        <?= Html::a('Добавить', ['post/create'], ['class' => 'add-base']) ?>
                    <?php endif; ?>
                    
                        <div class="Rus">
                            <img class="rus-img" src="<?= Url::to('@web/static/media/icons8-курсор-60.png') ?>" alt="">
                            <p class="rus-p"> <?= Html::a('Россия', ['post/index'], ['class' => '']) ?></p>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="header-bottom">
                    <div class="logo">
                        <img class="logo-img" src="<?= Url::to('@web/static/media/Finance-Silhouette-PNG-Picture.png') ?>" alt="">

                    </div>
                    <div class="seach">
                    <form action="<?= Url::to(['post/search']) ?>" method="get">
    <input name="query" placeholder="Поиск новостей" class="seach-input" type="text">
    <button class="seach-button">Найти</button>
</form>
                    </div>
                   
                    <?= Html::a('График', ['currency/chart'], ['class' => 'href-converter']) ?>
                    <div class="kyrs">
                        <img class="kyrs-img" src="<?= Url::to('@web/static/media/icons8-евро-50.png') ?>" alt="">
                        <p class="kyrs-p">101.56 - 1.97</p>
                    </div>
                    <div class="kyrs">
                        <img class="kyrs-img" src="<?= Url::to('@web/static/media/icons8-доллар-сша-24.png') ?>" alt="">
                        <p class="kyrs-p">94.70 - 1.8</p>
                    </div>

                </div>
            </div>

        </div>
    </header>
    <?= $content ?>
    <footer class="footer"> </footer>
    <?php $this->endBody() ?>
</body>


</html>
<?php $this->endPage() ?>