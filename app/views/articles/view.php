<?php
use yii\easyii\modules\article\api\Article;
use yii\helpers\Url;

$this->title = Yii::t('app',$page->seo('title', $page->model->title));
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Articles'), 'url' => ['articles/index']];
$this->params['breadcrumbs'][] = ['label' => $article->cat->title, 'url' => ['articles/cat', 'slug' => $article->cat->slug]];
$this->params['breadcrumbs'][] = $article->model->title;
?>
<h1><?= Yii::t('app',$page->seo('h1', $page->title)) ?></h1>

<?= $article->text ?>

<?php if(count($article->photos)) : ?>
    <div>
        <h4><?= Yii::t('app','Photos')?></h4>
        <?php foreach($article->photos as $photo) : ?>
            <?= $photo->box(100, 100) ?>
        <?php endforeach;?>
        <?php Article::plugin() ?>
    </div>
    <br/>
<?php endif; ?>
<p>
    <?php foreach($article->tags as $tag) : ?>
        <a href="<?= Url::to(['/articles/tag', 'slug' => $article->cat->slug, 'tag' => $tag]) ?>" class="label label-info"><?= $tag ?></a>
    <?php endforeach; ?>
</p>

<small class="text-muted"><?= Yii::t('app','Views')?>: <?= $article->views?></small>