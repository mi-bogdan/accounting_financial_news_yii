<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $categories app\models\Category[] */

$this->title = 'Административная панель: Тегов';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class='admin'>
    <div class='admin-container'></div>

            <div class='admin-header'>
                <p class='admin-header-p'>Администрирование Yii</p>
            </div>
            <h1 class='admin-header-h1'><?= Html::encode($this->title) ?></h1>


            <div class='admin-container'>
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

            <div class="category-admin">

            <?= Html::a('Добавить', ['administrator/addtags'], ['class' => 'munu-list-add-category']) ?>
            <?= Html::a('Посмотреть', ['administrator/tag'], ['class' => 'munu-list-add-category']) ?>

            <?= GridView::widget([
    'dataProvider' => new yii\data\ArrayDataProvider([
        'allModels' => $tags,
        'pagination' => [
            'pageSize' => 10,
        ],
    ]),
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'title',

        // Колонка действий
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete}',
            // Здесь вы можете определить URL и другие параметры кнопок
            // Они будут автоматически связаны с ID соответствующих записей
        ],
    ],
]) ?>

            </div>

            </div>
   
</div> 








