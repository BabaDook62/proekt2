<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
use app\models\Views;
use yii\widgets\ActiveForm;;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Главная';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (User::accessControl(['admin'])) {
          echo  Html::a('Добавить лого', ['create'], ['class' => 'btn btn-success']);
         }
         ?>
       
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            
            [
                'format' => 'html',
                'label' => 'Лого',
                'value' => function($data){
                    return Html::img($data->getImage(), ['width'=>200]);
                }
            ],
            ['attribute'=>'Сылка на скачивание',
            'format'=>'raw',
            'value' => function($data)
                {
                    return Html::a('Скачать файл', ['download', 'id' => $data->id],['class' => 'btn btn-primary']);
                }
            ],
            //'image',
            //'viewed',
            //'user_id',
            //'status',
            //'category_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
