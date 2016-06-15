<?php
use yii\helpers\Html;

$this->title = $subject;

$total = 0;
?>

<p>您的订单<b>#<?= $order->primaryKey ?></b>状态已改变.</p>
<p>新的状态: <b><?= $order->statusName ?></b></p>
<br>
<table border="1">
    <tr>
        <th>物品</th>
        <th>数量</th>
        <th>商品</th>
        <th>共计</th>
    </tr>
    <?php foreach($order->goods as $good) : ?>
        <?php
            $price = $good->discount ? round($good->price * (1 - $good->discount / 100)) : $good->price;
            $unitTotal = $good->count * $price;
            $total += $unitTotal;
        ?>
        <tr>
            <td><?= $good->item->title ?> <?= $good->options ? "($good->options)" : '' ?></td>
            <td><?= $good->count ?></td>
            <td><?= $price ?></td>
            <td><?= $unitTotal ?></td>
        </tr>
    <?php endforeach?>
    <tr>
        <td colspan="5" align="right">
            <b>总计: <?= $total ?></b>
        </td>
    </tr>
</table>
<p>您可以查看 <?= Html::a('回复', $link) ?>.</p>
<hr>
<p>这是一封自动发出的邮件，请勿回复.</p>
