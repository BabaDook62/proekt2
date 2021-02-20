<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
use app\models\Views;
use yii\widgets\ActiveForm;;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = 'Добавить лого';
$this->params['breadcrumbs'][] = ['label' => 'Картинка', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
