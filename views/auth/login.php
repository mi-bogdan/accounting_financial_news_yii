<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-signup">
    <h1 class='site-signup-h1'><?= Html::encode($this->title) ?></h1>

    <p class='site-signup-p'>Пожалуйста, заполните следующие поля для входа в систему:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true,'class' => 'signup-input-form'])->label('Логин',['class' => 'signup-label']) ?>

        <?= $form->field($model, 'password')->passwordInput(['class' => 'signup-input-form'])->label('Пароль',['class' => 'signup-label']) ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Войти', ['class' => 'signup-form-submit', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>



</div>
