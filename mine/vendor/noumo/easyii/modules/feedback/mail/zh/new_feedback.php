<?php
use yii\helpers\Html;

$this->title = $subject;
?>
<p>用户 <b><?= $feedback->name ?></b> 在您的留言板留言了.</p>
<p>你可以查看 <?= Html::a('这里', $link) ?>.</p>