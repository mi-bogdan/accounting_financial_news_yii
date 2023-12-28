<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $categories app\models\Category[] */

$this->title = 'Административная панель: Тегов';
$this->params['breadcrumbs'][] = $this->title;
?>
<table>
    <thead>
        <tr>
            <th>Тег</th>
            <th>Количество</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tags as $tag): ?>
            <tr>
               
                <td><?= Html::encode($tag['title']) ?></td>
                <td><?= Html::encode($tag['postCount']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>