<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\SignupForm;
use app\models\LoginForm;

class AuthController extends Controller
{
    public function actionSignup()
    {
        $signupForm = new SignupForm();

        if (Yii::$app->request->isPost) {
            $signupForm->load(Yii::$app->request->post());
            if ($signupForm->validate() && $signupForm->signup()) {
                Yii::$app->session->setFlash('success', 'Регистрация прошла успешно. Теперь вы можете войти в систему.');
                return $this->redirect(['auth/login']); // Перенаправление на страницу входа
            }
        }

        return $this->render('signup', [
            'model' => $signupForm,
        ]);
    }
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
