<?php
use yii\easyii\modules\guestbook\api\Guestbook;
use yii\easyii\modules\page\api\Page;

$page = Page::get('page-guestbook');

$this->title = Yii::t('app',$page->seo('title', $page->model->title));
$this->params['breadcrumbs'][] = Yii::t('app',$page->model->title);
?>
<h1><?= Yii::t('app',$page->seo('h1', $page->title)) ?></h1>

<div class="row">
    <div class="col-md-8">
        <br>
        <?php foreach(Guestbook::items(['pagination' => ['pageSize' => 2]]) as $item) : ?>
            <div class="guestbook-item">
                <b><?= $item->name ?></b>
                <small class="text-muted"><?= $item->date ?></small>
                <p><?= $item->text ?></p>
                <?php if($item->answer) : ?>
                    <blockquote>
                        <b><?=Yii::t('app','Administrator') ?></b><br>
                        <?= $item->answer?>
                    </blockquote>
                <?php endif; ?>
            </div>
            <br>
        <?php endforeach; ?>
    </div>
    <div class="col-md-4">
        <?php if(Yii::$app->request->get(Guestbook::SENT_VAR)) : ?>
            <h4 class="text-success"><i class="glyphicon glyphicon-ok"></i> <?=Yii::t('app','Message successfully added') ?></h4>
        <?php else : ?>
            <h4><?=Yii::t('app','Leave message') ?></h4>
            <div class="well well-sm">
                <?= Guestbook::form() ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= Guestbook::pages() ?>
