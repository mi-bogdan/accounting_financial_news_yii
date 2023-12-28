<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "KyrsPeriod".
 *
 * @property int $id
 * @property string|null $data
 * @property float $kyrs
 * @property string|null $change
 */
class KyrsPeriod extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'KyrsPeriod';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data'], 'safe'],
            [['kyrs'], 'required'],
            [['kyrs'], 'number'],
            [['change'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data' => 'Data',
            'kyrs' => 'Kyrs',
            'change' => 'Change',
        ];
    }
    public static function averageRateForNovember()
    {
        return static::find()
            ->where(['>=', 'data', '2023-11-01']) // Начало ноября
            ->andWhere(['<=', 'data', '2023-11-30']) // Конец ноября
            ->average('kyrs'); // Получаем среднее значение
    }

    public static function minRateForNovember()
    {
        return static::find()
            ->where(['>=', 'data', '2023-11-01'])
            ->andWhere(['<=', 'data', '2023-11-30'])
            ->min('kyrs'); // Получаем минимальное значение
    }

    public static function maxRateForNovember()
    {
        return static::find()
            ->where(['>=', 'data', '2023-11-01'])
            ->andWhere(['<=', 'data', '2023-11-30'])
            ->max('kyrs'); // Получаем максимальное значение
    }
    
}
