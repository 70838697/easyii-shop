<?php
use yii\helpers\Html;

$this->title = $subject;
?>

<p> <b><?= Yii::$app->request->serverName ?></b>网站的管理员回复了您的留言.</p>
<p>您可以查看 <?= Html::a('回复', $link) ?>.</p>
<hr>
<p>这是一封自动发出的邮件，请勿回复.</p>