<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\httpclient\Client;
use app\models\KyrsPeriod;
use app\models\Post;
use yii\data\ActiveDataProvider;

class CurrencyController extends Controller
{
    
    public function actionChart()
    {
        $kyrsData = KyrsPeriod::find()->all();

        $averageRate = KyrsPeriod::averageRateForNovember();
        $minRate = KyrsPeriod::minRateForNovember();
        $maxRate = KyrsPeriod::maxRateForNovember();

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
        
        return $this->render('chart', ['kyrsData' => $kyrsData,'dataProvider' => $dataProvider,'averageRate' => $averageRate,
        'minRate' => $minRate,
        'maxRate' => $maxRate,]);
    }
        
}