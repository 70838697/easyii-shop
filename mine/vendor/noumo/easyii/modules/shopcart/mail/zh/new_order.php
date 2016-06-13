<?php
use yii\helpers\Html;

$this->title = $subject;
?>

<p>新订单已创建： <b>#<?= $order->order_id ?></b>.</p>
<p>您可以查看 <?= Html::a('这里', $link) ?>.</p>