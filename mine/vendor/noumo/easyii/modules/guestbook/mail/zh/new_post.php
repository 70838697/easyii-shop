<?php
use yii\helpers\Html;

$this->title = $subject;
?>
<p>用户 <b><?= $post->name ?></b> 在你的留言板留言了.</p>
<p>您可以查看 <?= Html::a('这里', $link) ?>.</p>