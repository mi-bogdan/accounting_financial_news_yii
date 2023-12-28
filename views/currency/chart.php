<?php
// @var $this yii\web\View
// @var $kyrsData app\models\KyrsPeriod[]
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Курс доллара в ноябре 2023 года по дням';
$posts = $dataProvider->getModels(); // Получаем модели постов
$graphHeight = 300; // Высота графика
$maxValue = max(array_column($kyrsData, 'kyrs')); // Максимальное значение курса для масштабирования
$scale = $graphHeight / $maxValue; // Масштаб высоты столбца
?>
<style>
    .kyrs-graph {
        width: 90%;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }
    .kyrs-graph-column {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-right: 2px;
        font-size: 0.7em; /* уменьшенный размер текста */
    }
    .kyrs-graph-column > div {
        width: 15px; /* уменьшенная ширина столбца */
        background-color: blue;
        margin-bottom: 2px;
        color: white;
        display: flex;
        justify-content: center;
        align-items: flex-end;
        padding: 2px;
    }
    .kyrs-graph-dates {
        writing-mode: tb;
        margin-top: 4px;
    }
    .kyrs-graph-axis {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        height: <?= $graphHeight ?>px;
        border-left: 2px solid black;
        border-bottom: 2px solid black;
    }
</style>







<main>
        <!-- основной контент страницы -->
        <div class="container">
            <div class="main">
                <div class="nav">
                    <h3 class="nav-h3">Лента новостей</h3>
                    <?php foreach ($posts as $post): ?>
                                <p class="nav-p"><a href="<?= Url::to(['post/deteil', 'id' => $post->id]) ?>"><span><?= date('H:i', strtotime($post->created_at)) ?></span><?= Html::encode($post->title) ?></a></p>

                            <?php endforeach; ?>
                </div>
                <div class="content-converter">
                <h1 class='kyrs-h1'><?= $this->title ?></h1>
                <div class="kyrs-graph">
                
                    <div class="kyrs-graph-axis">
                        <?php foreach ($kyrsData as $data): ?>
                            <?php $height = $data->kyrs * $scale; // Масштабирование высоты столбца ?>
                            <div class="kyrs-graph-column">
                                <div style="height: <?= $height ?>px;">
                                    <span><?= htmlspecialchars($data->kyrs) ?></span>
                                </div>
                                <span class="kyrs-graph-dates"><?= Yii::$app->formatter->asDate($data->data, 'short') ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="statistic-div">
                    <h3>Статистика курса доллара за ноябрь</h3>
                    <p>Средний курс: <?= Yii::$app->formatter->asDecimal($averageRate, 2) ?> рублей</p>
                    <p>Минимальный курс: <?= Yii::$app->formatter->asDecimal($minRate, 2) ?> рублей</p>
                    <p>Максимальный курс: <?= Yii::$app->formatter->asDecimal($maxRate, 2) ?> рублей </p>
                </div>


                </div>
            </div>
        </div>
    </main>