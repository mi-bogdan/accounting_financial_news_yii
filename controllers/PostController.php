<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\Post;
use app\models\PostForm;
use app\models\Category;
use app\models\Comment;
use app\models\Tags;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;

   


class PostController extends Controller
{
    public function actionIndex()
{
    $dataProvider = new ActiveDataProvider([
        'query' => Post::find(),
        'pagination' => [
            'pageSize' => 10,
        ],
        'sort' => [
            'defaultOrder' => [
                'created_at' => SORT_DESC, // Сортировать по дате создания по убыванию
            ]
        ],
    ]);

    return $this->render('index', [
        'dataProvider' => $dataProvider,
    ]);
}

    public function actionCreate()
    {
        $model = new PostForm();
        $categories = Category::find()->all(); // Замените на ваш метод получения категорий
        $tags = Tags::find()->all(); // Замените на ваш метод получения тегов

        if ($model->load(Yii::$app->request->post())) {
            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->upload()) {
                // Тут логика сохранения данных в базу
                $post = new Post();
                $post->title = $model->title;
                $post->content = $model->content;
                $post->image = $model->image->name; // предполагается, что имя файла сохраняется
                $post->category_id = $model->category_id;
                $post->user_id = Yii::$app->user->id; // ID авторизованного пользователя
                if ($post->save()) {
                    $post->linkTags($model->tags); // метод для связывания поста с тегами

                    // Редирект на страницу поста или список постов
                    // return $this->redirect(['view', 'id' => $post->id]);
                    return $this->redirect(['index']);
                }
            }
        }

        // Рендеринг формы создания поста
        return $this->render('create', [
            'model' => $model,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    } 
    
    public function actionDeteil($id)
    {
        $model = $this->findModel($id);
        $userModel = $model->user;

        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->with('tags'),
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC, // Сортировать по дате создания по убыванию
                ]
            ],
        ]);

        return $this->render('deteil', [
            'model' => $model,
            'userModel' => $userModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionComments($id)
    {
        
        $model = $this->findModel($id);
    $userModel = $model->user;
    $commentModel = new Comment();

    if (Yii::$app->request->isPost) {
        $commentModel->load(Yii::$app->request->post());
        $commentModel->post_id = $id;
        $commentModel->user_id = Yii::$app->user->id; // Получаем ID текущего пользователя
        if ($commentModel->save()) {
            // Если комментарий сохранен, перенаправляем обратно на страницу комментариев
            return $this->redirect(['comments', 'id' => $id]);
        }
    }

    $dataProvider = new ActiveDataProvider([
        'query' => Post::find(),
        'pagination' => [
            'pageSize' => 10,
        ],
        'sort' => [
            'defaultOrder' => [
                'created_at' => SORT_DESC, // Сортировать по дате создания по убыванию
            ]
        ],
    ]);
    $comments = Comment::find()->where(['post_id' => $id])
                                ->orderBy(['created_at' => SORT_DESC])
                                ->all();

    return $this->render('comments', [
        'model' => $model,
        'userModel' => $userModel,
        'commentModel' => $commentModel, // Добавляем модель комментария
        'dataProvider' => $dataProvider,
        'comments' => $comments,
    ]);
    }


    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не существует.');
        }
    }
    public function actionFilters($id = null)
{
    $category = Category::find()->where(['id' => $id])->one();
    if ($id === null) {
        $query = Post::find();
        
    } else {
        $query = Post::find()->where(['category_id' => $id]);
    }
    
    $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' => [
            'pageSize' => 10,
        ],
        'sort' => [
            'defaultOrder' => [
                'created_at' => SORT_DESC,
            ]
        ],
    ]);
    
    $post_all = Post::find()->all();

    return $this->render('filters', [
        'dataProvider' => $dataProvider,
        'post_all' => $post_all,
        'category'=> $category,
    ]);
}

public function actionSearch()
    {
        $post_all = Post::find()->all();
        
        $query = Yii::$app->request->get('query'); // получаем значение запроса из формы поиска

        // Используем статический метод find() модели Post для создания запроса к базе данных
        $posts = Post::find()
            ->where(['like', 'title', $query]) // фильтруем посты по заголовку
            ->all();

        // Передаем найденные посты в представление, чтобы отобразить результаты поиска пользователю
        return $this->render('search', [
            'post_all' => $post_all,
            'posts' => $posts,
            'query' => $query, // передаем значение запроса в представление для отображения

        ]);
    }
    

    
}


