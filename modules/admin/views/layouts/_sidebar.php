<?php


// prepare menu items, get all modules
$menuItems = [];

$favouriteMenuItems[] = ['label' => 'LogoGen', 'options' => ['class' => 'header']];



$menuItems[] = [
    'icon' => 'cog',
    'label' => 'Генерация Логотипа ',
    'visible' => true,
    'url' => \yii\helpers\Url::toRoute('article/index'),
];

 

echo dmstr\widgets\Menu::widget([
    'items' => \yii\helpers\ArrayHelper::merge($favouriteMenuItems, $menuItems),
]);
?>
