<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $categories app\models\Category[] */

$this->title = 'Административная панель: Постов';
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

            <?= Html::a('Добавить', ['post/create'], ['class' => 'munu-list-add-category']) ?>

            <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'title',
        [
            'attribute' => 'category_id',
            'label' => 'Категория',
            'value' => function ($model) {
                return $model->category ? $model->category->title : 'Нет категории';
            }
        ],
        'content:ntext',
        'image', // возможно, вам понадобится добавить обработку для отображения изображения
        [
            'attribute' => 'user_id',
            'label' => 'Пользователь',
            'value' => function ($model) {
                return $model->user ? $model->user->username : 'Неизвестно';
            }
        ],
        'created_at:datetime', // форматирование даты и времени
        'updated_at:datetime',
        [
            'label' => 'Теги',
            'format' => 'raw',
            'value' => function ($model) {
                return implode(', ', array_map(function ($tag) {
                    return Html::encode($tag->title); // или Html::a(Html::encode($tag->name), ['tag/view', 'id' => $tag->id])
                }, $model->tags));
            },
        ],

        ['class' => 'yii\grid\ActionColumn'], // Колонка с кнопками действий
    ],
]); ?>

            </div>

            </div>
   
</div> 
