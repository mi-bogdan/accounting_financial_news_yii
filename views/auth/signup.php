<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SignupForm */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Регистраця';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-signup">
    <h1 class='site-signup-h1'><?= Html::encode($this->title) ?></h1>

    <p class='site-signup-p'>Пожалуйста, заполните следующие поля для регистрации:</p>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true,'class' => 'signup-input-form'])->label('Логин',['class' => 'signup-label']); ?>

        <?= $form->field($model, 'email')->textInput(['class' => 'signup-input-form'])->label('Почта',['class' => 'signup-label']); ?>

<?= $form->field($model, 'password')->passwordInput(['class' => 'signup-input-form'])->label('Пароль',['class' => 'signup-label']) ?>

<div class="form-group">
    <?= Html::submitButton('Зарегистрироваься', ['class' => 'signup-form-submit', 'name' => 'signup-button']) ?>
</div>

<?php ActiveForm::end(); ?>
<p>--<?= Html::a('Войти', ['auth/login'], ['class' => 'auth-btn-signup']) ?>--</p>

</div>
