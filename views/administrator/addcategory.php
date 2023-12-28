<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $model app\models\Category */
$this->title = 'Административная панель: Добавление категории';
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
           

<div class="category-create category-admin">
    <?php $form = ActiveForm::begin([
        'id' => 'category-create-form',
        'options' => ['class' => 'form-horizontal'],
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true,'class' => 'category-add-input'])->label('Название',['class' => 'category-add-label']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn-category-add']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

            </div>
   
</div> 




