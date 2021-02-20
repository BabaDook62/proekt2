<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
use app\models\Views;
use yii\widgets\ActiveForm;;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (User::accessControl(['admin'])) {
            echo Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        }
        ?>
         <?php if (User::accessControl(['admin'])) {
         echo Html::a('Загрузить картинку', ['set-image', 'id' => $model->id], ['class' => 'btn btn-default']);
         }
          ?>
    
        <?php if (User::accessControl(['admin'])) {
            echo Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы точно хотите удалить?',
                'method' => 'post',
            ],
        ]);
        } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
           
            'date',
            'image',
            
        ],
    ]) ?>
    <?php {
          echo  Html::a('Скачать файл', ['download', 'id' => $model->id],['class' => 'btn btn-primary']);
         } ?>

</div>
