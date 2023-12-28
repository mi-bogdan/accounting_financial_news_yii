<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class PostTag extends ActiveRecord
{
    public static function tableName()
    {
        return 'post_tag';
    }

}