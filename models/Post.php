<?php

namespace app\models;
use app\models\Tags;
use app\models\PostTag;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property int|null $category_id
 * @property string|null $title
 * @property string|null $content
 * @property string|null $image
 * @property int|null $user_id
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Category $category
 * @property Comment[] $comments
 * @property PostTag[] $postTags
 * @property Tags[] $tags
 * @property User $user
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'user_id'], 'integer'],
            [['content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'image'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'title' => 'Заголовок',
            'content' => 'Описание',
            'image' => 'Изображение',
            'user_id' => 'User ID',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['post_id' => 'id']);
    }

    /**
     * Gets query for [[PostTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPostTags()
    {
        return $this->hasMany(PostTag::class, ['post_id' => 'id']);
    }

    /**
     * Gets query for [[Tags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tags::class, ['id' => 'tag_id'])->viaTable('post_tag', ['post_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function linkTags($tagsIds)
    {
        if (is_array($tagsIds)) {
            // Удаляем все текущие связи, чтобы избежать дублирования
            PostTag::deleteAll(['post_id' => $this->id]);

            // Устанавливаем новые связи
            foreach ($tagsIds as $tagId) {
                if ($tag = Tags::findOne($tagId)) {
                    $this->link('tags', $tag);
                }
            }
        }
    }
    public function saveImageInfo($filePath) {
        // $filePath - это относительный путь к файлу, который будет использоваться в <img src="...">
        $post = new Post();
        $post->image = $filePath;
        // ... установите другие атрибуты ...
        return $post->save(false);
    }

}
