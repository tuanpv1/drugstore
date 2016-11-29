<?php
/**
 * Created by PhpStorm.
 * User: TuanPham
 * Date: 11/27/2016
 * Time: 9:00 PM
 */
use yii\helpers\Url;
$totalAmount = 0;
if(isset($cartInfo)){
    foreach($cartInfo as $key => $value){
        $totalAmount += $value['amount'];
    }
}
?>
<div class="top_cart right">
    <a href="<?= Url::to(['product/list-my-cart']) ?>"><img class="image_cart" src="<?=  Yii::$app->request->baseUrl; ?>/img/cart.png" alt="">
        <span class="number_cart" id="amount"><?= $totalAmount ?></span>
    </a>
</div>
