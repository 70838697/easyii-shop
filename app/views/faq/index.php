<?php
use yii\easyii\modules\faq\api\Faq;
use yii\easyii\modules\page\api\Page;

$page = Page::get('page-faq');

$this->title = Yii::t('app',$page->seo('title', $page->model->title));
$this->params['breadcrumbs'][] = Yii::t('app',$page->model->title);
?>
<h1><?= Yii::t('app',$page->seo('h1', $page->title)) ?></h1>
<br/>

<?php foreach(Faq::items() as $item) : ?>
    <p><b><?=Yii::t('app','Question')?>: </b><?= $item->question ?></p>
    <blockquote><b><?=Yii::t('app','Answer')?>: </b><?= $item->answer ?></blockquote>
<?php endforeach; ?>