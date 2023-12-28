<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\Category;
use app\models\Tags;
use yii\data\ActiveDataProvider;
use app\models\Post;


class AdministratorController extends Controller
{
    public function actionAdmin()
    {
        return $this->render('admin'); 
    }
    public function actionCategory()
    {
        $categories = Category::find()->all();
        return $this->render('category',['categories' => $categories]); 
    }

    public function actionAddcategory()
{
    $model = new Category();
  

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        Yii::$app->session->setFlash('success', 'Категория добавлена.');
        return $this->redirect(['category']);
    }

    return $this->render('addcategory', ['model' => $model]);
}

    public function actionTags()
    {
        $tags = Tags::find()->all();
        return $this->render('tags', ['tags' => $tags]); 
    }

    public function actionAddtags()
    {
        $model = new Tags(); // создаем экземпляр модели Tags
  
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Тег добавлен.');
            return $this->redirect(['tags']); // редирект на список тегов
        }

        return $this->render('addtags', ['model' => $model]); // отрисовываем представление с формой
    }

    public function actionPost()
{
    $dataProvider = new ActiveDataProvider([
        'query' => Post::find()->with('tags'), // загружаем посты с тегами
        'pagination' => [
            'pageSize' => 20, // количество записей на странице
        ],
    ]);

    return $this->render('post', [
        'dataProvider' => $dataProvider,
    ]);
}

public function actionTag()
{
    $tags = Tags::find()
        ->select(['{{tags}}.*', 'postCount' => 'COUNT({{post_tag}}.post_id)']) // Добавляем подсчет постов
        ->joinWith('postTags') // Соединяем с пост-тегами
        ->groupBy('{{tags}}.id') // Группируем результаты по идентификатору тега
        ->asArray() // Получаем результат в качестве массива
        ->all();

    return $this->render('tag', ['tags' => $tags]);
}

    
}