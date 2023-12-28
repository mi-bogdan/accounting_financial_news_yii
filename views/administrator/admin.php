<?php
use yii\helpers\Html;
use yii\grid\GridView;
?>

<div class='admin'>
    <div class='admin-header'>
        <p class='admin-header-p'>Администрирование Yii</p>
    </div>
    <h1 class='admin-header-h1'>Адмиистрирование сайта</h1>

    <div class='menu-admin'>
        <div class='menu-admin-div'>
        <p class='menu-admin-title'>Действие администратора</p>
        </div>
        <div class='munu-list'>
            <div class='munu-list-div'>
            <?= Html::a('Таблица Категории', ['administrator/category'], ['class' => 'munu-list-div-p']) ?>
               
            </div>
            <div class='munu-list-div'>
            <?= Html::a('Таблица Тегов', ['administrator/tags'], ['class' => 'munu-list-div-p']) ?>
            </div>
            <div class='munu-list-div'>
            <?= Html::a('Таблица Постов', ['administrator/post'], ['class' => 'munu-list-div-p']) ?>
            </div>
        </div>
        <div class='menu-admin-div'></div>
    </div>
</div>
