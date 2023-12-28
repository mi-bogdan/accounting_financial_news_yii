<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use app\models\Tags;

class PostForm extends Model
{
    public $title;
    public $content;
    public $image; // Для загрузки файла
    public $category_id;
    public $tags;

    public function rules()
    {
        return [
            [['title', 'content', 'category_id'], 'required'],
            [['category_id'], 'integer'],
            [['title', 'content'], 'string'],
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['tags'], 'safe'], // для массива идентификаторов тегов
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'content'=>'Описание',
            'tags'=>'Теги',
            'image'=>'Изображение',
            'category_id'=>'Категория'
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $basePath = Yii::getAlias('@webroot'); // Путь до webroot
            $targetDir = $basePath . '/path/to/save/'; // Целевая папка
            $targetFile = $targetDir . $this->image->baseName . '.' . $this->image->extension;

            // Создаем директорию, если она не существует
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            // Перемещаем файл
            if ($this->image->saveAs($targetFile)) {
                return true;
            }
        }

        return false;
    }
}