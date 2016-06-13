<?php
use yii\easyii\modules\news\api\News;
use yii\helpers\Url;

$this->title = Yii::t('app',$page->seo('title', $page->model->title));
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','News'), 'url' => ['news/index']];
$this->params['breadcrumbs'][] = $news->model->title;
?>
<h1><?= Yii::t('app',$page->seo('h1', $page->title)) ?></h1>

<?= $news->text ?>

<?php if(count($news->photos)) : ?>
    <div>
        <h4><?= Yii::t('app','Photos')?></h4>
        <?php foreach($news->photos as $photo) : ?>
            <?= $photo->box(100, 100) ?>
        <?php endforeach;?>
        <?php News::plugin() ?>
    </div>
    <br/>
<?php endif; ?>
<p>
    <?php foreach($news->tags as $tag) : ?>
        <a href="<?= Url::to(['/news', 'tag' => $tag]) ?>" class="label label-info"><?= $tag ?></a>
    <?php endforeach; ?>
</p>

<div class="small-muted"><?= Yii::t('app','Views')?>: <?= $news->views?></div>