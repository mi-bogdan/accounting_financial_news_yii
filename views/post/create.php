<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\PostForm */
/* @var $categories app\models\Category[] */
/* @var $tags app\models\Tag[] */

$form = ActiveForm::begin(['options' => ['class' => 'create-form-container', 'enctype' => 'multipart/form-data']]);

echo $form->field($model, 'title', [
    'options' => ['class' => 'create-form-field']
])->textInput(['class' => 'create-input']);

echo $form->field($model, 'content', [
    'options' => ['class' => 'create-form-field']
])->textarea(['rows' => 6, 'class' => 'create-textarea']);

echo $form->field($model, 'image', [
    'options' => ['class' => 'create-form-field']
])->fileInput(['class' => 'create-file-input']);

echo $form->field($model, 'category_id', [
    'options' => ['class' => 'create-form-field']
])->dropDownList(ArrayHelper::map($categories, 'id', 'title'), ['prompt' => 'Выберите категорию', 'class' => 'create-select']);

echo $form->field($model, 'tags', [
    'options' => ['class' => 'create-form-field']
])->checkboxList(ArrayHelper::map($tags, 'id', 'title'), ['class' => 'create-checkbox-list']);

echo Html::submitButton('Добавить', ['class' => 'create-form-submit-button']);

ActiveForm::end();