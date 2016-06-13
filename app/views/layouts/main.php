<?php
use yii\easyii\modules\shopcart\api\Shopcart;
use yii\easyii\modules\subscribe\api\Subscribe;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;

$goodsCount = count(Shopcart::goods());
?>
<?php $this->beginContent('@app/views/layouts/base.php'); ?>
<div id="wrapper" class="container">
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-menu">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= Url::home() ?>"><font color=red>Da</font><font color=yellow>Wo</font><font color=green>Ma</font></a>
                </div>

                <div class="collapse navbar-collapse" id="navbar-menu">
                    <?= Menu::widget([
                        'options' => ['class' => 'nav navbar-nav'],
                        'items' => [
                            ['label' => Yii::t('app','Home'), 'url' => ['site/index']],
                           /* ['label' => Yii::t('app','Shop'), 'url' => ['shop/index']],*/
                            ['label' => Yii::t('app','News'), 'url' => ['news/index']],
                            ['label' => Yii::t('app','Articles'), 'url' => ['articles/index']],
                           /* ['label' => Yii::t('app','Gallery'), 'url' => ['gallery/index']],*/
                            ['label' => Yii::t('app','Guestbook'), 'url' => ['guestbook/index']],
                            ['label' => Yii::t('app','FAQ'), 'url' => ['faq/index']],
                            ['label' => Yii::t('app','Contact'), 'url' => ['/contact/index']],
                        ],
                    ]); ?>
                    <?php /* ?>
                    <a href="<?= Url::to(['/shopcart']) ?>" class="btn btn-default navbar-btn navbar-right" title="Complete order">
                        <i class="glyphicon glyphicon-shopping-cart"></i>
                        <?php if($goodsCount > 0) : ?>
                            <?= $goodsCount ?> <?= $goodsCount > 1 ? 'items' : 'item' ?> - <?= Shopcart::cost() ?>$
                        <?php else : ?>
                            <span class="text-muted">empty</span>
                        <?php endif;*/ ?>
                    </a>

                </div>
            </div>
        </nav>
    </header>
    <main>
        <?php if($this->context->id != 'site') : ?>
            <br/>
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ])?>
        <?php endif; ?>
        <?= $content ?>
        <div class="push"></div>
    </main>
</div>
<footer>
    <div class="container footer-content">
        <div class="row">
            <div class="col-md-2">
                <?=Yii::t('app','Subscribe to newsletters') ?>
            </div>
            <div class="col-md-6">
                <?php if(Yii::$app->request->get(Subscribe::SENT_VAR)) : ?>
                    <?=Yii::t('app','You have successfully subscribed') ?>
                <?php else : ?>
                    <?= Subscribe::form() ?>
                <?php endif; ?>
            </div>
            <div class="col-md-4 text-right">
                ©2015 DaWoMa.com
            </div>
        </div>
    </div>
</footer>
<?php $this->endContent(); ?>