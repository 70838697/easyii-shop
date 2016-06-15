<?php
use yii\easyii\modules\page\api\Page;
use yii2elfinder\yii2elfinder;

$page = Page::get('page-download');

$this->title = Yii::t('app',$page->seo('title', $page->model->title));
$this->params['breadcrumbs'][] = Yii::t('app',$page->model->title);
?>
<h1><?= Yii::t('app',$page->seo('h1', $page->title)) ?></h1>
<br/>


<?php
echo yii2elfinder::widget(
  array(
    'connectorRoute' => 'download/connector',
  )
);
?>