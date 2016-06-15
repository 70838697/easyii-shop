<?php
use yii2elfinder\yii2elfinder;

$this->title = "Yii2elfinder downloads";
$this->params['breadcrumbs'][] = ['label' => Yii::t('app',"Download"), 'url' => ['download/index']];
$this->params['breadcrumbs'][] = Yii::t('app',"yii2elfinder");
?>
<h1><?= Yii::t('app',"yii2elfinder downloads") ?></h1>
<br/>


<?php
echo yii2elfinder::widget(
  array(
    'connectorRoute' => 'download/yii2elfinderc',
  )
);
?>